<?
use Bitrix\Main\Loader,
	Bitrix\Main\Localization\Loc,
	Bitrix\Iblock\ElementTable,
        Bitrix\Main\Application;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var $APPLICATION CMain
 * @var $USER CUser
 */

Loc::loadMessages(__FILE__);

if (!Loader::includeModule("search")&&!Loader::includeModule("iblock"))
{
	
	return;
}

class classSearchPage extends CBitrixComponent
{
	public function executeComponent(){
            $context = Application::getInstance()->getContext();
            $request = $context->getRequest();
            
                $this->arResult = $this->arParams;

                
                $arFilter = Array('IBLOCK_ID'=>$this->arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y', '%NAME'=>$request["q"]);
                $db_list = CIBlockSection::GetList(Array('depth_level'=>'asc'), $arFilter, false, false, Array("nTopCount" => 50));
    
                while($ar_result = $db_list->GetNext())
                {
                    $this->arResult['ITEMS'][]=array('TITLE'=>$ar_result['NAME'], 'URL'=>$ar_result['SECTION_PAGE_URL'], 'BODY_FORMATED'=>'');
                }
                
                if(count($this->arResult['ITEMS'])==0):
                
                    $rs= CIBlockElement::GetList (
                        Array("RAND" => "ASC"),
                        Array("IBLOCK_ID" => $this->arParams['IBLOCK_ID'], 
                        array(
                            "LOGIC" => "OR",
                            array('%NAME'=>$request["q"]),
                            array('%PROPERTY_CML2_ARTICLE'=>$request["q"])),
                        ),
                        false,
                        Array ("nTopCount" => 50),
                        array('*', 'PROPERTY_CML2_ARTICLE')
                    );
                    while($ar = $rs->GetNext()) {
                    
                        $this->arResult['ITEMS'][]=array('TITLE'=>$ar['NAME'], 'URL'=>$ar['DETAIL_PAGE_URL'], 'BODY_FORMATED'=>$q, 'ARTICLE'=>$ar['PROPERTY_CML2_ARTICLE_VALUE']);
                    }
                endif;
                $this->arResult["REQUEST"]["QUERY"]=$request["q"];
		$this->IncludeComponentTemplate();
		
            
	}
}
?>