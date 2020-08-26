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
	
<?if(!$_POST['ENUM_LIST']['ELEMENTS'] && !$arParams["DISABLE_HEADER"]=='Y'){?>
<!--page-heading-->
            <header class="basic-layout__module page-heading">
               <h1 class="page-heading__title"><?=($arResult['META_TITLE']) ? $arResult['META_TITLE'] :$arResult['NAME'];?></h1>
            </header>
<!--page-heading-->
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
                        <a class="product-data__link" href="<?=$arResult['CERT_URL'];?>" title='Сертификаты на <?=$arResult['CERT_NAME'];?>'>Сертификаты на <?=$arResult['CERT_NAME'];?></a>
                    <?endif;?>

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
                        <p class="category-card__title"><a class="category-card__link" href="<?=$soput_itme['CODE']?>/"><?=$soput_itme['NAME']?></a></p>
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
			<div class="catalog-feed__tabs">
                  <button class="catalog-feed__filter" id="catalog-filter-trigger"><i class="simple-filter-icon"></i>Фильтр</button>
            </div>	
<?
}

?>
				
    <div class="catalog-feed__list">
	
    
				
			
				
<?php
	//if ($_SERVER['REQUEST_URI']=="/krepezh/samorezy/samorezy_po_derevu/ostrye_pd/") file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt', print_r($arResult['SIZES'], true));

    foreach($arResult['SIZES'] as $key=>$size){
        
        $index=0;
        foreach ($size as $item)
        {
			
            
            $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'];
            $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        ?>
        
        <div class="catalog-feed__table">
            <!--catalog-table-->
                <section class="catalog-table">
				
				
					<div class="catalog-table__column catalog-table__column--basic <?=$index>0 ? " is-merged" : "groupped";?>">
					<?if($item['PREVIEW_PICTURE']['src'] || $item['DETAIL_PICTURE']['src']):?>
		<div class="item_img_block">
					<img src="<?=$item['PREVIEW_PICTURE']['src'] ? $item['PREVIEW_PICTURE']['src'] : $item['DETAIL_PICTURE']['SRC']?>" alt="<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?> <?=$item['SIZES']?>" title="<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?> <?=$item['SIZES']?>" />
					<div><?=($item['PROPERTIES']['ROOT_NAME']['VALUE']) ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME'];?></div>
					</div>	
<?endif?>					
                        <div class="catalog-table__title">Размер, мм<small>:</small></div>						
                        <h3 class="catalog-table__content"><span class="catalog-table__desc"><strong><?=$item['SIZES']?></strong></span></h3>
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
                            <a class="catalog-table__link" href="<?=$item['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($item['PROPERTIES']['ROOT_NAME']['VALUE'] ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME']))?>')" target="_self"><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></a>
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
							<span class="delivery-view"  data-product="<?=$item['ID']?>">
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
					<div class="catalog-table__column catalog-table__column--basic">
                        <div class="catalog-table__title"><?=$field['NAME']?><small>:</small></div>
                           <div class="catalog-table__content">
								<p class="catalog-table__desc"><?=mb_strimwidth($item['PROPERTIES'][$field['CODE']]["VALUE"], 0, 12, "...");?></p>
                        </div>
					</div>
            
			<?}
		}?>

					<div class="catalog-table__column catalog-table__column--state">
                           <div class="catalog-table__title">Наличие<small>:</small></div>
                           <div class="catalog-table__content">
							<?if($item['STORE'][$DEFAULT_STORE_ID]['AMOUNT'])
							{?>
								<p class="catalog-table__state"><i class="simple-state-yes-icon catalog-table__available"></i><?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?> уп.</p>
							<?}else{?>
								<p class="catalog-table__state catalog-table__state--notafs">Под заказ</p>
							<?}?>
                           </div>
                    </div>
					
					<div class="catalog-table__column catalog-table__column--to-cart">
                           <div class="catalog-table__title">Стоимость<small>:</small></div>
                           <div class="catalog-table__content catalog-table__content--to-cart">
                              <!--price-in-table-->
                              <div class="price-in-table">
                                 <p class="price-in-table__actual"><?=number_format($price, 2, '.', ' ');?> ₽</p>
								 <?if($old_price){?>
								 <p class="price-in-table__legacy"><?=number_format($old_price, 2, '.', ' ');?> ₽</p>
								 <?}?>
								 <?if($item['PRICE_FOR_ONE']){?>
                                 <p class="price-in-table__units"><?=$item['PRICE_FOR_ONE']?> ₽ за <?=$item['UNIT']?></p>
								 <?}?>
                              </div>
                              <!--price-in-table-->
							  <input type="hidden" name="" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" onchange='ChangeInputCart("<?=$item['NAME']?>", $(this))' id="QUANTITY_<?=$item['ID']?>" value="1" class="value__input">
                              <button class="catalog-table__to-cart" data-product="<?=$item['ID']?>" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>"><i class="colored-cart-icon catalog-table__cart" data-product="<?=$item['ID']?>" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>"></i>Добавить в корзину</button>
                           </div>
                    </div>
            
	   
	
                                                        
		</section>
        <!--catalog-table-->
		</div>
			
<?php
        }
    }
?>

					
    
</div>
</div>


		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	

<?

if(!$_POST['ENUM_LIST']['ELEMENTS'] && !$arParams["DISABLE_HEADER"]=='Y')
{
if($arResult["UF_RELATED"]){
?>
<br><br>
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
                        <p class="category-card__title"><a class="category-card__link" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a></p>
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
<!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content wysiwyg-block">
			   <?=html_entity_decode($arResult['UF_DETAIL_TEXT'], ENT_QUOTES, "UTF-8");?>
			   </div>
            </div>
            <!--simple-article-->
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

		