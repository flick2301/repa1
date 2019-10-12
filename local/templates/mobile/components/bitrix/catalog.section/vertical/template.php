<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>




<?include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");?>
<?$ral_in_ar = $arResult['ITEMS'][0]['PROPERTIES']["TSVET"]["VALUE"];?>

<h1 class="s28-title"><?=$arResult['NAME']?></h1>
<div class="catalog-head">
    
    <div class="catalog-head__text">
        <p class="catalog-head__paragraph">
        <a href="<?=$arResult['PICTURE']['SRC']?>" rel="catalog-photo" class="catalog-photo__link">
            <img src="<?=$arResult['PICTURE']['SRC']?>" alt="">
        </a>
        <?=html_entity_decode($arResult['DESCRIPTION'], ENT_QUOTES, "UTF-8");?></p>
	<a href="javascript:void(0);" class="catalog-head__more">Подробнее</a>
    </div>
   
    <?if($arResult['CERT_URL'] || $arResult['UF_TECH_FILE'] || $arResult['UF_VES_TABLE_FILE']):?>
    <nav class="info-nav">
	<span class="info-nav__title">Информация</span>
	<ul class="info-nav__items">
            <?if($arResult['CERT_URL']):?>
                <li class="info-nav__item"><a href="<?=$arResult['CERT_URL'];?>" class="info-nav__link">Сертификаты на саморезы с прессшайбой</a></li>
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

<div class="catalog-filter">
    
        <?$APPLICATION->IncludeComponent(
        "d7:catalog.smart.filter",
        "",
        Array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "SECTION_ID" => $arResult["ID"],
            "FILTER_NAME" => "arrFilter",
            "PRICE_CODE" => "",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000",
            "CACHE_NOTES" => "",
            "CACHE_GROUPS" => "Y",
            "MOBILE_VERSION"=>"Y",
            "SAVE_IN_SESSION" => "N"
        ),
        false
    );?>
    
    <div class="catalog-filter__item">
	
        <div class="amount__wrap">
            <span class="amount__info"><?switch ($_REQUEST['FIELD1'].$_REQUEST['ORDER1']) {
                    case "showsasc":
                        echo "По популярности";
                        break;
                    case "CATALOG_PRICE_9asc":
                        echo "По возрастанию цены";
                        break;
                    case "CATALOG_PRICE_9desc":
                        echo "По убыванию цены";
                        break;
                    case "property_DIAMETRasc":
                        echo "По размеру";
                        break;
                   
                    default:
                        echo "По размеру";
                }?></span>
            <select class="amount__select">
                <option value="sort_size_asc">По размеру</option>
                <option value="sort_shows_asc">По популярности</option>
                <option value="sort_price_asc">По возрастанию цены</option>
                <option value="sort_price_desc">По убыванию цены</option>
            </select>
        </div>
    </div>
    
    <div class="catalog-filter__item">
	<a href="javascript:void(0);" class="white-btn filter-btn">Фильтр товаров</a>
    </div>
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
<a href="<?=$APPLICATION->GetCurPageParam('FIELD1=shows&ORDER1=asc', array('FIELD1', 'ORDER1', 'FIELD2', 'ORDER2'))?>" id="sort_shows_asc"></a>
<a href="<?=$APPLICATION->GetCurPageParam('FIELD1=CATALOG_PRICE_9&ORDER1=asc', array('FIELD1', 'ORDER1', 'FIELD2', 'ORDER2'))?>" id="sort_price_asc"></a>
<a href="<?=$APPLICATION->GetCurPageParam('FIELD1=CATALOG_PRICE_9&ORDER1=desc', array('FIELD1', 'ORDER1', 'FIELD2', 'ORDER2'))?>" id="sort_price_desc"></a>
<a href="<?=$APPLICATION->GetCurPageParam('FIELD1=property_DIAMETR&ORDER1=asc&FIELD2=property_DLINA&ORDER2=asc', array('FIELD1', 'ORDER1', 'FIELD2', 'ORDER2'))?>" id="sort_size_asc"></a>

	
    
						
<div class="sale-category">
    <table class="blue-table basket blue-table--first">
	<tbody class="blue-table__tbody">					
				
<?foreach ($arResult['ITEMS'] as $item):?>
            <?
            $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['PRICES'][ID_BASE_PRICE]['VALUE'];
            $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
            $size = array(
                $item['PROPERTIES']["DIAMETR"]["VALUE"],
                $item['PROPERTIES']["VYSOTA"]["VALUE"],
                $item['PROPERTIES']["SHIRINA"]["VALUE"],
                $item['PROPERTIES']["DLINA"]["VALUE"],
            );
            $size = array_diff($size, array(''));
            ?>
            <tr class="blue-table__tr">
		<td class="blue-table__td">
                    <div class="basket-infomedia">
			<div class="infomedia__img"><a href="<?=$item['DETAIL_PAGE_URL']?>" target="_self"><img src="<?=$item['PREVIEW_PICTURE']['src']?>" alt=""></a></div>
			<div class="infomedia__text">
                            <a href="<?=$item['DETAIL_PAGE_URL']?>" target="_self" class="infomedia__link"><?=$item['NAME']?></a>
                            <span class="carousel-product__price"><?echo number_format($price, 2, '.', ' ');?> ₽ <span class="carousel-product__price-wrap"><?if($old_price){?><span class="carousel-product__price-old"><?echo number_format($old_price, 2, '.', ' ');?> ₽</span><?}?></span></span>
                            <span class="availability-b<?echo ($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']) ? " active" : "";?>"><? echo ($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']) ? "В наличии" : "Нет в наличии";?></span>
                            <span class="infomedia__articul">Артикул: <span><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></span>
                            <span class="infomedia__size">Размер, мм: <span><?=implode($size, 'x');?></span></span>
                            <?if($ral_in_ar):?>
                            <span class="infomedia__massa">Цвет, RAL: <div class="color-b"><i style="background: #<?=$array_rals[$item['PROPERTIES']["TSVET"]["VALUE"]]?>;"></i><?=$item['PROPERTIES']["TSVET"]["VALUE"]?></div></span>
                            <?endif;?>
                            <span class="infomedia__massa">Фасовка, шт: <span><?=$item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"]?></span></span>
                            <a href="javascript:void(0);" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" class="blue-btn basket-btn">В корзину</a>
			</div>
                    </div>
		</td>
            </tr>
	<?endforeach;?>

	</tbody>
    </table>
</div>				
<?  
if ($showBottomPager)
{
	?>
	
		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	
	<?
}

if($arResult["UF_RELATED"]){
?>
<h2 class="s22-title">Сопутствующие товары</h2>
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

<?if(isset($arResult['DESCRIPTION'])){
  echo html_entity_decode($arResult['DESCRIPTION'], ENT_QUOTES, "UTF-8"); 
}
?>
<script>
$('.amount__select').on('change', function() {
        $('.amount__info').text($(".amount__select option:selected").text());
        
        $('#'+this.value).click();
        $(".amount__select :contains('Сначала по цене')").attr("selected", "selected"); 
        
});
$(".amount__select :contains('"+$('.amount__info').text()+"')").attr("selected", "selected");
</script>
<script>
//filter
BX.ready(function(){
$('.filter-btn').click(function() {
    
    $('.main-filter').toggleClass('show');
    $('.header-fade').toggleClass('show');
    
    return false;
});
//checkbox
$('.checkbox__label').click(function(){
     $(this).toggleClass('checked');
});
$('.main-filter__btn').click(function(){
    $('.header-fade').removeClass('show');
});
//colorbox show all
$(".checkbox-color__all").click(function() {
    $(this).addClass('disable');
    $('.checkbox__item--color .checkbox__item').addClass('visible');
    return false;
});
$('.filter-close').click(function() {
    $('.main-filter').removeClass('show');
     $('.header-fade').removeClass('show');
   
});
});
</script>



                