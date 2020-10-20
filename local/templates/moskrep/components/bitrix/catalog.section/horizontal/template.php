<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


global $APPLICATION;
include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");
$ral_in_ar = $arResult['ITEMS'][0]['PROPERTIES']["TSVET"]["VALUE"];

//Параметр FOR_SEO устанавливается если это раздел справочника, а не каталога
//А значит текст и заголовок(шапка) не берутся из каталога, а из справочника, значит условие FOR_SEO != Y
if($arParams['FOR_SEO']!='Y'){
    

    $APPLICATION->SetPageProperty('title', $arResult["NAME"].", цена - купить в интернет-магазине в Москве");
    ?>
    <?if(count($arResult['RELINK'])):?>
        <?php $this->SetViewTarget('RELINK'); ?>
        <nav class="nav-aside">
            <strong class="nav-aside__title">Смотрите также:</strong>
            <ul class="nav-aside__items">

                <?foreach($arResult['RELINK'] as $relink):?>

                    <li class="nav-aside__item"><a href="<?=$relink['AKCEPTOR']?>" title="" class="nav-aside__link"><?=$relink['ANKOR']?></a></li>

                <?endforeach;?>
            </ul>
        </nav>
        <?php $this->EndViewTarget(); ?>
    <?endif;?>
<h1 class="s38-title"><?=($arResult['META_TITLE']) ? $arResult['META_TITLE'] :$arResult['NAME'];?></h1>
<?if($arResult['DESCRIPTION']):?>
<div class="catalog-head">
    <div class="catalog-head__photo">
        <a href="<?=$arResult['PICTURE']['SRC']?>"  onclick="javascript:void();" rel="catalog-photo" class="catalog-photo__link">
            <img src="<?=$arResult['PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>">
        </a>
    </div>
    <div class="catalog-head__text">
        
        <div class="catalog-head__paragraph"><?=$arResult['DESCRIPTION'];?></div>
	<a href="javascript:void(0);" class="catalog-head__more">Подробнее</a>
    </div>
    <?if($arResult['CERT_URL'] || $arResult['UF_TECH_FILE'] || $arResult['UF_VES_TABLE_FILE']):?>
    <nav class="info-nav">
	<span class="info-nav__title">Информация</span>
	<ul class="info-nav__items">
            <?if($arResult['CERT_URL']):?>
                <li class="info-nav__item"><a href="<?=$arResult['CERT_URL'];?>" title='Сертификаты на <?=$arResult['CERT_NAME'];?>' class="info-nav__link">Сертификаты на <?=$arResult['CERT_NAME'];?></a></li>
            <?endif;?>
            <?if($arResult['UF_TECH_FILE']):?>
                <li class="info-nav__item"><a rel="catalog-photo" title='<?=$arResult['UF_TECH_NAME']?>' href="<?=$arResult['UF_TECH_FILE'];?>" class="info-nav__link"><?=$arResult['UF_TECH_NAME']?></a></li>
            <?endif;?>
            <?if($arResult['UF_VES_TABLE_FILE']):?>
                <li class="info-nav__item"><a rel="catalog-photo" title='<?=$arResult['UF_VES_NAME']?>' href="<?=$arResult['UF_VES_TABLE_FILE'];?>" class="info-nav__link"><?=$arResult['UF_VES_NAME']?></a></li>
            <?endif;?>
	</ul>
    </nav>
    <?endif;?>
    
</div>
<?endif;?>

<div class="catalog-filter">
    
   <?$APPLICATION->ShowViewContent('filter_in_stock');?>
   
    
  
</div>

<?php



    $showTopPager = $arParams["DISPLAY_TOP_PAGER"];
    $showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
    $showLazyLoad = false;

    if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
    {
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
	$showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
    }

//ШАПКА ТАБЛИЦЫ

}?>

<div class="sale-category">
    <table class="blue-table full price-category">
	<thead class="blue-table__thead">
            <tr class="blue-table__tr">
                <th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Размер, мм</span></span></th>
                <th class="blue-table__th blue-table__name"><span class='link-sorting'><span class="link-sorting__style">Наименование</span></span></th>
		<th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Артикул</span></span></th>
		
            <?if($ral_in_ar){?>
		<th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Цвет, RAL</span></span></th>
            <?}?>
                <th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Фасовка</span></span></th>
		<th class="blue-table__th blue-table__price"><span class='link-sorting'><span class="link-sorting__style">Стоимость</span></span></th>
		<th class="blue-table__th">Купить</th>
	    </tr>
	</thead>
    <tbody class="blue-table__tbody">
						
					
				
<?php
    foreach($arResult['SIZES'] as $size){
        
        $index=0;
        foreach ($size as $item)
        {
       
            $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'];
            $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        ?>
        
        
        <tr class="blue-table__tr">
            <?if($index==0){?>
            <td class="blue-table__td"><span class="size-b"><?=$item['SIZES']?></span></td>
	    <?
            
            }?>
            <td class="blue-table__td blue-table__name">
                <a href="<?=$item['DETAIL_PAGE_URL']?>" target="_self"  title='<?=$item['IPROPERTY_VALUES']['TITLE_HREF_MINI_CART']?>' class="name-b">
                    <?=$item['NAME']?>
                    <div class="name-b__photo">
                        <img src="<?=$item['PREVIEW_PICTURE']['src']?>" alt='<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?>' />
                    </div>
                </a>
            </td>
	    <td class="blue-table__td"><span class="articul-b"><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></td>
	    
	<?if($ral_in_ar){?>
            <td class="blue-table__td"><div class="color-b"><i style="background: #<?=$array_rals[$item['PROPERTIES']["TSVET"]["VALUE"]]?>;"></i><?=$item['PROPERTIES']["TSVET"]["VALUE"]?></div></td>
        <?}?>
            <td class="blue-table__td"><span class="col-b"><?=($item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"]) ? $item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"] : '1';?> <?=$item['UNIT']?></span></td>
	    <td class="blue-table__td blue-table__price">
	        <span class="price-b"><?echo number_format($price, 2, '.', ' ');?> ₽</span>
                <?echo ($old_price) ? '<span class="carousel-product__price-old">'.number_format($old_price, 2, '.', ' ').' ₽</span>': '';?> 
		<?echo ($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']) ? '<span class="availability-b active">В наличии</span>' : '<span class="availability-b">Под заказ</span>';?>
            </td>
	    <td class="blue-table__td">
		<div class="value">
		    <a href="javascript:void(0)" rel="nofollow" class="value__minus">—</a>
			<input type="text" name="" id="QUANTITY_<?=$item['ID']?>" value="1" class="value__input">
		    <a href="javascript:void(0)" rel="nofollow" class="value__plus">+</a>
		</div>
		<a href="javascript:void(0)" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" rel="nofollow" class="blue-btn basket-btn">В корзину</a>
	    </td>
	</tr>
                                                        
						
			
<?php
        }
    }
?>

					
    </tbody>
</table>
</div>


	
		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	

<?

//Параметр FOR_SEO устанавливается если это раздел справочника, а не каталога
//А значит текст под таблицей и сопутствующие товары берутся не из раздела, а из справочника, значит условие FOR_SEO != Y
if($arParams['FOR_SEO']!='Y'){
	
if($arResult["UF_RELATED"]){
?>
<h2 class="s28-title">Сопутствующие товары</h2>
<ul class="card-nav-product"><?
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "ID"=>$arResult["UF_RELATED"], false, array("*"));
$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
while($arSection = $db_list->GetNext()) {
    $renderImage = CFile::ResizeImageGet($arSection["PICTURE"], Array("width" => 72, "height" => 72), BX_RESIZE_IMAGE_EXACT, false); 
    ?><li class="card-nav-product__item">
        <a href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self" class="card-nav-product__link">
            <div class="card-nav-img">
              
                <img src="<?=$renderImage['src']?>"  alt="<?=$arSection['NAME']?>">
            </div>
            <div class="card-nav-text"><?=$arSection['NAME']?></div>
        </a>
    </li><?
}
?>
</ul>
<?}?>


<?if($arResult['UF_DETAIL_TEXT'] && ($_SERVER['HTTP_HOST']=='spb.krep-komp.ru' || $_SERVER['HTTP_HOST']=='krep-komp.ru')):?>
<div class='set-default-parametr-page-cat'><?=html_entity_decode($arResult['UF_DETAIL_TEXT'], ENT_QUOTES, "UTF-8");?></div>
<?endif;?>


<?}?>
		