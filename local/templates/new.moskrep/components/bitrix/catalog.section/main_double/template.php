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

<?/*globalGetTitle("Магазин крепежа, метизов и инструментов")*/?>	

<div class="main_hits_title">Хиты продаж</div>




            <!--product-slider-->
            <div class="basic-layout__module product-slider <?if(MOBILE!="Y"):?>small<?endif?>">
               <div class="special-products__list">
			   <?foreach ($arResult['ITEMS'] as $key=>$item):?>
                                <?$res = CIBlockElement::GetList(array(), array('ID'=>$arResult['ITEMS'][$key]["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL', 'IBLOCK_SECTION_ID'));
                                  $arElement[$key] = $res->GetNext();								  
								  $count++;
								  if ($key%2) continue;	
								  if ($count > 8) break;?>


				  <div class="special-products__item">
                  <!--product-card-->
                  <section class="product-card product-card--lite product-card--lite_new">
				  
				  
                     <div class="product-card__header">
                        <div class="div_h3 product-card__title"><a class="product-card__link" href="<?=$arElement['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arResult['ITEMS'][$key]['NAME']))?>')"><?=$arResult['ITEMS'][$key]['NAME']?></a></div>
                        <img class="product-card__image" src="<?echo ($arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC']) ? $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] : "/images/no_image.jpg";?>" width="200" height="150" alt="">
                     </div>
                     <div class="product-card__content">
                        <div class="product-card__block">
                           <p class="product-card__delivery"><i class="simple-car-icon product-card__icon"></i><span class="product-card__text">Доставка</span><span class="product-card__date">Завтра</span></p>
                           <p class="product-card__delivery"><i class="simple-home-icon product-card__icon"></i><span class="product-card__text">Самовывоз</span><span class="product-card__date">Сегодня</span></p>
                        </div>
                        <div class="product-card__block">
                           <p class="product-card__available"><span class="product-card__state">В наличии</span></p>
                           <p class="product-card__available"><i class="simple-state-yes-icon product-card__icon product-card__icon--state"></i><span class="product-card__text"><?=($arResult['ITEMS'][$key]['CATALOG_QUANTITY'] + $arResult['ITEMS'][$key]['CATALOG_QUANTITY_RESERVED']);?> уп.</span></p>
                        </div>
                     </div>
					 
                                                <?
                                                    $price = $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] : $arResult['ITEMS'][$key]['PRICES'][ID_BASE_PRICE]['VALUE'];
                                                    $old_price = $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key]['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'] : 0;
                                                ?>	
												
                     <div class="product-card__footer">
                        <div class="product-card__price"><?echo number_format($price, 2, '.', ' ');?> ₽</div>
						<?if($old_price && false):?>
                        <div class="product-card__price"><?echo number_format($old_price, 2, '.', ' ');?> ₽</div>
						<?endif?>
                                         
                        <button class="main-button main-button--mini product-card__button" data-product="<?=$arResult['ITEMS'][$key]['ID']?>" data-name="<?=$arResult['ITEMS'][$key]['NAME']?>" data-price="<?=$arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE']?>">В корзину</button>
                     </div>
					 
					 
					 
						<div class="delimetr"></div>
						
                                <?$res = CIBlockElement::GetList(array(), array('ID'=>$arResult['ITEMS'][$key + 1]["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL', 'IBLOCK_SECTION_ID'));
                                  $arElement[$key] = $res->GetNext();
								?>							 
					 
					 
                     <div class="product-card__header">
                        <div class="div_h3 product-card__title"><a class="product-card__link" href="<?=$arElement['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arResult['ITEMS'][$key + 1]['NAME']))?>')"><?=$arResult['ITEMS'][$key + 1]['NAME']?></a></div>
                        <img class="product-card__image" src="<?echo ($arResult['ITEMS'][$key + 1]['PREVIEW_PICTURE']['SRC']) ? $arResult['ITEMS'][$key + 1]['PREVIEW_PICTURE']['SRC'] : "/images/no_image.jpg";?>" width="200" height="150" alt="">
                     </div>
                     <div class="product-card__content">
                        <div class="product-card__block">
                           <p class="product-card__delivery"><i class="simple-car-icon product-card__icon"></i><span class="product-card__text">Доставка</span><span class="product-card__date">Завтра</span></p>
                           <p class="product-card__delivery"><i class="simple-home-icon product-card__icon"></i><span class="product-card__text">Самовывоз</span><span class="product-card__date">Сегодня</span></p>
                        </div>
                        <div class="product-card__block">
                           <p class="product-card__available"><span class="product-card__state">В наличии</span></p>
                           <p class="product-card__available"><i class="simple-state-yes-icon product-card__icon product-card__icon--state"></i><span class="product-card__text"><?=($arResult['ITEMS'][$key + 1]['CATALOG_QUANTITY'] + $arResult['ITEMS'][$key + 1]['CATALOG_QUANTITY_RESERVED']);?> уп.</span></p>
                        </div>
                     </div>
					 
                                                <?
                                                    $price = $arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE'] : $arResult['ITEMS'][$key + 1]['PRICES'][ID_BASE_PRICE]['VALUE'];
                                                    $old_price = $arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key + 1]['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'] : 0;
                                                ?>	
												
                     <div class="product-card__footer">
                        <div class="product-card__price"><?echo number_format($price, 2, '.', ' ');?> ₽</div>
						<?if($old_price && false):?>
                        <div class="product-card__price"><?echo number_format($old_price, 2, '.', ' ');?> ₽</div>
						<?endif?>
                                         
                        <button class="main-button main-button--mini product-card__button" data-product="<?=$arResult['ITEMS'][$key + 1]['ID']?>" data-name="<?=$arResult['ITEMS'][$key + 1]['NAME']?>" data-price="<?=$arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE']?>">В корзину</button>
                     </div>					 
					 
					 
					 
                  </section>
                  <!--product-card-->
               </div>
								 				  
			   <?endforeach?>
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


				  <div class="product-slider__item">
                  <!--product-card-->
                  <section class="product-card product-card--lite product-card--lite_new">
				  
				  
                     <div class="product-card__header">
                        <div class="div_h3 product-card__title"><a class="product-card__link" href="<?=$arElement['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arResult['ITEMS'][$key]['NAME']))?>')"><?=$arResult['ITEMS'][$key]['NAME']?></a></div>
                        <img class="product-card__image" src="<?echo ($arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC']) ? $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] : "/images/no_image.jpg";?>" width="200" height="150" alt="">
                     </div>
                     <div class="product-card__content">
                        <div class="product-card__block">
                           <p class="product-card__delivery"><i class="simple-car-icon product-card__icon"></i><span class="product-card__text">Доставка</span><span class="product-card__date">Завтра</span></p>
                           <p class="product-card__delivery"><i class="simple-home-icon product-card__icon"></i><span class="product-card__text">Самовывоз</span><span class="product-card__date">Сегодня</span></p>
                        </div>
                        <div class="product-card__block">
                           <p class="product-card__available"><span class="product-card__state">В наличии</span></p>
                           <p class="product-card__available"><i class="simple-state-yes-icon product-card__icon product-card__icon--state"></i><span class="product-card__text"><?=($arResult['ITEMS'][$key]['CATALOG_QUANTITY'] + $arResult['ITEMS'][$key]['CATALOG_QUANTITY_RESERVED']);?> уп.</span></p>
                        </div>
                     </div>
					 
                                                <?
                                                    $price = $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] : $arResult['ITEMS'][$key]['PRICES'][ID_BASE_PRICE]['VALUE'];
                                                    $old_price = $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key]['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'] : 0;
                                                ?>	
												
                     <div class="product-card__footer">
                        <div class="product-card__price"><?echo number_format($price, 2, '.', ' ');?> ₽</div>
						<?if($old_price && false):?>
                        <div class="product-card__price"><?echo number_format($old_price, 2, '.', ' ');?> ₽</div>
						<?endif?>
                                         
                        <button class="main-button main-button--mini product-card__button" data-product="<?=$arResult['ITEMS'][$key]['ID']?>" data-name="<?=$arResult['ITEMS'][$key]['NAME']?>" data-price="<?=$arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE']?>">В корзину</button>
                     </div>
					 
					 
					 
						<div class="delimetr"></div>
						
                                <?$res = CIBlockElement::GetList(array(), array('ID'=>$arResult['ITEMS'][$key + 1]["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL', 'IBLOCK_SECTION_ID'));
                                  $arElement[$key] = $res->GetNext();
								?>							 
					 
					 
                     <div class="product-card__header">
                        <div class="div_h3 product-card__title"><a class="product-card__link" href="<?=$arElement['DETAIL_PAGE_URL']?>" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arResult['ITEMS'][$key + 1]['NAME']))?>')"><?=$arResult['ITEMS'][$key + 1]['NAME']?></a></div>
                        <img class="product-card__image" src="<?echo ($arResult['ITEMS'][$key + 1]['PREVIEW_PICTURE']['SRC']) ? $arResult['ITEMS'][$key + 1]['PREVIEW_PICTURE']['SRC'] : "/images/no_image.jpg";?>" width="200" height="150" alt="">
                     </div>
                     <div class="product-card__content">
                        <div class="product-card__block">
                           <p class="product-card__delivery"><i class="simple-car-icon product-card__icon"></i><span class="product-card__text">Доставка</span><span class="product-card__date">Завтра</span></p>
                           <p class="product-card__delivery"><i class="simple-home-icon product-card__icon"></i><span class="product-card__text">Самовывоз</span><span class="product-card__date">Сегодня</span></p>
                        </div>
                        <div class="product-card__block">
                           <p class="product-card__available"><span class="product-card__state">В наличии</span></p>
                           <p class="product-card__available"><i class="simple-state-yes-icon product-card__icon product-card__icon--state"></i><span class="product-card__text"><?=($arResult['ITEMS'][$key + 1]['CATALOG_QUANTITY'] + $arResult['ITEMS'][$key + 1]['CATALOG_QUANTITY_RESERVED']);?> уп.</span></p>
                        </div>
                     </div>
					 
                                                <?
                                                    $price = $arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE'] : $arResult['ITEMS'][$key + 1]['PRICES'][ID_BASE_PRICE]['VALUE'];
                                                    $old_price = $arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE'] ? $arResult['ITEMS'][$key + 1]['PRICES']['К0 (БАЗОВАЯ НАЧАЛЬНАЯ)']['VALUE'] : 0;
                                                ?>	
												
                     <div class="product-card__footer">
                        <div class="product-card__price"><?echo number_format($price, 2, '.', ' ');?> ₽</div>
						<?if($old_price && false):?>
                        <div class="product-card__price"><?echo number_format($old_price, 2, '.', ' ');?> ₽</div>
						<?endif?>
                                         
                        <button class="main-button main-button--mini product-card__button" data-product="<?=$arResult['ITEMS'][$key + 1]['ID']?>" data-name="<?=$arResult['ITEMS'][$key + 1]['NAME']?>" data-price="<?=$arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE']?>">В корзину</button>
                     </div>					 
					 
					 
					 
                  </section>
                  <!--product-card-->
               </div>
								 				  
			   <?endforeach?>
               </div>
            </div>
            <!--product-slider-->
<?endif?>			
			
			
			
			
			
			
                  <?/*
				  <div class="product-slider__item">
                     <!--product-card-->
					 
					 
					 
                     <section class="product-card product-card--lite product-card--lite_new">
                        <div class="product-card__header">
                           <div class="div_h3 product-card__title"><a class="product-card__link" href="<?=$arElement['DETAIL_PAGE_URL']?>"  onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arResult['ITEMS'][$key]['NAME']))?>')"><?=preg_replace("/(\([0-9шткгм ]+\)( Фасовка)?)$/", "<span>\${1}</span>", $arResult['ITEMS'][$key]['NAME'])?></a></div>
                           <img id="img_<?=$arResult['ITEMS'][$key]['ID']?>" class="product-card__image" src="<?echo ($arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC']) ? $arResult['ITEMS'][$key]['PREVIEW_PICTURE']['SRC'] : "/images/no_image.jpg";?>" width="179" height="134" alt="<?=$arResult['ITEMS'][$key]['PREVIEW_PICTURE']['DESCRIPTION']?>">
                        </div>
                        <div class="product-card__footer">
                           <div class="product-card__price"><?=str_replace(".", ",", $arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE'])?> ₽<del><?=str_replace(".", ",", $arResult['ITEMS'][$key]['PRICES'][ID_BASE_PRICE]['VALUE'])?> ₽</del></div>
                           <button data-product="<?=$arResult['ITEMS'][$key]['ID']?>" data-name="<?=$arResult['ITEMS'][$key]['NAME']?>" data-price="<?=$arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE']?>" class="main-button product-card__to-cart <?=($arResult['IN_BASKET'][$arResult['ITEMS'][$key]['ID']] == 'Y') ? 'active' : "";?>"><i data-product="<?=$arResult['ITEMS'][$key]['ID']?>" data-name="<?=$arResult['ITEMS'][$key]['NAME']?>" data-price="<?=$arResult['ITEMS'][$key]['PRICES']['Распродажа']['VALUE']?>" class="simple-cart-icon"></i>В корзину</button>
                        </div>
						
						<div class="delimetr"></div>
						
                                <?$res = CIBlockElement::GetList(array(), array('ID'=>$arResult['ITEMS'][$key + 1]["ID"]), false, false, array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL', 'IBLOCK_SECTION_ID'));
                                  $arElement[$key] = $res->GetNext();
								?>							
						
						<?if($arResult['ITEMS'][$key + 1]['ID']):?>
                        <div class="product-card__header">
                           <div class="div_h3 product-card__title"><a class="product-card__link" href="<?=$arElement['DETAIL_PAGE_URL']?>"  onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arResult['ITEMS'][$key + 1]['NAME']))?>')"><?=preg_replace("/(\([0-9шткгм ]+\)( Фасовка)?)$/", "<span>\${1}</span>", $arResult['ITEMS'][$key + 1]['NAME'])?></a></div>
                           <img id="img_<?=$arResult['ITEMS'][$key + 1]['ID']?>" class="product-card__image" src="<?echo ($arResult['ITEMS'][$key + 1]['PREVIEW_PICTURE']['SRC']) ? $arResult['ITEMS'][$key + 1]['PREVIEW_PICTURE']['SRC'] : "/images/no_image.jpg";?>" width="179" height="134" alt="<?=$arResult['ITEMS'][$key + 1]['PREVIEW_PICTURE']['DESCRIPTION']?>">
                        </div>
                        <div class="product-card__footer">
                           <div class="product-card__price"><?=str_replace(".", ",", $arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE'])?> ₽<del><?=str_replace(".", ",", $arResult['ITEMS'][$key + 1]['PRICES'][ID_BASE_PRICE]['VALUE'])?> ₽</del></div>
                           <button data-product="<?=$arResult['ITEMS'][$key + 1]['ID']?>" data-name="<?=$arResult['ITEMS'][$key + 1]['NAME']?>" data-price="<?=$arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE']?>" class="main-button product-card__to-cart <?=($arResult['IN_BASKET'][$arResult['ITEMS'][$key + 1]['ID']] == 'Y') ? 'active' : "";?>"><i data-product="<?=$arResult['ITEMS'][$key + 1]['ID']?>" data-name="<?=$arResult['ITEMS'][$key + 1]['NAME']?>" data-price="<?=$arResult['ITEMS'][$key + 1]['PRICES']['Распродажа']['VALUE']?>" class="simple-cart-icon"></i>В корзину</button>
                        </div>						
						<?endif?>
                     </section>
					 
					 
					 
                     <!--product-card-->
			 
                  </div>*/?>				
