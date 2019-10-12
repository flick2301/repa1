<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array());
global $APPLICATION;

$APPLICATION->AddChainItem($arResult['SECTION']['NAME'], "");

$APPLICATION->SetPageProperty("title", $arResult['IPROP_VALUES']['SECTION_META_TITLE']);
$APPLICATION->SetPageProperty("description", $arResult['IPROP_VALUES']['SECTION_META_DESCRIPTION']);
$APPLICATION->SetPageProperty("keywords", $arResult['IPROP_VALUES']['SECTION_META_KEYWORDS']);


?>


<h1 class="s38-title"><?=GetMessage('POL_CERTIFICATES_COMP_NAME')?> на <?=strtolower($arResult['SECTION']['NAME']);?></h1>
<?foreach($arResult['ITEMS'] as $item){?>

<nav class="nav-certificate">
    <ul class="nav-certificate__items">
    <?foreach($item['PROPERTIES']['CERT_PAGE']['VALUE'] as $page_cert){
        $file = CFile::ResizeImageGet($page_cert, array('width'=>$arParams['ITEMS_PREV_PIC_W'], 'height'=>$arParams['ITEMS_PREV_PIC_H']), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        ?> 
    <li class="nav-certificate__item">
            
	    <a href="<?=CFile::GetPath($page_cert)?>" rel="gallery_img" class="nav-certificate__link">
	       <img src="<?=$file['src']?>" alt="">
	        
	    </a>
	</li>
    
    <?}?>
    </ul>
</nav>
<? } ?>
