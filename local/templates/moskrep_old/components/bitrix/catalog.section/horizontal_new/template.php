<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


global $APPLICATION;
global $DEFAULT_STORE_ID;
include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");
$ral_in_ar = $arResult['ITEMS'][0]['PROPERTIES']["TSVET"]["VALUE"];

//Параметр FOR_SEO устанавливается если это раздел справочника, а не каталога
//А значит текст и заголовок(шапка) не берутся из каталога, а из справочника, значит условие FOR_SEO != Y
if($arParams['FOR_SEO']!='Y'){
    

    $APPLICATION->SetPageProperty('title', $arResult["NAME"].", цена - купить в интернет-магазине в Москве");

    $clock = date('G');
	
	
    ?>
<?if(!$_POST['ENUM_LIST']['ELEMENTS']){?>
<h1 class="s38-title"><?=($arResult['META_TITLE']) ? $arResult['META_TITLE'] :$arResult['NAME'];?></h1>
<?if($arResult['DESCRIPTION']):?>
<div class="catalog-view">
    <div class="catalog-view__photo">
        <a href="<?=$arResult['PICTURE']['SRC']?>"  onclick="javascript:void();" rel="catalog-photo" class="catalog-photo-view__link">
            <img src="<?=$arResult['PICTURE_RESIZE']['src']?>" alt="<?=$arResult['NAME']?>">
        </a>
    </div>
    <div class="catalog-view__text">
        <?
        //ТОЛЬКО ПЕРВЫЙ ПАРАГРАФ $paragraph_first(ПОКА НЕ НУЖНО
        if(strpos(html_entity_decode($arResult['DESCRIPTION'], ENT_QUOTES, "UTF-8"), '</p>')):
        $paragraph=explode('<p>', html_entity_decode($arResult['DESCRIPTION'], ENT_QUOTES, "UTF-8"));
        $paragraph_first=explode('</p>', $paragraph[1]);
        $paragraph_first=$paragraph_first[0];
        else:
            
          $paragraph_first =html_entity_decode($arResult['DESCRIPTION'], ENT_QUOTES, "UTF-8"); 
        endif;
?>		<div class='catalog-view__head'>
        <?=$arResult['DESCRIPTION']?>
		</div>
		
		<a href="javascript:void(0);" class="catalog-head__more">Подробнее</a>
    </div>
	
    <?if($arResult['GENERAL_PROPERTIES']){?>
    <nav class="info-nav-list">
	<ul class="info-nav-list__items">
            <?foreach($arResult['GENERAL_PROPERTIES'] as $key=>$value){
            ?>
		<li class="info-nav-list__item"><strong><?=$key?></strong><span><?=$value?></span></li>
		
            <?}?>
        <?if($arResult['CERT_URL']):?>
            <nav class="info-nav cert">
                <span class="info-nav__title">Информация:</span>
                <ul class="info-nav__items">
                    <?if($arResult['CERT_URL']):?>
                        <li class="info-nav__item"><a href="<?=$arResult['CERT_URL'];?>" title='Сертификаты на <?=$arResult['CERT_NAME'];?>' class="info-nav__link">Сертификаты на <?=$arResult['CERT_NAME'];?></a></li>
                    <?endif;?>

                </ul>
            </nav>
        <?endif;?>
	</ul>
    </nav>
    <?}?>

    
</div>
<?endif;?>



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

<?if($arResult['UF_SOPUT_SPR_ITMES']){
	
	foreach($arResult['UF_SOPUT_SPR_ITMES'] as $soput_itme){
		?>
<div class="sorting_item">
    <a href="<?=$soput_itme['CODE']?>/" class="sorting_link">
                    
                        <span class="sorting_title"><?=$soput_itme['NAME']?></span>
                    </a>
                </div>
<?
	}
}
}?>
<div class="sale-category sale-category--new" style='margin-top: 30px !important; <?=($_SERVER['HTTP_HOST']=='spb.krep-komp.ru' && $ral_in_ar) ? 'width:763px' : ($_SERVER['HTTP_HOST']=='spb.krep-komp.ru' ? 'width:741px' : '');?>'>
    <table class="blue-table full price-category <?=($ral_in_ar || $arResult['ORIGINAL_PARAMETERS']['EXTRA_FIELD'] || $arResult['EXTRA_FIELD']) ? 'blue-table__8-rows' : 'blue-table__7-rows';?>">
	<thead class="blue-table__thead">
            <tr class="blue-table__tr">
                <th class="blue-table__th blue-table__name"><span class='link-sorting'><span class="link-sorting__style">Размер, мм</span></span></th>
                
                <th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Фасовка</span></span></th>
				<?if(!$arResult['ENUM_LIST']['TURN_OFF_ARTICUL'] && !$_POST['ENUM_LIST']['TURN_OFF_ARTICUL'])
				{?>
				<th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Артикул</span></span></th>
				<?}?>
                <?if(!$arResult['ENUM_LIST']['TURN_OFF_DELIVERY'] && !$_POST['ENUM_LIST']['TURN_OFF_DELIVERY'])
				{?>
					
					<th class="blue-table__th"><span class="link-sorting"><span class="link-sorting__style">Получение</span></span></th>
					
				<?}?>
                
            <?if($ral_in_ar){?>
				<th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Цвет, RAL</span></span></th>
            <?}?>
			<?if($arResult['EXTRA_FIELD']){
				foreach($arResult['EXTRA_FIELD'] as $field){?>
				<th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style"><?=$field['NAME']?></span></span></th>
				<?}
			}?>
            <th class="blue-table__th"><span class="link-sorting"><span class="link-sorting__style">Наличие</span></span></th>    
			<th class="blue-table__th blue-table__price"><span class='link-sorting'><span class="link-sorting__style">Цена (с НДС)</span></span></th>
			<th class="blue-table__th">Купить</th>
	    </tr>
	</thead>
    <tbody class="blue-table__tbody">
						
			
				
<?php
	//if ($_SERVER['REQUEST_URI']=="/krepezh/samorezy/samorezy_po_derevu/ostrye_pd/") file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt', print_r($arResult['SIZES'], true));

    foreach($arResult['SIZES'] as $key=>$size){
        
        $index=0;
        foreach ($size as $item)
        {
			
            
            $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'];
            $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        ?>
        
        
        <tr class="blue-table__tr">
            <?if($index==0){?>
            <td rowspan='<?=count($size);?>' class="blue-table__td"><strong class="!name-b"><?=$item['SIZES']?>
                    <div class="name-b__photo">
                        <img src="<?=$item['PREVIEW_PICTURE']['src']?>" alt='<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?>' />
                    </div>
                </strong></td>
	    <?
            
            }
            $index++;
            ?>
           
            <td class="blue-table__td">
					<div class="item_img_block">
					<img src="<?=$item['PREVIEW_PICTURE']['src']?>" alt='<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?>' />
					<div><?=($item['PROPERTIES']['ROOT_NAME']['VALUE']) ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME'];?></div>
					</div>
			<span class="articul-b">
			<a class="name_b" href="<?=$item['DETAIL_PAGE_URL']?>" target="_self"><?=($item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"]) ? $item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"] : '1';?> <?=$item['UNIT']?></a></span></td>
            <?if(!$arResult['ENUM_LIST']['TURN_OFF_ARTICUL'] && !$_POST['ENUM_LIST']['TURN_OFF_ARTICUL'])
				{?>
			<td class="blue-table__td"><span class="articul-b"><a href="<?=$item['DETAIL_PAGE_URL']?>" target="_self"><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?>
                    </a></span></td>
			<?}?>
	        <?if(!$arResult['ENUM_LIST']['TURN_OFF_DELIVERY'] && !$_POST['ENUM_LIST']['TURN_OFF_DELIVERY'])
				{?>
			
		   <td class="blue-table__td">
								<span class="pickup-view" data-product="<?=$item['ID']?>">
									<div id='pickup_<?=$item['ID']?>' class="pickup-block">
										
									</div>
								</span>
								<span class="delivery-view"  data-product="<?=$item['ID']?>">
									<div id='delivery_<?=$item['ID']?>' class="delivery-block">
										
									</div>
								</span>
							</td>
			
				<?}?>
			
		<?if($ral_in_ar){?>
            <td class="blue-table__td"><div class="color-b"><i style="background: #<?=$array_rals[$item['PROPERTIES']["TSVET"]["VALUE"]]?>;"></i><?=$item['PROPERTIES']["TSVET"]["VALUE"]?></div></td>
        <?}?>
		<?if($arResult['EXTRA_FIELD']){
			foreach($arResult['EXTRA_FIELD'] as $field){?>
            <td class="blue-table__td"><div class="color-b"><?=mb_strimwidth($item['PROPERTIES'][$field['CODE']]["VALUE"], 0, 12, "...");?></div></td>
			<?}
		}?>
        <td class="blue-table__td">
		<?echo ($item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']) ? '<span class="availability-b active">'.($item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']).' уп. </span>' : '<span class="availability-b">Под заказ</span>';?></td>    
	    <td class="blue-table__td blue-table__price">
	        <span class="price-b"><?echo number_format($price, 2, '.', ' ');?> ₽</span>
                <?echo ($old_price) ? '<span class="carousel-product__price-old">'.number_format($old_price, 2, '.', ' ').' ₽</span>': '';?> 
				<?if($item['PRICE_FOR_ONE']){?>
					<br><span class="price-b" style="font-size: 0.8rem;line-height: 1.9;color: darkslategray;font-family: inherit;color: #6d6d6d;">
						<?=$item['PRICE_FOR_ONE']?> ₽ за <?=$item['UNIT']?>
					</span>
				<?}?>
		
            </td>
	    <td class="blue-table__td">
		<div class="value">
		    <a href="javascript:void(0)" rel="nofollow" class="value__minus">—</a>
			<input type="text" name="" data-quantity="<?=($item['STORE'][$DEFAULT_STORE_ID]['AMOUNT'])?>" onchange='ChangeInputCart("<?=$item['NAME']?>", $(this))' id="QUANTITY_<?=$item['ID']?>" value="1" class="value__input">
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

if(!$_POST['ENUM_LIST']['ELEMENTS'])
{
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
              
                <img src="<?=$renderImage['src']?>"  alt="">
            </div>
            <div class="card-nav-text"><?=$arSection['NAME']?></div>
        </a>
    </li><?
}
?>
</ul>
<?}?>

<?if(count($arResult["UF_SURFACE"])):?>
<div class="blue-block">Типы оснований</div>
<div class="surface-block-container">
<?foreach($arResult["UF_SURFACE"] AS $surface):?>
<div class="surface-block">
<div class="surface-inblock">
<div class="surface-image" style="background: url(<?=$surface["IMG"]?>) no-repeat;"></div>
<div class="surface-name"><span><?=$surface["NAME"]?></span></div>
</div>
</div>
<?endforeach?>
</div>
<?endif?>

<?if($arResult['UF_DETAIL_TEXT']):?>
<div class='set-default-parametr-page-cat'><?=html_entity_decode($arResult['UF_DETAIL_TEXT'], ENT_QUOTES, "UTF-8");?></div>
<?endif;?>
<?}?>
<script>
BX.ready(function () {
    var buyBtnDetail = document.body.querySelectorAll('.basket-btn');
	var IDs=[];
	var sum=0;
    for (var i = 0; i < buyBtnDetail.length; i++) {
     
		
	IDs.push(buyBtnDetail[i].dataset.product);
	sum =  sum+Number(buyBtnDetail[i].dataset.price);
		
    
    }
	
	
	
	console.log(IDs);
	console.log(sum);
	
	
});
</script>

		