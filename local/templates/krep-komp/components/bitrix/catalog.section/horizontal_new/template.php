<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


global $APPLICATION;
global $DEFAULT_STORE_ID;
include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");
$ral_in_ar = $arResult['ITEMS'][10]['PROPERTIES']["TSVET"]["VALUE"];

//Параметр FOR_SEO устанавливается если это раздел справочника, а не каталога
//А значит текст и заголовок(шапка) не берутся из каталога, а из справочника, значит условие FOR_SEO != Y
if($arParams['FOR_SEO']!='Y'){
    

    $APPLICATION->SetPageProperty('title', $arResult["NAME"].", цена - купить в интернет-магазине в Москве");

    $clock = date('G');
	
	
    ?>

<?if(!$_POST['ENUM_LIST']['ELEMENTS'] && !$arParams["DISABLE_HEADER"]=='Y'){?>

<?globalGetTitle($arResult['META_TITLE'] ? $arResult['META_TITLE'] : $arResult['NAME'])?>

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

<div class="page_count_panel">

<div class="page_count_panel_viewblock">Показано <?=count($arResult['ITEMS'])?> из <?=$arResult['NAV_RESULT']->NavRecordCount?> товаров</div>

<div class="page_count_panel_block">
<select name="page_element_count" id="page_element_count">
	<?foreach(PAGE_ELEMENT_COUNT as $page_element_count)
	{?>
          <option value="<?=$page_element_count?>" <?=($arParams['PAGE_ELEMENT_COUNT'] == $page_element_count) ? 'selected="selected"' : '';?>>Показывать: по <?=$page_element_count?></option>
	<?}?>
</select>
</div>
</div>
<?}?>
<!--catalog-feed-->
    <div class="table table--category">

		<div class="table__head">
            <div class="table__topic">Размер, мм</div>
            <div class="table__topic">Фасовка</div>
			<?
			if(!$arResult['ENUM_LIST']['TURN_OFF_ARTICUL'] && !$_POST['ENUM_LIST']['TURN_OFF_ARTICUL'])
			{?>
            <div class="table__topic">Артикул</div>
			<?}?>
			<?if($ral_in_ar){?>
			<div class="table__topic">Цвет, RAL</div>
			<?}?>
			<?if($arResult['EXTRA_FIELD']){
				foreach($arResult['EXTRA_FIELD'] as $field){?>
			<div class="table__topic"><?=$field['NAME']?></div>
			<?}
			}?>
			<div class="table__topic">Наличие</div>
            <div class="table__topic">Цена (с НДС)</div>
            <div class="table__topic"></div>
        </div>
    
	
    
				
			
				
<?php
	//if ($_SERVER['REQUEST_URI']=="/krepezh/samorezy/samorezy_po_derevu/ostrye_pd/") file_put_contents($_SERVER["DOCUMENT_ROOT"].'/service/text.txt', print_r($arResult['SIZES'], true));
	
	
		?>
		<div class='table__body'>
		<?
    foreach($arResult['SIZES'] as $key=>$size){
		
		if(count($size)>1)
		{
		?>
			<div class='table__tr table__tr--modif'>
		<?
		}
        
        foreach ($size as $item)
        {
			
            
            $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'];
            $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        ?>
        
				<div class='table__tr'>
				
				

					<div class="table__td">				
                        <div class="table__size"><?=$item['SIZES']?></div>
						<div class="table__hidden">
							<div class="table__hidden__top">
								<img class="table__img" src="<?=$item['PREVIEW_PICTURE']['src']?>" alt='<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?>'>
								
							</div>
							<div class="table__name"><?=($item['PROPERTIES']['ROOT_NAME']['VALUE']) ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME'];?></div>
						</div>							
                    </div>
					
        
            <?
            $index++;
            ?>
					<div class="table__td">				
                        <div class="table__fasovka">
                            <a href="<?=$item['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($item['PROPERTIES']['ROOT_NAME']['VALUE'] ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME']))?>')" target="_self"><?=($item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"]) ? $item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"] : '1';?> <?=$item['UNIT']?></a>
                        </div>
                    </div>
            
            <?if(!$arResult['ENUM_LIST']['TURN_OFF_ARTICUL'] && !$_POST['ENUM_LIST']['TURN_OFF_ARTICUL'])
				{?>
					<div class="table__td">
                        <div class="table__articule">
                            <a href="<?=$item['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($item['PROPERTIES']['ROOT_NAME']['VALUE'] ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME']))?>')" target="_self"><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></a>
                        </div>
                    </div>
			
			<?}?>
	       
			
		<?if($ral_in_ar){?>
					<div class="table__td">
                        <div>
							<div class="color-b" width="34" height="19"><i style="background: #<?=$array_rals[$item['PROPERTIES']["TSVET"]["VALUE"]]?>;"></i></div>
                            <p class="catalog-table__desc"><?=$item['PROPERTIES']["TSVET"]["VALUE"]?></p>
                        </div>
                    </div>
            
        <?}?>
		<?if($arResult['EXTRA_FIELD']){
			foreach($arResult['EXTRA_FIELD'] as $field){?>
					<div class="table__td" data-code="<?=$field['CODE']?>"><?$item['PROPERTIES'][$field['CODE']]["VALUE"] ? $view[$field['CODE']]=true : "";?>
						<div>
								<?=mb_strimwidth($item['PROPERTIES'][$field['CODE']]["VALUE"], 0, 12, "...");?>
                        </div>
					</div>
            
			<?}
		}?>

					<div class="table__td">
                        <div class="table__availability <?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] ? '' :' table__availability--impability';?>">
							<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?> уп.
						</div>
                    </div>
					
					<div class="table__td table__td--end">
						<div class='table__prices'>
							<div class="table__prices__top">
							<?if($old_price)
							{
							?>
                              
                                <div class="table__price table__price--new"><?=number_format($price, 2, '.', ' ');?> ₽</div>
								<div class="table__price table__price--old"><?=number_format($old_price, 2, '.', ' ');?> ₽</div>
							<?}else{?>
								<div class='table__price'><?=number_format($price, 2, '.', ' ');?> ₽</div>
							<?}?>
								 
							</div>
							<?if($item['PRICE_FOR_ONE']){?>
							<div class="table__price table__price--forone"><?=$item['PRICE_FOR_ONE']?> ₽ за <?=$item['UNIT']?></div>
							<?}?>
                              
							  
                        </div>     
                    </div>
                    
					<div class="table__td">
					<input type="hidden" name="" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" onchange='ChangeInputCart("<?=$item['NAME']?>", $(this))' id="QUANTITY_<?=$item['ID']?>" value="1" class="value__input">
                              <div class="table__add" data-product="<?=$item['ID']?>" data-quantity="<?=$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>"> </div>
                    </div>
            
	   
	
                                                        
		
				</div>
			
<?php
		//FOR MOBILE VERSION
		$mobile_boxes .= "<div class='table__box'> 
							<div class='table__leftside'> 
								<div class='table__topside'><img class='table__img' src='".$item['PREVIEW_PICTURE']['src']."'></div>
							</div>
							<div class='table__rightside'>
								<div class='table__item'> 
									<div class='table__name'>";
									$mobile_boxes .= ($item['PROPERTIES']['ROOT_NAME']['VALUE']) ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME'];
									$mobile_boxes .= "</div>
								</div>
								<div class='table__item'>
									<div class='table__td'>
										<div class='table__name'>Размер</div>
										<div class='table__fasovka'>".$item['SIZES']."</div>
									</div>
									<div class='table__td'>
										<div class='table__name'>Артикул</div>
										<div class='table__articule'>".$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]."</div>
									</div>
									<div class='table__td'>
										<div class='table__name'>Наличие</div>
										<div class='table__fasovka'>".$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']." уп.</div>
									</div>
								</div>
								<div class='table__item'>
									<div class='table__prices'>
										<div class='table__prices__top'>
											<div class='table__price";
											$mobile_boxes .= $old_price ? " table__price--new" : "";
											$mobile_boxes .= "'>".number_format($price, 2, '.', ' ')." ₽</div>";
											$mobile_boxes .= $old_price ? "<div class='table__price table__price--old'>".number_format($old_price, 2, '.', ' ')." ₽</div>" : "";
										$mobile_boxes .= "</div>";
										$mobile_boxes .= $item['PRICE_FOR_ONE'] ? "<div class='table__price table__price--forone'>".$item['PRICE_FOR_ONE']." ₽ за ".$item['UNIT']."</div>" : "";
									$mobile_boxes .= "</div>
									<div class='table__add' data-product='{$item['ID']}' data-quantity='{$item['STORE'][$DEFAULT_STORE_ID]['AMOUNT']}' data-name='{$item['NAME']}' data-price='{$price}'>В корзину</div>
								</div>
							</div>
							</div>";
		$arProductsID .= '"'.$item['ID'].'",';
		
        }
		if(count($size)>1)
		{
		?>
			</div>
		<?
		}
    }
?>

		</div>			
    
</div>
<div class='table__mobile'>
	<? echo $mobile_boxes; ?>
</div>

		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	

<?

if(!$_POST['ENUM_LIST']['ELEMENTS'] && !$arParams["DISABLE_HEADER"]=='Y')
{
if($arResult["S_ETIM_TOVAROM"]){
?>
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

<?if($arResult['UF_DETAIL_TEXT'] && !($_REQUEST['PAGEN_1'] > 1)  && ($_SERVER['HTTP_HOST']=='spb.krep-komp.ru' || $_SERVER['HTTP_HOST']=='krep-komp.ru')):?>
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

		