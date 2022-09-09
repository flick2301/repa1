<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<?globalGetTitle()?>

            <!--catalog-feed-->
            <div class="basic-layout__module catalog-feed">
               <div class="catalog-feed__list">
    <?foreach($arResult['SECTIONS'] as $section):?>	
	<?$file = CFile::ResizeImageGet($section['PICTURE'], array('width'=>$arParams['LIST_PREV_PIC_W_L2'], 'height'=>$arParams['ITEMS_PREV_PIC_H']), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>	
                  <div class="catalog-feed__item">
                     <!--catalog-card-->
                     <section class="catalog-card">
                        <h3 class="catalog-card__title"><a class="catalog-card__link" href="<?=$section['SECTION_PAGE_URL']?>"><?=$section['NAME']?></a></h3>
                        <div class="catalog-card__cover">
                           <img class="catalog-card__image" src="<?=$file['src']?>" width="262" height="197" alt="<?=$section['NAME']?>" title="<?=$section['NAME']?>" />
                        </div>
                     </section>
                     <!--catalog-card-->
                  </div>
	<?endforeach?>			  
               </div>
            </div>
            <!--catalog-feed-->				  
