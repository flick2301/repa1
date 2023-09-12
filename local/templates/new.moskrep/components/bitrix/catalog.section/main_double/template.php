<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

global $DEFAULT_STORE_ID;

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

<?/*globalGetTitle("Магазин крепежа, метизов и инструментов")*/?>	
<?if($arParams['SHOW_HITS']!='N')
{
	?>
<div class="main_hits_title">Хиты продаж</div>




            <!--product-slider-->
            <div class="basic-layout__module product-slider <?if(MOBILE!="Y"):?>small<?endif?>">
               <div class="special-products__list catalog-feed__list_vi">
			   <?foreach ($arResult['ITEMS'] as $key=>$item):?>
                                <?$res = CIBlockElement::GetList(array(), array('ID'=>$arResult['ITEMS'][$key]["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL', 'IBLOCK_SECTION_ID'));
                                  $arElement[$key] = $res->GetNext();								  
								  $count++;
								  //if ($key%2) continue;	
								  if ($count > 8) break;?>
								  


					 
					 				  <div class="special-products__item catalog-feed__item_vi">
                  <!--product-card-->
                  <section class="product-card product-card--lite product-card--lite_new product-card product-card_vi">
					 
						<div class="product-card__artno-blok">
							<p class="product-card__artno">Артикул: <span class="product-card__state product-card__state_artno"><?=$arResult['ITEMS'][$key]['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></p>
						</div>  		
						
                        <div class="product-card__header product-card__header_vi">
                           <img class="product-card__image" src="<?echo $arResult['ITEMS'][$key]["SMALL_IMG_WEBP"]['WEBP_SRC'] ? $arResult['ITEMS'][$key]["SMALL_IMG_WEBP"]['WEBP_SRC'] : ($arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] ? $arResult['ITEMS'][$key + 1]['PREVIEW_PICTURE']['SRC'] : "/images/no_image.jpg");?>"  width="200" height="150" alt="<?=$arResult['ITEMS'][$key]['NAME']?>">
                         <h3 class="product-card__title product-card__title_vi">
						 <a class="product-card__link product-card__link_vi" href="<?=$arElement[$key]['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arResult['ITEMS'][$key]['NAME']))?>')"><?=$arResult['ITEMS'][$key]['NAME']?></a></h3>						   
                        </div>
									

									
      			
				<?if($arResult['ITEMS'][$key]['PROPERTIES']["DIAMETR"]["VALUE"] && $arResult['ITEMS'][$key]['PROPERTIES']["DLINA"]["VALUE"]):?>
                        <div class="product-card__content">
						<div class="product-card__block-size">
						   <p class="product-card__size">Размер (мм): <span class="product-card__state"><?=$arResult['ITEMS'][$key]['PROPERTIES']["DIAMETR"]["VALUE"]?>x<?=$arResult['ITEMS'][$key]['PROPERTIES']["DLINA"]["VALUE"]?></span></p>
						</div>  						
						</div> 
				<?endif?>		
						
						<div class="product-card__content">
                           <div class="product-card__block">
                              <p class="product-card__delivery"><i class="simple-home-icon product-card__icon"></i><span class="product-card__text">Самовывоз</span><span class="product-card__date">Сегодня</span></p>						   
                              <p class="product-card__delivery"><i class="simple-car-icon product-card__icon"></i><span class="product-card__text">Доставка</span><span class="product-card__date">Завтра</span></p>
                           </div>
						</div>  

						<div class="product-card__content">
                           <div class="product-card__block">
							  <?if($arResult['ITEMS'][$key]['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] > 0):?>
                              <p class="product-card__available product-card__available_vi"><span class="product-card__state">Наличие:</span><span class="product-card__amount"><i class="simple-state-yes-icon product-card__icon product-card__icon--state simple-state-yes-icon_vi"></i><span class="product-card__text"><?=$arResult['ITEMS'][$key]['STORE'][$DEFAULT_STORE_ID]['AMOUNT'];?> уп.</span></span></p>
							  <?else:?>
							  <p class="product-card__available product-card__available_vi"><span class="product-card__state">Под заказ</span></p>
							  <?endif?>
                           </div>	
						</div>	
						
<?
     $price = $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] : $arResult['ITEMS'][$key]['PRICES'][ID_BASE_PRICE]['VALUE'];
    $old_price = $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key]['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'] : 0;
?>							


                        <div class="product-card__footer product-card__footer_vi">	
						   <p class="product-card__price-block product-card__price-block_vi">Цена (с НДС): <br /><span class="product-card__price product-card__price_vi"><?echo number_format($price, 2, '.', ' ');?> ₽</span></p>	

						   
                        <button class="main-button main-button--mini product-card__button product-card__button_round" data-product="<?=$arResult['ITEMS'][$key]['ID']?>" data-name="<?=$arResult['ITEMS'][$key]['NAME']?>" data-price="<?=$arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE']?>"></button>						   
                        </div>	
</section>	
                             
</div>	

					  


								 				  
			   <?endforeach?>
			   <?unset($count);?>
               </div>
            </div>
            <!--product-slider-->



















<?if(MOBILE!="Y"):?>
            <!--product-slider-->
            <div class="basic-layout__module product-slider big">
               <div class="product-slider__list" id="product-slider__list">
			   <?foreach ($arResult['ITEMS'] as $key=>$item):?>
                                <?$res = CIBlockElement::GetList(array(), array('ID'=>$arResult['ITEMS'][$key]["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL', 'IBLOCK_SECTION_ID'));
                                  $arElement[$key] = $res->GetNext();								  
								  $count++;
								  if ($key%2) continue;	
								 ?>
								 
								 
								 
								 
								 
								 
								 
					  <div class="product-slider__item catalog-feed__item catalog-feed__item_vi catalog-feed__item_vi-double">
                  <!--product-card-->							 

                     <section class="product-card product-card_vi product-card_vi-double">
					 
						<div class="product-card__artno-blok">
							<p class="product-card__artno">Артикул: <span class="product-card__state product-card__state_artno"><?=$arResult['ITEMS'][$key]['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></p>
						</div>  		
						
                        <div class="product-card__header product-card__header_vi">
                           <img class="product-card__image" src="<?echo $arResult['ITEMS'][$key]["SMALL_IMG_WEBP"]['WEBP_SRC'] ? $arResult['ITEMS'][$key]["SMALL_IMG_WEBP"]['WEBP_SRC'] : ($arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] ? $arResult['ITEMS'][$key + 1]['PREVIEW_PICTURE']['SRC'] : "/images/no_image.jpg");?>"  width="200" height="150" alt="<?=$arResult['ITEMS'][$key]['NAME']?>">
                         <h3 class="product-card__title product-card__title_vi">
						 <a class="product-card__link product-card__link_vi" href="<?=$arElement[$key]['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arResult['ITEMS'][$key]['NAME']))?>')"><?=$arResult['ITEMS'][$key]['NAME']?></a></h3>						   
                        </div>
									

									
      			
				<?if($arResult['ITEMS'][$key]['PROPERTIES']["DIAMETR"]["VALUE"] && $arResult['ITEMS'][$key]['PROPERTIES']["DLINA"]["VALUE"]):?>
                        <div class="product-card__content">
						<div class="product-card__block-size">
						   <p class="product-card__size">Размер (мм): <span class="product-card__state"><?=$arResult['ITEMS'][$key]['PROPERTIES']["DIAMETR"]["VALUE"]?>x<?=$arResult['ITEMS'][$key]['PROPERTIES']["DLINA"]["VALUE"]?></span></p>
						</div>  						
						</div> 
				<?endif?>		
						
						<div class="product-card__content">
                           <div class="product-card__block">
                              <p class="product-card__delivery"><i class="simple-home-icon product-card__icon"></i><span class="product-card__text">Самовывоз</span><span class="product-card__date">Сегодня</span></p>						   
                              <p class="product-card__delivery"><i class="simple-car-icon product-card__icon"></i><span class="product-card__text">Доставка</span><span class="product-card__date">Завтра</span></p>
                           </div>
						</div>  

						<div class="product-card__content">
                           <div class="product-card__block">
							  <?if($arResult['ITEMS'][$key]['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] > 0):?>
                              <p class="product-card__available product-card__available_vi"><span class="product-card__state">Наличие:</span><span class="product-card__amount"><i class="simple-state-yes-icon product-card__icon product-card__icon--state simple-state-yes-icon_vi"></i><span class="product-card__text"><?=$arResult['ITEMS'][$key]['STORE'][$DEFAULT_STORE_ID]['AMOUNT'];?> уп.</span></span></p>
							  <?else:?>
							  <p class="product-card__available product-card__available_vi"><span class="product-card__state">Под заказ</span></p>
							  <?endif?>
                           </div>	
						</div>	
						
<?
     $price = $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] : $arResult['ITEMS'][$key]['PRICES'][ID_BASE_PRICE]['VALUE'];
    $old_price = $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key]['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'] : 0;
?>							


                        <div class="product-card__footer product-card__footer_vi">	
						   <p class="product-card__price-block product-card__price-block_vi">Цена (с НДС): <br /><span class="product-card__price product-card__price_vi"><?echo number_format($price, 2, '.', ' ');?> ₽</span></p>	

						   
                        <button class="main-button main-button--mini product-card__button product-card__button_round" data-product="<?=$arResult['ITEMS'][$key]['ID']?>" data-name="<?=$arResult['ITEMS'][$key]['NAME']?>" data-price="<?=$arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE']?>"></button>						   
                        </div>	
</section>						




						<div class="delimetr"></div>
						
                                <?$res = CIBlockElement::GetList(array(), array('ID'=>$arResult['ITEMS'][$key + 1]["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL', 'IBLOCK_SECTION_ID'));
                                  $arElement[$key] = $res->GetNext();
								?>
								
								
								
								
								
								
								
								
<section class="product-card product-card_vi product-card_vi-double">
<div class="product-card__artno-blok">
							<p class="product-card__artno">Артикул: <span class="product-card__state product-card__state_artno"><?=$arResult['ITEMS'][$key + 1]['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?></span></p>
						</div>  		
						
                        <div class="product-card__header product-card__header_vi">
                           <img class="product-card__image" src="<?echo $arResult['ITEMS'][$key + 1]["SMALL_IMG_WEBP"]['WEBP_SRC'] ? $arResult['ITEMS'][$key + 1]["SMALL_IMG_WEBP"]['WEBP_SRC'] : ($arResult['ITEMS'][$key + 1]['PREVIEW_PICTURE']['SRC'] ? $arResult['ITEMS'][$key + 1]['PREVIEW_PICTURE']['SRC'] : "/images/no_image.jpg");?>"  width="200" height="150" alt="<?=$arResult['ITEMS'][$key + 1]['NAME']?>">
                         <h3 class="product-card__title product-card__title_vi">
						 <a class="product-card__link product-card__link_vi" href="<?=$arElement[$key]['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arResult['ITEMS'][$key + 1]['NAME']))?>')"><?=$arResult['ITEMS'][$key + 1]['NAME']?></a></h3>						   
                        </div>
						
						
						
											
      			
				<?if($arResult['ITEMS'][$key + 1]['PROPERTIES']["DIAMETR"]["VALUE"] && $arResult['ITEMS'][$key + 1]['PROPERTIES']["DLINA"]["VALUE"]):?>
                        <div class="product-card__content">
						<div class="product-card__block-size">
						   <p class="product-card__size">Размер (мм): <span class="product-card__state"><?=$arResult['ITEMS'][$key + 1]['PROPERTIES']["DIAMETR"]["VALUE"]?>x<?=$arResult['ITEMS'][$key + 1]['PROPERTIES']["DLINA"]["VALUE"]?></span></p>
						</div>  						
						</div> 
				<?endif?>		
						
						<div class="product-card__content">
                           <div class="product-card__block">
                              <p class="product-card__delivery"><i class="simple-home-icon product-card__icon"></i><span class="product-card__text">Самовывоз</span><span class="product-card__date">Сегодня</span></p>						   
                              <p class="product-card__delivery"><i class="simple-car-icon product-card__icon"></i><span class="product-card__text">Доставка</span><span class="product-card__date">Завтра</span></p>
                           </div>
						</div>  

						<div class="product-card__content">
                           <div class="product-card__block">
							  <?if($arResult['ITEMS'][$key + 1]['STORE'][$DEFAULT_STORE_ID]['AMOUNT'] > 0):?>
                              <p class="product-card__available product-card__available_vi"><span class="product-card__state">Наличие:</span><span class="product-card__amount"><i class="simple-state-yes-icon product-card__icon product-card__icon--state simple-state-yes-icon_vi"></i><span class="product-card__text"><?=$arResult['ITEMS'][$key + 1]['STORE'][$DEFAULT_STORE_ID]['AMOUNT'];?> уп.</span></span></p>
							  <?else:?>
							  <p class="product-card__available product-card__available_vi"><span class="product-card__state">Под заказ</span></p>
							  <?endif?>
                           </div>	
						</div>	
						
<?
     $price = $arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE'] : $arResult['ITEMS'][$key + 1]['PRICES'][ID_BASE_PRICE]['VALUE'];
    $old_price = $arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key + 1]['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'] : 0;
?>							


                        <div class="product-card__footer product-card__footer_vi">	
						   <p class="product-card__price-block product-card__price-block_vi">Цена (с НДС): <br /><span class="product-card__price product-card__price_vi"><?echo number_format($price, 2, '.', ' ');?> ₽</span></p>	

						   
                        <button class="main-button main-button--mini product-card__button product-card__button_round" data-product="<?=$arResult['ITEMS'][$key + 1]['ID']?>" data-name="<?=$arResult['ITEMS'][$key + 1]['NAME']?>" data-price="<?=$arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE']?>"></button>						   
                        </div>									

						
						   
                     </section>		
                     <!--product-card-->
					 
					 
					 
            </div>			 
								 

			   
			   
			   
								 				  
			   <?endforeach?>
               </div>
            </div>
            <!--product-slider-->
<?endif?>

<?}?>	
<script type="text/javascript"> 
    (window["rrApiOnReady"] = window["rrApiOnReady"] || []).push(function() {
		try{ rrApi.groupView([<? foreach($arResult['arITEMS_ID'] as $item_id) {
			echo $item_id.', ';
		} ?>]); } catch(e) {}
	})
</script>		
			
			
			
			
			