<?php
namespace Pol\Generator;


use Pol\Generator\Rules\RulesTable;
use Pol\Generator\Key\KeysTable;
use Pol\Generator\Logs\LogsTable;
use Pol\Generator\Agent\AgentTable;
use Bitrix\Iblock\InheritedProperty;
use Bitrix\Iblock\CIBlockElement;

use Bitrix\Catalog\CatalogViewedProductTable;
use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Context;
use Bitrix\Main\Event;
use Bitrix\Main\Loader;
use Bitrix\Main\UserTable;
use Bitrix\Sale\BasketItem;
use Bitrix\Sale\Order;
use Bitrix\Sale\OrderTable;

if (!Loader::includeModule('catalog'))
	return;
if (!Loader::includeModule('iblock'))
	return;
IncludeModuleLangFile(__FILE__);




class Generation{
	
    
    
    protected function checkModules()
    {
        if (!Main\Loader::includeModule('pol.generator'))
            throw new Main\LoaderException(Loc::getMessage('POL_GENERATOR_MODULE_NOT_INSTALLED'));
        
    }
	
    function gen1($IBLOCK_ID, $SECTION_ID, $TEMPLATE_ID, $KEYS_ID, $RULES, $EMPTY_RULES)
    {
		
	$men=self::gen_elements($IBLOCK_ID, $SECTION_ID, $TEMPLATE_ID, $KEYS_ID, $RULES, $EMPTY_RULES);
	$men=self::gen_sections($IBLOCK_ID, $SECTION_ID, $TEMPLATE_ID, $KEYS_ID, $RULES, $EMPTY_RULES);
                
        $res = LogsTable::add(Array('IBLOCK_ID'=>$IBLOCK_ID, "ID_SECTION"=>$SECTION_ID, "ID_KEY"=>$KEYS_ID, "ID_RULE"=>$TEMPLATE_ID));
                
	return false;
    }
    
    function agent_generator($agent_id=1){
        
        $res=AgentTable::getList(array(
                 'select'  => array('*'),
                 'order' => array('ID'=>'ASC')
        ));
        while($agent_row = $res->Fetch()){
            $arId[]=$agent_row['ID'];
            $men=self::gen_elements($agent_row['ID_IBLOCK'], $agent_row['ID_SECTION'], $agent_row['ID_RULES'], $agent_row['ID_KEYS'], false, 'N', 'Y');
            if($agent_row['ID']>$agent_id)
                $nextAgents[]=$agent_row['ID'];
                
            
        }
        if($nextAgents[0]!=''){
            $next_id=$nextAgents[0];
        }else{
            $next_id=$arId[0];
        }
        return '\Pol\Generator\Generation::agent_generator('.$next_id.');';
    }
	
	
	//ФУНКЦИЯ ОБРАБОТКИ ЭЛЕМЕНТОВ
	
    function gen_elements($IBLOCK_ID, $SECTION_ID, $TEMPLATE_ID, $KEYS_ID, $RULES, $EMPTY_RULES, $AGENT='N'){
		
       
	$arFields_element = Array(
            'ELEMENT_META_TITLE', 
            'ELEMENT_META_KEYWORDS',
            'ELEMENT_META_DESCRIPTION',
            'ELEMENT_DETAIL_PICTURE_FILE_ALT',
            'ELEMENT_DETAIL_PICTURE_FILE_TITLE',
            'ELEMENT_PREVIEW_PICTURE_FILE_ALT',
            'ELEMENT_PREVIEW_PICTURE_FILE_TITLE',
            "TITLE_HREF_MINI_CART",
            "TITLE_MENU",
			"ROOT_NAME",
			"ROOT_DESCRIPTION"
	);
        $arFields=array();
        if(!empty($RULES)){
            foreach($RULES as $value){
                if(in_array($value, $arFields_element))
                    $arFields[]=$value;   
            }            
        }else{
           $arFields = $arFields_element;
        }
		
		
	
        
        //Вычисляем все ID подразделов
        $rsParentSection = \CIBlockSection::GetByID($SECTION_ID);
        if ($arParentSection = $rsParentSection->GetNext())
        {
            $arFilter = array('IBLOCK_ID' => $IBLOCK_ID,'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
            $rsSect = \CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
            while ($arSect = $rsSect->GetNext())
            {
                $arSec[]=$arSect['ID'];
            }
        }
        $arSec[]=$SECTION_ID;



        $arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "IBLOCK_SECTION_ID"=>$arSec, 'IN_SECTIONS'=>'Y');

        $res=\Bitrix\Iblock\ElementTable::getList(array(
                 'select'  => array('*'), 
                 'filter'   => $arFilter, 
            
        ));
        
		
		
        while($element_row = $res->Fetch()){
			
            
            $ipropValues = new InheritedProperty\ElementValues($IBLOCK_ID, $element_row['ID']);	
            $iprop_values = $ipropValues->getValues();
            
            $ipropTemplates = new InheritedProperty\ElementTemplates($IBLOCK_ID, $element_row['ID']);
            $templates = $ipropTemplates->findTemplates();
			
			$ar_res = \CCatalogProduct::GetByID($element_row['ID']);
            
            
            
            if($templates['ELEMENT_META_TITLE']['INHERITED']=='N' && $templates['ELEMENT_META_TITLE']['TEMPLATE']!='' && $AGENT=='Y')
                continue;
            
            	
            $sec_arresult = \CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => $IBLOCK_ID, "ID" => $element_row["IBLOCK_SECTION_ID"]), false, array("ID", "IBLOCK_SECTION_ID", "NAME", "UF_*"));	
            $section_row = $sec_arresult->GetNext();
            
            $sec_arresult = \CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => $IBLOCK_ID, "ID" => $section_row["IBLOCK_SECTION_ID"]), false, array("ID", "IBLOCK_SECTION_ID", "NAME", "UF_*"));	
            $section_row1 = $sec_arresult->GetNext();

            $sec_arresult2 = \CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => $IBLOCK_ID, "ID" => $section_row1["IBLOCK_SECTION_ID"]), false, array("ID", "IBLOCK_SECTION_ID", "NAME", "UF_*"));	
            $section_row2 = $sec_arresult2->GetNext();
			
            $sec_arresult3 = \CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => $IBLOCK_ID, "ID" => $section_row2["IBLOCK_SECTION_ID"]), false, array("ID", "IBLOCK_SECTION_ID", "NAME", "UF_*"));	
            $section_row3 = $sec_arresult3->GetNext();
			
            
            $base_price = \CCatalogGroup::GetBaseGroup();
            
            
            //Количество на всех складах
            
            $storeRes = \CCatalogStoreProduct::GetList(
                array("SORT" => "ASC"), # сортировка
                array("PRODUCT_ID" => $element_row['ID']), # отбор по фильтру
                false, # группировка по полям
                false, # параметры выборки
                array("*") # поля для выборки
            );
            $sum=0;
            while($arStoreParam = $storeRes->GetNext()){
                $sum += $arStoreParam['AMOUNT'];
            }
            
            $db_props = \CIBlockElement::GetProperty($IBLOCK_ID, $element_row['ID'], array("sort" => "asc"), Array("*"));
			while($ar_props = $db_props->Fetch()){
				if($ar_props['CODE'] == "BREND")
					$BREND = $ar_props["VALUE"];
				$element_prop[$ar_props['CODE']] = $ar_props["VALUE"];
				if($ar_props['PROPERTY_TYPE']=="L")
					$element_prop[$ar_props['CODE']] = $ar_props["VALUE_ENUM"];
				
			}
           

            if($sum>0){$in_stock='в наличии';}else{$in_stock='под заказ';}


    
	
            if($section_row3['NAME'] == $section_row2['NAME']) $section_row3['NAME']='';
            if($section_row2['NAME'] == $section_row1['NAME']) $section_row2['NAME']='';
		
            $arMeta=array(
		   "{product_name}" => "{=this.Name}",
                   "{product_name_lower}"=>strtolower($element_row['NAME']),
		   "{product}" => "{=this.Name}",
		   "{stylus_tip}" => $stylus_tip,
		   "{price}" => '{=this.catalog.price.'.$base_price['ID'].'}',
		   "{in_stock}" => $in_stock,
		   "{brend}" => '{=this.property.BREND}',
		   "{section_name}" => $section_row['NAME'],
		   "{section_name1}" => $section_row1['NAME'],
		   "{section_name2}" => $section_row2['NAME'],
		   "{section_name3}" => $section_row3['NAME'],
                   "{section_name_lower}" => strtolower($section_row['NAME']),
		   "{section_name1_lower}" => strtolower($section_row1['NAME']),
		   "{section_name2_lower}" => strtolower($section_row2['NAME']),
		   "{section_name3_lower}" => strtolower($section_row3['NAME']),
		   "{section_nameF}"=>'{=limit concat this.sections.name " / " 1}',
		   "{color_RAL}"=> '{=this.property.TSVET}'
		);
		
			
				
            $rules = RulesTable::getList(array(
		'select' => array('*'),
		'filter'   => array('ID_SECTION' => $TEMPLATE_ID),
		));
		$keys = KeysTable::getList(array(
                 'select'  => array('*'), 
                 'filter'   => array('ID_SECTION' => $KEYS_ID), 
            
            ));
		
            while ($rule_row = $rules->Fetch()){
                
                foreach($rule_row as $rule_key => $value){
                    if(in_array($rule_key, $arFields)){
				
			$meta_row[$rule_key] = $value;
                    }
		}
            }
        		
				
		while($key_row = $keys->Fetch()){
			
			$key_arr = explode(", ", $key_row['KEYS']);
			$rand = array_rand($key_arr);
			$zamena_key = "{".$key_row['NAME']."}";
                        foreach($meta_row as $tag=>$value){			
			
                            $meta_row[$tag] = str_replace($zamena_key, $key_arr[$rand], $value);
			
			}
			
		}
		
		foreach($arMeta as $meta_key => $value_meta){
		   
		   foreach($meta_row as $tag=>$value){			
			
			$meta_row[$tag] = str_replace($meta_key, $value_meta, $value);
			//$meta_row[$tag] = preg_replace("/\. (.){1}/", ". ".mb_strtoupper("\${1}"), $meta_row[$tag]);
			
			}
		   }
		
				
				
		$encoding = 'UTF-8';
		
		
		                
		foreach($meta_row as $key => $value){
			
			$string = explode(". ", $value);
			$kol=count($string);
			$kon='';
			foreach($string as $str){
				if ($str==$string[$kol-1]) {
                                        $kon .= mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).mb_substr($str, 1, mb_strlen($str), $encoding);
                                }else{
                                        $kon .= mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).mb_substr($str, 1, mb_strlen($str), $encoding).". ";
                                }
				
			}
			
			if($EMPTY_RULES!='Y' || !($templates[$key]['INHERITED']=='N' && $templates[$key]['TEMPLATE']!='')){
                            
                        $ipropTemplates->set(array(
                            $key => $kon,
         
                        ));
						
						
						if($key=='ROOT_NAME'){
							foreach($element_prop as $code=>$prop){
								
								$kon=str_replace('{=this.property.'.$code.'}', strtolower($prop), $kon);
								
							}
							
							$kon=str_replace('{=this.catalog.price.'.$base_price['ID'].'}', $base_price['PRICE'].' '.$base_price['CURRENCY'], $kon);
							$kon=str_replace('{=this.catalog.measure}', $element_prop['CML2_BASE_UNIT'], $kon);
							$kg = intval($ar_res['WEIGHT'])/1000;
							$kon=str_replace('{=this.catalog.weight}', $kg.' кг', $kon);
							\CIBlockElement::SetPropertyValuesEx($element_row['ID'], false, array($key => $kon));
							
						}
						if($key=='ROOT_DESCRIPTION'){
							foreach($element_prop as $code=>$prop){
								$kon=str_replace('{=this.property.'.$code.'}', strtolower($prop), $kon);
							}
							$kon=str_replace('{=this.catalog.price.'.$base_price['ID'].'}', $base_price['PRICE'].' '.$base_price['CURRENCY'], $kon);
							$kon=str_replace('{=this.catalog.measure}', $element_prop['CML2_BASE_UNIT'], $kon);
							$kg = intval($ar_res['WEIGHT'])/1000;
							$kon=str_replace('{=this.catalog.weight}', $kg.' кг', $kon);
							\CIBlockElement::SetPropertyValuesEx($element_row['ID'], false, array($key => $kon));
						}
						
                        }
						
						
		
                }
                $ipropValues->clearValues();
		
	}
		
	

        return false;	
    }
	
	
	//ФУНКЦИЯ ОБРАБОТКИ РАЗДЕЛОВ
	
    function gen_sections($IBLOCK_ID, $SECTION_ID, $TEMPLATE_ID, $KEYS_ID, $RULES, $EMPTY_RULES, $AGENT='N'){
		
	
	$arFields_section = Array(
            'SECTION_META_TITLE',
            'SECTION_META_KEYWORDS',
            'SECTION_META_DESCRIPTION',
            'ELEMENT_PREVIEW_PICTURE_FILE_ALT',
            'ELEMENT_PREVIEW_PICTURE_FILE_TITLE',
            "TITLE_HREF_MINI_CART",
            "TITLE_MENU",
	);
        $arFields=array();
        if(!empty($RULES)){
            foreach($RULES as $value){
                if(in_array($value, $arFields_section))
                    $arFields[]=$value;   
            }            
        }else{
           $arFields = $arFields_section;
        }
        	
		
	//Вычисляем все ID подразделов
        $rsParentSection = \CIBlockSection::GetByID($SECTION_ID);
        if ($arParentSection = $rsParentSection->GetNext())
        {
            $arFilter = array('IBLOCK_ID' => $IBLOCK_ID,
                
                    '>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'=>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']
                   
                   
                ); // выберет потомков без учета активности
            $rsSect = \CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
            while ($section_row = $rsSect->GetNext())
            {
                
                $ipropValues = new InheritedProperty\SectionValues($IBLOCK_ID, $section_row['ID']);
                $iprop_values = $ipropValues->getValues();
                
                $ipropTemplates = new InheritedProperty\SectionTemplates($IBLOCK_ID, $section_row['ID']);
                $templates = $ipropTemplates->findTemplates();
                
                if($templates['SECTION_META_TITLE']['INHERITED']=='N' && $templates['SECTION_META_TITLE']['TEMPLATE']!='' && $AGENT=='Y')
                continue;
                
                
                
			
		$sec_arresult = \CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => $IBLOCK_ID, "ID" => $section_row["IBLOCK_SECTION_ID"]), false, array("ID", "IBLOCK_SECTION_ID", "NAME", "UF_*"));	
		$section_row1 = $sec_arresult->GetNext();

		$sec_arresult2 = \CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => $IBLOCK_ID, "ID" => $section_row1["IBLOCK_SECTION_ID"]), false, array("ID", "IBLOCK_SECTION_ID", "NAME", "UF_*"));	
		$section_row2 = $sec_arresult2->GetNext();
			
		$sec_arresult3 = \CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID" => $IBLOCK_ID, "ID" => $section_row2["IBLOCK_SECTION_ID"]), false, array("ID", "IBLOCK_SECTION_ID", "NAME", "UF_*"));	
		$section_row3 = $sec_arresult3->GetNext();
		
		
                        
         
         
                $base_price = \CCatalogGroup::GetBaseGroup();
                $BREND=array();	
                $price_ar=array();
                
                //Необходимо получить все цены элементов в разделе и бренды
                $arSelect = Array("ID", "NAME", "CATALOG_GROUP_".$base_price['ID'], "PROPERTY_BREND");
                $arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, 'IBLOCK_SECTION_ID' => $section_row['ID'], "INCLUDE_SUBSECTIONS"=>"Y");
                $res = \CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                while($ob = $res->GetNext())
                {
                    
                    $BREND[] = $ob["PROPERTY_BREND_VALUE"];
                    if($ob['CATALOG_PRICE_'.$base_price['ID']])
                        $price_ar[]=$ob['CATALOG_PRICE_'.$base_price['ID']];
                }
                	

                $BREND = array_unique($BREND);
                $BREND = implode(',', array_slice($BREND,0,4));    
	
                if($section_row3['NAME'] == $section_row2['NAME']) $section_row3['NAME']='';
                if($section_row2['NAME'] == $section_row1['NAME']) $section_row2['NAME']='';
		
                $arMeta=array(
		   "{product_name}" => "{=this.Name}",
                   "{product_name_lower}"=>strtolower($section_row['NAME']),
		   "{product}" => "{=this.Name}",
		   "{stylus_tip}" => $stylus_tip,
		   "{price}" => '{=this.catalog.price.'.$base_price['ID'].'}',
		   "{min_price}" => number_format(min($price_ar), 0, ',', ' ').' руб',
		   "{in_stock}" => $in_stock,
		   "{brend}" => $BREND,
		   "{section_name}" => $section_row['NAME'],
		   "{section_name1}" => $section_row1['NAME'],
		   "{section_name2}" => $section_row2['NAME'],
		   "{section_name3}" => $section_row3['NAME'],
                    "{section_name_lower}" => strtolower($section_row['NAME']),
		   "{section_name1_lower}" => strtolower($section_row1['NAME']),
		   "{section_name2_lower}" => strtolower($section_row2['NAME']),
		   "{section_name3_lower}" => strtolower($section_row3['NAME']),
		   "{section_nameF}"=>'{=limit concat this.sections.name " / " 1}',
		   "{color_RAL}"=> '{=this.property.ral}'
		);
		
			
				
                $rules = RulesTable::getList(array(
                    'select' => array('*'),
                    'filter'   => array('ID_SECTION' => $TEMPLATE_ID),
		));
		$keys = KeysTable::getList(array(
                    'select'  => array('*'), 
                    'filter'   => array('ID_SECTION' => $KEYS_ID), 
            
                ));
                $meta_row=array();
		while ($rule_row = $rules->Fetch()){
			
		foreach($rule_row as $rule_key => $value){
                    if(in_array($rule_key, $arFields)){
				
			$meta_row[$rule_key] = $value;
					   
		 
			}
                    }
                }
        		
				
		while($key_row = $keys->Fetch()){
			
			$key_arr = explode(", ", $key_row['KEYS']);
			$rand = array_rand($key_arr);
			$zamena_key = "{".$key_row['NAME']."}";
                        foreach($meta_row as $tag=>$value){			
			
                            $meta_row[$tag] = str_replace($zamena_key, $key_arr[$rand], $value);
			
			}
			
		}
		
		foreach($arMeta as $meta_key => $value_meta){
		   
		   foreach($meta_row as $tag=>$value){			
			
			$meta_row[$tag] = str_replace($meta_key, $value_meta, $value);
			
                    }
		}
		
				
				
		$encoding = 'UTF-8';
		
		    
		
		foreach($meta_row as $key => $value){
			
			
			$string = explode(". ", $value);
			$kol=count($string);
			$kon='';
			foreach($string as $str){
				if ($str==$string[$kol-1]) {
                                    $kon .= mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).mb_substr($str, 1, mb_strlen($str), $encoding);
                                }else{
                                    $kon .= mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).mb_substr($str, 1, mb_strlen($str), $encoding).". ";
                                }
				
				
			}
			
                        if($EMPTY_RULES!='Y' || !($templates[$key]['INHERITED']=='N' && $templates[$key]['TEMPLATE']!='')){
                            
                        $ipropTemplates->set(array(
                            $key => $kon,
         
                        ));
                        
                        }
		
                }
                $ipropValues->clearValues();
		
		
		
            }
        }

            return false;	
    }
	
	
	


    function mb_ucfirst($str, $encoding='UTF-8')
	{
		$str = mb_ereg_replace('^[\ ]+', '', $str);
		$str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
			   mb_substr($str, 1, mb_strlen($str), $encoding);
		return $str;
	}




 
}

?>