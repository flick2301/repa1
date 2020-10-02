<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;

$APPLICATION->AddChainItem($arResult['SECTION']['NAME'], "");

$APPLICATION->SetPageProperty("title", $arResult['IPROP_VALUES']['SECTION_META_TITLE']);
$APPLICATION->SetPageProperty("description", $arResult['IPROP_VALUES']['SECTION_META_DESCRIPTION']);
$APPLICATION->SetPageProperty("keywords", $arResult['IPROP_VALUES']['SECTION_META_KEYWORDS']);
?>


<?globalGetTitle()?>
			
            <!--simple-article-->
            <div class="basic-layout__module simple-article">
               <div class="simple-article__content">
<?foreach($arResult['ITEMS'] as $item):?>			   
                  <div class="simple-article__section">
	<?if($item['PROPERTIES']['PDF_CERT']['VALUE']):?>				  
                     <!--download-file-->
	<?$file_arr=CFile::GetFileArray($item['PROPERTIES']['PDF_CERT']['VALUE']);?>						 
                     <p class="download-file"><img class="download-file__icon" src="<?=SITE_TEMPLATE_PATH?>/assets/design/download-file/pdf.svg" width="36" height="36" alt="Скачать <?=mb_strtolower($item['NAME'])?>" title="Скачать <?=mb_strtolower($item['NAME'])?>" />				 
					 <a class="second-button second-button--mini download-file__button" href="<?=CFile::GetPath($item['PROPERTIES']['PDF_CERT']['VALUE'])?>">Скачать <?=mb_strtolower($item['NAME'])?></a>
					 </p>
                     <!--download-file-->
<?endif?>					 
                     <div class="simple-article__block" data-gallery-popup>
<?foreach($item['PROPERTIES']['CERT_PAGE']['VALUE'] as $page_cert):?>	
<?$num++?>
<?$file = CFile::ResizeImageGet($page_cert, array('width'=>$arParams['ITEMS_PREV_PIC_W'], 'height'=>$arParams['ITEMS_PREV_PIC_H']), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>				 
                        <div class="simple-article__column">
                           <!--certify-card-->
                           <div class="certify-card">
                              <a class="certify-card__link nav-certificate__link" href="<?=CFile::GetPath($page_cert)?>" rel="gallery_img">
                                 <p class="certify-card__cover"><img class="certify-card__image" src="<?=$file['src']?>" width="265" height="375" alt="<?=$item['NAME']?> <?=sprintf("%02d", $num)?>" title="<?=$item['NAME']?> <?=sprintf("%02d", $num)?>"></p>
                                 <p data-sreader>Увеличить</p>
                              </a>
                           </div>
                           <!--certify-card-->
                        </div>
<?endforeach?>
<?unset($num)?>
                     </div>
                  </div>
<?endforeach?>
               </div>
            </div>
            <!--simple-article-->
