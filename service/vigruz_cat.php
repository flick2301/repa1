
    <?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use \Bitrix\Main;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Type;
use \Bitrix\Iblock\InheritedProperty;


Main\Loader::includeModule('main');
Main\Loader::includeModule('sale');


$res = CIBlockSection::GetList(
        Array("SORT"=>"ASC"),
        Array("IBLOCK_ID"=>5, "ACTIVE"=>"Y"),
        false,
        Array("ID", "NAME", "CODE", "PICTURE", "DESCRIPTION", 'UF_DETAIL_TEXT')
    );
    $request = array();
    while($arSection = $res->GetNext()){
       // echo $arSection['CODE'].'-'.CFile::GetPath($arSection['PICTURE'])."<br>";
       // $request[$arSection['CODE']]=CFile::GetPath($arSection['PICTURE']);
       // $pala = mb_convert_encoding($arSection['NAME'], "cp1251");
       // $convertedText = iconv("utf-8", "windows-1251",  $arSection['NAME']);
        //$request[$arSection['CODE']]=$convertedText;
        $ipropValues = new InheritedProperty\SectionValues('5', $arSection['ID']);
        $values = $ipropValues->getValues();
        $meta_data='';
        $det_text='';
        $text='';
        foreach($values as $key=>$val){
            $meta_data.=$key.':::'.$val.'---';
        }
        if($arSection['UF_DETAIL_TEXT']!=''){$det_text=$arSection['UF_DETAIL_TEXT'].'|||'; echo 'have';}
        if($arSection['DESCRIPTION']!=''){$text=$arSection['DESCRIPTION'].'|||';}
        $picture=CFile::GetPath($arSection["PICTURE"]);
	$str .= $arSection['CODE'].'|||'.'http://'.$_SERVER['HTTP_HOST'].$picture.'|||'.$meta_data.'|||'.$text.$det_text.'$$$';
    }
    
    $res = CIBlockElement::GetList(
        Array("SORT"=>"ASC"),
        Array("IBLOCK_ID"=>5, "ACTIVE"=>"Y"),
        false,
        false,
        Array("ID", "PROPERTY_CML2_ARTICLE")
    );
    while($arElement = $res->GetNext()){
    $ipropValues = new InheritedProperty\ElementValues('5', $arElement['ID']);
        $values = $ipropValues->getValues();
        $meta_data='';
        foreach($values as $key=>$val){
            $meta_data.=$key.':::'.$val.'---';
        } 
        $str_element .= $arElement["PROPERTY_CML2_ARTICLE_VALUE"].'|||'.$meta_data.'$$$';
    }

$fd = fopen("obmen.txt", 'w') or die("не удалось создать файл");

fwrite($fd, $str);
fclose($fd);

$fd = fopen("obmen_elements.txt", 'w') or die("не удалось создать файл");

fwrite($fd, $str_element);
fclose($fd);




?>

<?
  
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>
