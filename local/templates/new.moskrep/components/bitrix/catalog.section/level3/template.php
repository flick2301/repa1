<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

?>
<?
include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");
?>
<?
$ral_in_ar = $arResult['ITEMS'][0]['PROPERTIES']["TSVET"]["VALUE"];
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
			

            $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'];
            $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        ?>
        
        <div class="catalog-feed__table">
            <!--catalog-table-->
                <section class="catalog-table">
				
					<div class="catalog-table__column catalog-table__column--basic <?=$index>0 ? " is-merged" : "groupped";?>">
					<?if($item['PREVIEW_PICTURE']['src'] || $item['DETAIL_PICTURE']['SRC']):?>
		<div class="item_img_block">
					<img src="<?=$item['PREVIEW_PICTURE']['src'] ? $item['PREVIEW_PICTURE']['src'] : $item['DETAIL_PICTURE']['SRC']?>" alt="<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?> <?=$item['SIZES']?>" title="<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?> <?=$item['SIZES']?>" />
					<div><?=($item['PROPERTIES']['ROOT_NAME']['VALUE']) ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME'];?></div>
					</div>	
<?endif?>					
                        <div class="catalog-table__title">Размер, мм<small>:</small></div>
                        <div class="catalog-table__content"><span class="catalog-table__desc"><strong><?=$item['SIZES']?></strong></span></div>
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
					<div class="catalog-table__column catalog-table__column--basic" data-code="<?=$field['CODE']?>"><?$item['PROPERTIES'][$field['CODE']]["VALUE"] ? $view[$field['CODE']]=true : "";?>
					<?=$size_index==count($arResult['SIZES']) && $index==count($size) && !$view[$field['CODE']] ? "<script>$('.catalog-table__column[data-code=\"{$field['CODE']}\"]').hide();</script>" : ""?>
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
							<?if($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED'])
							{?>
								<p class="catalog-table__state"><i class="simple-state-yes-icon catalog-table__available"></i><?=$item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']?> уп.</p>
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
							  <input type="hidden" name="quantity-hidden" data-quantity="<?=$item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']?>" onchange='ChangeInputCart("<?=$item['NAME']?>", $(this))' id="QUANTITY_<?=$item['ID']?>" value="1" class="value__input">
                              <button class="catalog-table__to-cart" data-product="<?=$item['ID']?>" data-quantity="<?=$item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>"><i class="colored-cart-icon catalog-table__cart" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-quantity="<?=$item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']?>" data-price="<?=$price?>"></i>Добавить в корзину</button>
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
		