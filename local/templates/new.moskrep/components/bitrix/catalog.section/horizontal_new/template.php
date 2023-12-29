<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


global $APPLICATION;
global $DEFAULT_STORE_ID;
global $filterObj;
global $request;
global $arFilter_soput;
include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");
$ral_in_ar = $arResult['ITEMS'][10]['PROPERTIES']["TSVET"]["VALUE"];

//Параметр FOR_SEO устанавливается если это раздел справочника, а не каталога
//А значит текст и заголовок(шапка) не берутся из каталога, а из справочника, значит условие FOR_SEO != Y
if($arParams['FOR_SEO']!='Y'){
    

    if(empty($APPLICATION->GetPageProperty('title')))
		$APPLICATION->SetPageProperty('title', $arResult["NAME"].", цена - купить в интернет-магазине в Москве");

    $clock = date('G');
	
	
    ?>
	

<?if(!$arParams["DISABLE_HEADER"]=='Y'){?>

<?globalGetTitle($APPLICATION->GetPageProperty('page_title') ? $APPLICATION->GetPageProperty('page_title') : ($arResult['META_TITLE'] ? $arResult['META_TITLE'] : $arResult['NAME']))?>

<?if($arResult['DESCRIPTION']):?>
	<div class="basic-layout__module catalog-desc">
        <div class="catalog-desc__cover">
            <img class="catalog-desc__image" src="<?=$arResult['PICTURE']['SRC']?>" width="226" height="170" alt="<?=($arResult['META_TITLE']) ? $arResult['META_TITLE'] :$arResult['NAME'];?>" title="<?=($arResult['META_TITLE']) ? $arResult['META_TITLE'] :$arResult['NAME'];?>" />
        </div>
		<p class="catalog-desc__about">
        <?=strip_tags($arResult['DESCRIPTION']);?>
		</p>
	
    <?if($arResult['GENERAL_PROPERTIES']){?>
    <!--product-data-->
        <div class="catalog-desc__data product-data">
            <ul class="product-data__list">
            <?foreach($arResult['GENERAL_PROPERTIES'] as $key=>$value){
            ?>
				<li class="product-data__item"><p class="product-data__name"><?=$key?></p><p class="product-data__text"><?=$value?></p></li>
		
            <?}?>
			</ul>
		
        <?if($arResult['CERT_URL']):?>
            <div class="product-data__more">
                <p class="product-data__title">Информация:</p>
                <ul class="info-nav__items">
                    <?if($arResult['CERT_URL']):?>
						<li>
							<a class="product-data__link" href="<?=$arResult['CERT_URL'];?>" title='Сертификаты на <?=$arResult['CERT_NAME'];?>'>Сертификаты на <?=$arResult['CERT_NAME'];?></a>
						</li>
                    <?endif;?>
					<?if($arResult["UF_YOUTUBE"]){?>
						<li>
							<a class="product-data__link youtube" href="#youtube">Видеообзор</a>
						</li>
					<?}?>

                </ul>
            </div>
        <?endif;?>
		</div>
	<!--product-data-->
    <?}?>
</div>
<!--catalog-desc-->
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

<?
//ФИЛЬТРОВЫЕ КНОПКИ ДЛЯ ПОСАДОЧНЫХ СТРАНИЦ
if($arResult['SORTING']['SECTION_ID'] && $arParams['DISPLAY_FILTER_BUTTONS']=='Y'){
    ?>

    <?

    foreach($arResult['SORTING']['SECTIONS'] as $sortSection){
        if($sortSection['TOP']){
            ?>

            <ul class="category-blocknew__list">
                <?$i=0;?>
                <?foreach($sortSection['ITEMS'] as $sort_item):?>
                    <?$i++;
                    $link =  $filterObj->sec_builder->linkBuilder($sort_item, $sortSection);

                    ?>

                    <li class="category-blocknew__item" >
                        <a href="<?=$link?>" <?=($sort_item['LINK_TARGET']['VALUE']) ? "target='_self'" : "";?> class="category-block__link <?=$sort_item['IS_ACTIVE']?>">
                            <?=$sort_item['NAME']?>
                        </a>
                    </li>
                <?endforeach;?>
            </ul>

            <?
        }
    }

}
?>



    <div id="shops-window"><div class="win"></div></div>
<div class="page_count_panel">


<div class="page_count_panel_viewblock">Показано <?=count($arResult['ITEMS'])?> из <?=$arResult['NAV_RESULT']->NavRecordCount?> товаров</div>



<div class="page_count_panel_block">


<a id="view_wholesale" href="javascript:void(0);" rel="nofollow" class="blue-btn page_count_panel_viewblock_btn">Оптовые скидки</a>



<select name="page_element_count" id="page_element_count">
	<?foreach(PAGE_ELEMENT_COUNT as $page_element_count)
	{?>
          <option value="<?=$page_element_count?>" <?=($arParams['PAGE_ELEMENT_COUNT'] == $page_element_count) ? 'selected="selected"' : '';?>>Показывать: по <?=$page_element_count?></option>
	<?}?>
</select>
    <?if($arParams["SELECT_PAGE_TEMPLATE"]!="N"){?>
        <select name="select_template" id="select_template">
            <option value="horizontal_new" selected="selected">Элементы: Таблицей</option>
            <option value="vertical" >Элементы: Блоками</option>
        </select>
    <?}?>
</div>
</div>

<!--catalog-feed-->
    <div class="basic-layout__module catalog-feed">
<?if($arResult['UF_SOPUT_SPR_ITMES']){
	?>
	        <div class="catalog-feed__other">
		<?
		foreach($arResult['UF_SOPUT_SPR_ITMES'] as $soput_itme){
			
		?>
					<div class="catalog-feed__child">
                     <!--category-card-->
                     <div class="category-card">
                        <p class="category-card__title"><a class="category-card__link" href="<?=$soput_itme['FULL_URL']?>/"><?=$soput_itme['NAME']?></a></p>
                        <div class="category-card__cover">
                          <!-- <img class="category-card__image" src="uploads/category-card/cover-01.jpg" width="120" height="76" alt=""> -->
                        </div>
                     </div>
                     <!--category-card-->
					</div>

<?
		}
				?></div>
			
		<!--catalog-feed--><?	

	}?>
	
			<?$this->SetViewTarget('catalogFilterClass');?>
                  catalog
			<?$this->EndViewTarget();?>



	
			<div class="catalog-feed__tabs">
			<?$this->SetViewTarget('catalogFilter');?>
                  <button class="catalog-feed__filter" id="catalog-filter-trigger2"><i class="simple-filter-icon"></i>Фильтр</button>
			<?$this->EndViewTarget();?> 
			<div id="filter__catalog_desktop"><button class="catalog-feed__filter" id="catalog-filter-trigger"><i class="simple-filter-icon"></i>Фильтр</button></div>	
            </div>	
<?
}

?>
				
    <div class="catalog-feed__list">
	
    
				
			
				
<?php
	//if ($_SERVER['REQUEST_URI']=="/krepezh/samorezy/samorezy_po_derevu/ostrye_pd/") file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt', print_r($arResult['SIZES'], true));
	
	$size_index=0;

    foreach($arResult['SIZES'] as $key=>$size){
        
        $index=0;
		$size_index++;
        foreach ($size as $item)
        {
			
            
            $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'] ? $item['MIN_PRICE']['VALUE'] : $item['PRICES'][ID_BASE_PRICE]['VALUE'];
            $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        ?>
        
        <div class="catalog-feed__table">
            <!--catalog-table-->
                <section class="catalog-table">
				
				

					<div class="catalog-table__column catalog-table__column--basic <?=$index>0 ? " is-merged is-merged-{$index}" : "groupped";?>">				
                        <div class="catalog-table__title">Размер, мм<small>:</small></div>
		<div class="item_img_block">
					<img src="<?=$item['PREVIEW_PICTURE']['src']?>" alt='<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?>' />
					<div><?=($item['PROPERTIES']['ROOT_NAME']['VALUE']) ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME'];?></div>
					</div>							
                        <div class="catalog-table__content">							
						<span class="catalog-table__desc"><strong><?=$item['SIZES']?></strong></span></div>

                    </div>
					
        
            <?
            $index++;
            ?>
					<div class="catalog-table__column catalog-table__column--basic">				
                        <div class="catalog-table__title">Фасовка<small>:</small></div>
                        <div class="catalog-table__content">
                            <a class="catalog-table__link" href="<?=$item['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($item['PROPERTIES']['ROOT_NAME']['VALUE'] ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME']))?>')" target="_self"><?=($item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"]) ? $item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"] : '1';?> <?=$item['UNIT']?></a>
                        </div>
                    </div>

            
            <?if(!$arResult['ENUM_LIST']['TURN_OFF_ARTICUL'] && !$_POST['ENUM_LIST']['TURN_OFF_ARTICUL'])
				{?>
					<div class="catalog-table__column catalog-table__column--basic">
                        <div class="catalog-table__title">Артикул<small>:</small></div>
                        <div class="catalog-table__content">
                            <?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?>
                        </div>
                    </div>
			
			<?}?>
	        <?if(!$arResult['ENUM_LIST']['TURN_OFF_DELIVERY'] && !$_POST['ENUM_LIST']['TURN_OFF_DELIVERY'])
				{?>
			

					<div class="catalog-table__column catalog-table__column--basic">
					
									
						<div class="catalog-table__title">Получение<small>:</small></div>
                        <div class="catalog-table__content">
                            <span class="pickup-view" data-product="<?=$item['ID']?>">
									<div id='pickup_<?=$item['ID']?>' class="pickup-block">
										
									</div>
							</span>
							<span class="delivery-view" data-product="<?=$item['ID']?>">
									<div id='delivery_<?=$item['ID']?>' class="delivery-block">
										
									</div>
							</span>

                        </div>
					</div>
										
				<?}?>
			
		<?if($ral_in_ar){?>
					<div class="catalog-table__column catalog-table__column--color">
                        <div class="catalog-table__title">Цвет, RAL<small>:</small></div>
                           <div class="catalog-table__content">
							<div class="color-b" width="34" height="19"><i style="background: #<?=$array_rals[$item['PROPERTIES']["TSVET"]["VALUE"]]?>;"></i></div>
                            <p class="catalog-table__desc"><?=$item['PROPERTIES']["TSVET"]["VALUE"]?></p>
                        </div>
                    </div>
            
        <?}?>
		<?if($arResult['EXTRA_FIELD']){
			foreach($arResult['EXTRA_FIELD'] as $field){?>
					<div class="catalog-table__column catalog-table__column--basic" data-code="<?=$field['CODE']?>"><?$item['PROPERTIES'][$field['CODE']]["VALUE"] ? $view[$field['CODE']]=true : "";?>
					<?=$size_index==count($arResult['SIZES']) && $index==count($size) && !$view[$field['CODE']] ? "<script>$('.catalog-table__column[data-code=\"{$field['CODE']}\"]').hide();</script>" : ""?>
                        <div class="catalog-table__title"><?=$field['NAME']?><small>:</small></div>
                           <div class="catalog-table__content">
								<p class="catalog-table__desc"><?=mb_strimwidth($item['PROPERTIES'][$field['CODE']]["VALUE"], 0, 12, "...");?></p>
                        </div>
					</div>
            
			<?}
		}?>
				<?if($arResult['AMOUN_ALLOWED'])
				{
					?>
					<div class="catalog-table__column catalog-table__column--state">
                           <div class="catalog-table__title">Наличие<small>:</small></div>
                           <div class="catalog-table__content">
							<?if($item['STORE'][$DEFAULT_STORE_ID]['AMOUNT'])
							{?>
								<p class="catalog-table__state"><i class="simple-state-yes-icon catalog-table__available"></i><?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?> уп.</p>
							<?}else{?>
							<div class="pointer" data-product="<?=$item['ID']?>">
									<p class="catalog-table__state catalog-table__state--notafs"><span class='unavailable_pickup pointer'>Наличие уточнить</span></p>
							</div>
								
							<?}?>
                           </div>
                    </div>
				<?}?>
					
					<div class="catalog-table__column catalog-table__column--to-cart">
                           <div class="catalog-table__title">Цена (с НДС)<small>:</small></div>
                           <div class="catalog-table__content catalog-table__content--to-cart">
                              <!--price-in-table-->
                              <div class="price-in-table">
                                 <p class="price-in-table__actual" data-tooltip2="<?echo number_format($price, 2, '.', ' ');?>"><?=number_format($price, 2, '.', ' ');?> ₽</p>
								 <?if($old_price){?>
								 <p class="price-in-table__legacy" data-tooltip2="<?echo number_format($price, 2, '.', ' ');?>"><?=number_format($old_price, 2, '.', ' ');?> ₽</p>
								 <?}?>
								 <?if($item['PRICE_FOR_ONE']){?>
                                 <p class="price-in-table__units"><?=$item['PRICE_FOR_ONE']?> ₽ за <?=$item['UNIT']?></p>
								 <?}?>
                              </div>
                              <!--price-in-table-->
							  <div class='card-price-dop-contaiber' id='tooltip2'>
            <?if($item["DOP_PRICE"][0]):?><div class='card-price-dop'><b><?=$item["DOP_PRICE"][0]?> ₽</b> при заказе от 5 000₽</div><br><?endif?>
            <?if($item["DOP_PRICE"][1]):?><div class='card-price-dop'><b><?=$item["DOP_PRICE"][1]?> ₽</b> при заказе от 10 0000₽</div><br><?endif?>
            <?if($item["DOP_PRICE"][2]):?><div class='card-price-dop'><b><?=$item["DOP_PRICE"][2]?> ₽</b> при заказе от 15 000₽</div><br><?endif?>
			<?if($item["DOP_PRICE"][3]):?><div class='card-price-dop'><b><?=$item["DOP_PRICE"][3]?> ₽</b> при заказе от 20 000₽</div><br><?endif?>
			<?if($item["DOP_PRICE"][4]):?><div class='card-price-dop'><b><?=$item["DOP_PRICE"][4]?> ₽</b> при заказе от 25 000₽</div><br><?endif?>
			<?if($item["DOP_PRICE"][5]):?><div class='card-price-dop'><b><?=$item["DOP_PRICE"][5]?> ₽</b> при заказе от 100 000₽</div><br><?endif?>
			<?if($item["DOP_PRICE"][6]):?><div class='card-price-dop'><b><?=$item["DOP_PRICE"][6]?> ₽</b> при заказе от 500 000₽</div><?endif?>
			</div>
							  <input type="hidden" name="quantity-hidden" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" onchange='ChangeInputCart("<?=$item['NAME']?>", $(this))' id="QUANTITY_<?=$item['ID']?>" value="1" class="value__input">
                              <button class="catalog-table__to-cart" onmousedown="try { rrApi.addToBasket(<?=$item['ID']?>) } catch(e) {}" data-product="<?=$item['ID']?>" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>"><i class="colored-cart-icon catalog-table__cart" data-product="<?=$item['ID']?>" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>"></i>Добавить в корзину</button>
                           </div>
                    </div>
            
	   
	
                                                        
		</section>
        <!--catalog-table-->
		</div>
			
<?php
		$arProductsID .= '"'.$item['ID'].'",';
        }
    }
?>

					
    
</div>
</div>


		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
<?php echo htmlspecialchars_decode($arParams['SECTIONS_LIST_TEMPLATE']);?>
<?

if($arResult["UF_RELATED"]){
	?><div class='basic-layout__module page-heading'><h2>Сопутствующие товары</h2></div><?
	$arFilter_soput = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "SECTION_ID"=>$arResult["UF_RELATED"]);
	foreach($arResult['UF_SOPUT_PROPERTY'] as $soput_property)
	{
		$arProp = explode('=>', $soput_property);
		$arFilter_soput[$arProp[0]] = $arProp[1];
	}
	
			
?>
<div class="catalog-feed__other">
<?
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "ID"=>$arResult["UF_RELATED"], false, array("*"));
$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
while($arSection = $db_list->GetNext()) {
    $renderImage = CFile::ResizeImageGet($arSection["PICTURE"], Array("width" => 72, "height" => 72), BX_RESIZE_IMAGE_EXACT, false); 
    ?>
		<div class="catalog-feed__child">
                     <!--category-card-->
                     <div class="category-card">
                        <p class="category-card__title"><a class="category-card__link" href="<?=$arSection['SECTION_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arSection['NAME']))?>')"><?=$arSection['NAME']?></a></p>
                        <div class="category-card__cover">
                           <img class="category-card__image" src="<?=$renderImage['src']?>" width="120" height="76" alt="<?=$arSection['NAME']?>"> 
                        </div>
                     </div>
                     <!--category-card-->
		</div>
	<?
}
?>
</div>
<?}?>

<?

if(!$arParams["DISABLE_HEADER"]=='Y')
{
if($arResult["S_ETIM_TOVAROM"]){
?><!--Recommendation
<br><br>
<div class="recomend__title">Рекомендации</div>
<div class="catalog-feed__other">
<?
$arFilter = Array('IBLOCK_ID'=>$arParams['IBLOCK_ID'], "ID"=>$arResult["S_ETIM_TOVAROM"], false, array("*"));
$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
while($arSection = $db_list->GetNext()) {
    $renderImage = CFile::ResizeImageGet($arSection["PICTURE"], Array("width" => 172, "height" => 172), BX_RESIZE_IMAGE_EXACT, false); 
    ?>
		<div class="catalog-feed__child">
                     
                     <div class="category-card">
                        <p class="category-card__title"><a class="category-card__link" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a></p>
                        <div class="category-card__cover">
                           <img class="category-card__image" src="<?=$renderImage['src']?>" width="120" height="76" alt="<?=$arSection['NAME']?>"> 
                        </div>
                     </div>
                     
		</div>
	<?
}
?>
</div>end recomendation-->
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

<?if($arResult['UF_DETAIL_TEXT'] && !($_REQUEST['PAGEN_1'] > 1)  && ($_SERVER['HTTP_HOST']=='krep-komp.ru') && empty($arParams['REFERENCE']['DETAIL_TEXT'])):?>
<!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
			   <?=html_entity_decode($arResult['UF_DETAIL_TEXT'], ENT_QUOTES, "UTF-8");?>
			   </div>
            </div>
            <!--simple-article-->
<?endif;?>
<?}?>
<?if($arResult["UF_YOUTUBE"]):?>
<a name='youtube'></a>
<div class="blue-block">Видеообзор</div>

<div class="simple-article__content wysiwyg-block">
<?$arResult['UF_YOUTUBE'] = explode("|", $arResult['UF_YOUTUBE'])?>
<?foreach($arResult['UF_YOUTUBE'] AS $youtube):?>
<iframe class="youtube_video" width="100%" height="" src="https://www.youtube.com/embed/<?=$youtube;?>" title="<?=$arResult["NAME"]?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?endforeach?>
</div>
<?endif?>
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

<?global $userEmail;?>
<!-- Criteo Category / Listing dataLayer -->
<script type='text/javascript'>
        var dataLayer = dataLayer || [];
        dataLayer.push({            
            'event': 'crto_listingpage',
            crto: {             
                'email': '<?=$userEmail?>', //может быть пустой строкой
                'products': [<?=$arProductsID?>]
            }
        });
</script>
<!-- END Criteo Category / Listing dataLayer -->

<?php
if(!empty($arResult["EGOR_SCRIPT_AR"]))
{
    ?>
    <script type="application/ld+json">
        <?=json_encode($arResult["EGOR_SCRIPT_AR"], JSON_UNESCAPED_UNICODE);?>
    </script>
    <?php
}
?>

