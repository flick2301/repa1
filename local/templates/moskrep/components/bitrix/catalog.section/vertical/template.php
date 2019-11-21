<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */
global $APPLICATION
?>
<?include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");?>
<?$ral_in_ar = $arResult['ITEMS'][0]['PROPERTIES']["TSVET"]["VALUE"];?>
<?$APPLICATION->SetPageProperty('title', $arResult["NAME"].", цена - купить в интернет-магазине в Москве");?>

<?if(count($arResult['RELINK'])):?>
<?php $this->SetViewTarget('RELINK'); ?>
<nav class="nav-aside">
    <strong class="nav-aside__title">Сопутствующие товары:</strong>
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
        <a href="<?=$arResult['PICTURE']['SRC']?>" onclick="javascript:void();" rel="catalog-photo" class="catalog-photo__link">
            <img src="<?=$arResult['PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>">
        </a>
    </div>
    <div class="catalog-head__text">
       <?
        if(strpos(html_entity_decode($arResult['DESCRIPTION'], ENT_QUOTES, "UTF-8"), '</p>')):
        $paragraph=explode('<p>', html_entity_decode($arResult['DESCRIPTION'], ENT_QUOTES, "UTF-8"));
        $paragraph_first=explode('</p>', $paragraph[1]);
        $paragraph_first=$paragraph_first[0];
        else:
            
          $paragraph_first =html_entity_decode($arResult['DESCRIPTION'], ENT_QUOTES, "UTF-8"); 
        endif;
?>
        <p class="catalog-head__paragraph"><?=$paragraph_first;?></p>
	<a href="javascript:void(0);" class="catalog-head__more">Подробнее</a>
    </div>
    <?if($arResult['CERT_URL'] || $arResult['UF_TECH_FILE'] || $arResult['UF_VES_TABLE_FILE']):?>
    <nav class="info-nav">
	<span class="info-nav__title">Информация</span>
	<ul class="info-nav__items">
            <?if($arResult['CERT_URL']):?>
                <li class="info-nav__item"><a href="<?=$arResult['CERT_URL'];?>" class="info-nav__link">Сертификаты на <?=$arResult['CERT_NAME'];?></a></li>
            <?endif;?>
            <?if($arResult['UF_TECH_FILE']):?>
                <li class="info-nav__item"><a rel="catalog-photo" href="<?=$arResult['UF_TECH_FILE'];?>" class="info-nav__link">Технические характеристики самореза с прессшайбой</a></li>
            <?endif;?>
            <?if($arResult['UF_VES_TABLE_FILE']):?>
                <li class="info-nav__item"><a rel="catalog-photo" href="<?=$arResult['UF_VES_TABLE_FILE'];?>" class="info-nav__link">Вес самореза цветного с прессшайбой</a></li>
            <?endif;?>
	</ul>
    </nav>
    <?endif;?>
    
</div>
<?endif;?>

<div class="catalog-filter">
    
    <?$APPLICATION->ShowViewContent('filter_in_stock');?>
   <?if($arResult['JUST_VERTICAL'] != 'Y'):?>
    <div class="catalog-filter__item">
        <ul class="show-list show-list--model">
            <li class="show-list__item"><a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('VERTICAL_FILTER=Y', array('VERTICAL_FILTER'))?>" class="show-list__link show-list__link--card active"></a></li>
            <li class="show-list__item"><a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('', array('VERTICAL_FILTER'))?>" class="show-list__link show-list__link--list"></a></li>
        </ul>
    </div>
    <?endif;?>
</div>

<?
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
?>

    <ul class="product-list__items product-list__items--card">
	
    
						
					
				
<?

  
    foreach ($arResult['ITEMS'] as $item)
    {
        
        $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'];
        $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        
        $ar_size = array(
            $item['PROPERTIES']["DIAMETR"]["VALUE"],
            $item['PROPERTIES']["VYSOTA"]["VALUE"],
            $item['PROPERTIES']["SHIRINA"]["VALUE"],
            $item['PROPERTIES']["DLINA"]["VALUE"],
        );
        $size = array_diff($ar_size, ['']);
?>
        
        <li class="product-list__item">
		
					<div class="product-list__info">						
					<div class="product-list__lineflex">
						<div class="product-list__delivery">Доставка <span class="product-list__day">Завтра</span></div>
						<div class="product-list__presence"><?echo ($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']) ? 'В наличии' : 'Под заказ';?></div>
					</div>
					<div class="product-list__lineflex">
						<div class="product-list__pickup">Самовывоз <span class="product-list__day">Сегодня</span></div>
						<div class="product-list__presence-number<?echo ($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']=='0') ? "_disable" : "";?>"><?echo $item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED'];?> уп.</div>
					</div>
					<div class="product-list__lineflex">
						<div class="product-list__price"><?echo number_format($price, 2, '.', ' ');?> ₽
                                                  <?echo ($old_price) ? '<span class="carousel-product__price-old">'.number_format($old_price, 2, '.', ' ').' ₽</span>': '';?> 
                                                </div>
						<a href="javascript:void(0)" data-product="<?=$item['ID']?>" old-price="<?=$price?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" rel="nofollow" class="product-list__btn blue-btn">В корзину</a>
					</div>
					</div>
            
					<a href="<?=$item['DETAIL_PAGE_URL']?>" title='<?=$item['IPROPERTY_VALUES']['TITLE_HREF_MINI_CART']?>' target="_self" class="product-list__img"><?if($item['PROPERTIES']['novelty']['VALUE_XML_ID']=='Y'){?><div class="product-list__novelty">Новинка</div><?}?>
                                            <img src="<?=$item['PREVIEW_PICTURE']['src']?>" alt='<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?>'>
                                            <p><?=$item['NAME']?></p>
                                        </a>
	</li>
        
                                                   
						
			
			<?
		}
		?>

					
    </ul>
<?
if ($showBottomPager)
{
	?>
	
		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	
	<?
}
?>

<?


if($arResult["UF_RELATED"]){
?>
<h2 class="s28-title">Сопутствующие товары</h2>
<ul class="card-nav-product"><?
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "ID"=>$arResult["UF_RELATED"], false, array("*"));
$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
while($arSection = $db_list->GetNext()) {
    $renderImage = CFile::ResizeImageGet($arSection["PICTURE"], Array("width" => 72, "height" => 72), BX_RESIZE_IMAGE_EXACT, false); 
    ?><li class="card-nav-product__item">
        <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="card-nav-product__link">
            <div class="card-nav-img">
              
                <img src="<?=$renderImage['src']?>"  alt="">
            </div>
            <div class="card-nav-text"><?=$arSection['NAME']?></div>
        </a>
    </li><?
}
?>
</ul>

<?}?>
<?if($arResult['UF_DETAIL_TEXT']):?>
<div class='set-default-parametr-page-cat'><?=html_entity_decode($arResult['UF_DETAIL_TEXT'], ENT_QUOTES, "UTF-8");?></div>
<?endif;?>
<script>
$('.amount__select').on('change', function() {
        $('.amount__info').text($(".amount__select option:selected").text());
        
        $('#'+this.value).click();
        $(".amount__select :contains('Сначала по цене')").attr("selected", "selected"); 
        
});
$(".amount__select :contains('"+$('.amount__info').text()+"')").attr("selected", "selected");
</script>

		