<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->setFrameMode(true);

global $APPLICATION;
global $context;
global $sec_builder;
global $filterObj;

$request = $context->getRequest();
$requestUri = $request->getRequestUri();
    

?>

<?if(count($arResult['RELINK'])):?>
    <?php $this->SetViewTarget('RELINK'); ?>
	<!--see-also-widget-->
	<div class="basic-layout__module see-also-widget">
               <h4 class="see-also-widget__title">Смотрите также:</h4>
               <ul class="see-also-widget__list">
				<?foreach($arResult['RELINK'] as $relink):?>
                  <li class="see-also-widget__item">
                     <a class="see-also-widget__link" href="<?=$relink['AKCEPTOR']?>"><?=$relink['ANKOR']?></a>
                  </li>
				<?endforeach;?>
				</ul>
    </div>
	<!--see-also-widget-->
    <?php $this->EndViewTarget(); ?>
<?endif;?>

<?if($arResult['REFERENCE']['ITEM']['ID']!=''):?>

    
<?$APPLICATION->SetPageProperty('url_canon_relink', 'Y'); 
		
		?>
      
    
	<?globalGetTitle($APPLICATION->GetPageProperty('page_title') ? $APPLICATION->GetPageProperty('page_title') : ($arResult['REFERENCE']['ITEM']['ELEMENT_PAGE_TITLE'] ? $arResult['REFERENCE']['ITEM']['ELEMENT_PAGE_TITLE'] : $arResult['REFERENCE']['ITEM']['H1']['VALUE']))?>

    <!--catalog-feed-->
    <div class="basic-layout__module catalog-feed">
        <div class="catalog-feed__list">
<?
    foreach ($arResult['DOP_SECTIONS'] as &$arSection)
    {
?>
        <div class="catalog-feed__item catalog-feed__item__withpic ">
			<!--catalog-card-->
			<section class="catalog-card">
				<div class="div_flex_h3 catalog-card__title"><a href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self" title='<?=$arSection['UF_SHORT_NAME'] ?? $arSection['NAME']?>' class="catalog-card__link"><?=$arSection['UF_SHORT_NAME'] ?? $arSection['NAME']?></a></div>
                <div class="catalog-card__cover">
                    <img class="catalog-card__image" width="262" height="197" src="<?=$arSection['PICTURE']['src']?>" alt="<?=$arSection['UF_SHORT_NAME'] ?? $arSection['NAME']?>">
                </div>
            </section>
		</div>
    <?}?>		
		</div>
	</div>
	<!--catalog-feed-->

    <?if($arResult['TOP_SECTIONS']):?>
        <!--catalog-feed-->
		<div class="basic-layout__module catalog-feed">
			<div class="catalog-feed__list">
                <?foreach ($arResult['TOP_SECTIONS'] as &$arSection):?>
				
                    <div class="catalog-newcard catalog-newcard_white">
					<!--catalog-card-->
					<a class="catalog-newcard__href" onclick="dataLayerProduct('<?=$arSection['UF_SHORT_NAME'] ?? $arSection['NAME']?>');" href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self" title="<?=$arSection['UF_SHORT_NAME'] ?? $arSection['NAME']?>">
		
						<span class="catalog-newcard__img">
							<img class="catalog-newcard__image" width="262" height="197" src="<?=($arSection['DETAIL_PICTURE']) ? CFile::GetPath($arSection['DETAIL_PICTURE']) : $arSection['PICTURE']['src'];?>" alt="<?=$arSection['UF_SHORT_NAME'] ?? $arSection['NAME']?>">
						</span>
		
						<span class="catalog-newcard__text">
							<?=$arSection['UF_SHORT_NAME'] ?? $arSection['NAME']?>		</span> 
					</a>
					
					<!--catalog-card-->
					</div>
   
                <?endforeach;?>
            </div>
		</div>
		<!--catalog-feed-->


		<?if($_POST['ENUM_LIST']['ELEMENTS'] && empty($arResult['SORTING']['SECTIONS']))
			require_once __DIR__."/include_parts/section_table.php";?>
    <?endif;?>



    <?
    //ФИЛЬТРОВЫЕ КНОПКИ ДЛЯ ПОСАДОЧНЫХ СТРАНИЦ
    if($arResult['SORTING']['SECTION_ID']){
        ?>

        <?

        foreach($arResult['SORTING']['SECTIONS'] as $sortSection){
            if($sortSection['TOP']){
                ?>
                <div class="basic-layout__module category-blocknew">
                    <div class="div_h3 category-blocknew__title"><span><?=$sortSection["NAME"]?></span></div>
                    <ul class="category-blocknew__list">
                        <?$i=0;?>
                        <?foreach($sortSection['ITEMS'] as $sort_item):?>
                            <?$i++;
                            $link = $link = $sec_builder->linkBuilder($sort_item, $sortSection);

                            ?>

                            <li class="category-blocknew__item" >
                                <a href="<?=$link?>" <?=($sort_item['LINK_TARGET']['VALUE']) ? "target='_self'" : "";?> class="category-block__link <?=$sort_item['IS_ACTIVE']?>">
                                    <?=$sort_item['NAME']?>
                                </a>
                            </li>
                        <?endforeach;?>
                    </ul>
                </div>
                <?
            }
        }

    }
    ?>

	<?if(!empty($arResult['REFERENCE']['ITEM']['SECTION_LINK']['VALUE']) ){
		require_once __DIR__."/include_parts/section_table.php";
	}?>
    <?if($arResult['REFERENCE']['ITEM']['PICTURE']){?>
    <div class="catalog-head__photo photo__seo">
        <a href="<?=$arResult['REFERENCE']['ITEM']['PICTURE']['src']?>"  onclick="javascript:void();" rel="catalog-photo" class="catalog-photo__link">
            <img src="<?=$arResult['REFERENCE']['ITEM']['PICTURE']['src']?>" alt="<?=$arResult['REFERENCE']['ITEM']['H1']['VALUE']?>">
        </a>
    </div>
    <?}?>
<!--simple-article-->
<?if(empty($sec_builder->curSorting[0]['arFilters']['VALUE']) && empty($sec_builder->curSorting[1]['arFilters']['VALUE'])){?>
        <div class="basic-layout__module simple-article">
            <div class="simple-article__content wysiwyg-block">
<?=$arResult['REFERENCE']['ITEM']['DETAIL_TEXT']?>
			</div>	
		</div>
		<?}?>
<!--simple-article-->
    <?

    if($arResult['REFERENCE']['ITEM']['DIRECTORY'] && $intSectionID==0){

		
        global $arReplacement;
        $arReplacement = $arResult['REFERENCE']['ITEM']['REPLACEMENT']['VALUE'];
		$tmp = ($arResult['REFERENCE']['ITEM']['VERTICAL']['VALUE']=='Y') ? 'vertical' : 'horizontal_new';


        
        if($arResult['REFERENCE']['ITEM']['COMPANIONS']){?>
            <div class="sorting_section">
                <div class="sorting_section_left">
                    <span>Сопутствующие товары:</span>
                </div>
                <div class="sorting_section_right">




                    <?foreach($arResult['REFERENCE']['ITEM']['COMPANIONS'] as $companion){?>
                        <div class="sorting_item">
                            <a href="<?=$companion['SRC']?>" target='_self' class="sorting_link">

                                <span class="sorting_title"><?=$companion['NAME']?></span>
                            </a>
                        </div>
                    <?}?>

                </div>
            </div>
        <?}?>
		
		
<!--simple-article-->
        <div class="basic-layout__module simple-article">
            <div class="simple-article__content wysiwyg-block">
<?=$arResult['REFERENCE']['ITEM']['PREVIEW_TEXT']?>
			</div>	
		</div>
<!--simple-article-->

				<?}
    ?>
    
<?else:?>
<?if($IPROPERTY['SECTION_META_TITLE']==''){$APPLICATION->SetPageProperty('title', $arResult["SECTION"]["NAME"]);}?>

<?$this->SetViewTarget('catalog_section');?>

	 <div class="basic-layout__columns basic-layout__columns--reverse">
		  <div class="basic-layout__content full">
		  
		  <?
		  if($arResult['SECTION']["UF_H1_MSK"] && $_SERVER['HTTP_HOST'] != 'spb.krep-komp.ru')
		  {
			$h1_section = $arResult['SECTION']["UF_H1_MSK"];
		  }elseif($arResult['SECTION']["UF_H1_SPB"] && $_SERVER['HTTP_HOST'] == 'spb.krep-komp.ru')
		  {
			$h1_section = $arResult['SECTION']["UF_H1_SPB"];
		  }elseif($APPLICATION->GetPageProperty('page_title'))
          {
              $h1_section =$APPLICATION->GetPageProperty('page_title');
          }else
		  {
			  $h1_section = $arResult['SECTION']['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] ? $arResult['SECTION']['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] : $arResult["SECTION"]["NAME"];
		  }
		  ?>
		 
<?globalGetTitle($h1_section)?>


<?
//Проверка, что из саморезов и шурупов, отслеживаем путь, берем второго родителя( Крепеж - первый и т.д.)
$second_parent = $arResult['SECTION']['PATH']['1'];
if($arParams['TYPE_TEMPLATE']!='BOTTOM')
{
   	?>

<!--catalog-feed-->
    <div class="basic-layout__module basic-layout__module__sections catalog-feed">
        <div class="catalog-feed__list">
<?
    foreach ($arResult['SECTIONS'] as &$arSection)
    {
    ?>
		<div class="catalog-newcard <?if(!$arSection['DETAIL_PICTURE']):?>catalog-newcard_white<?endif?>">
		<!--catalog-card-->
        <a class="catalog-newcard__href" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($arSection['NAME']))?>');" href="<?=$arSection['UF_SYM_LINK'] ? $arSection['UF_SYM_LINK'] : $arSection['SECTION_PAGE_URL']?>" target="_self" title='<?=$arSection['UF_SHORT_NAME'] ? $arSection['UF_SHORT_NAME'] : $arSection['NAME']?>'>
		
		<span class="catalog-newcard__img">
		<img class="catalog-newcard__image" width="262" height="197" src="<?=$arSection['PICTURE']['src']?>" alt="<?=$arSection['UF_SHORT_NAME'] ? $arSection['UF_SHORT_NAME'] : $arSection['NAME']?>">
		</span>
		
		<span class="catalog-newcard__text">
		<?=$arSection['UF_SHORT_NAME'] ? $arSection['UF_SHORT_NAME'] : $arSection['NAME']?>
		</span>  
        </a>
		<!--catalog-card-->
		</div>
    <?}?>
		
    <?php
    if(count($arResult['SORTING']['ROOT_ELEMENTS'])){
        foreach($arResult['SORTING']['ROOT_ELEMENTS'] as $dop_section){
            ?>
		<div class="catalog-newcard catalog-newcard_white">
		<!--catalog-card-->
        <a class="catalog-newcard__href" onclick="dataLayerProduct('<?=str_replace(Array("\"", "'"), "", htmlspecialchars($dop_section['H1']["VALUE"]))?>');" href="<?=($dop_section['LINK_TARGET']['VALUE']) ? $dop_section['LINK_TARGET']['VALUE'] : $dop_section['CODE'].'/';?>" target="_self" title='<?=$dop_section['H1']["VALUE"]?>'>
		
		<?if($dop_section['PICTURE']['src']):?>
		<span class="catalog-newcard__img">
		<img class="catalog-newcard__image"  src="<?=$dop_section['PICTURE']['src']?>" alt="<?=$dop_section['H1']["VALUE"]?>">
		</span>
		<?endif?>
				
		<span class="catalog-newcard__text catalog-newcard__text_canter">
		<?=$dop_section['H1']["VALUE"]?>
		</span>  
        </a>
		<!--catalog-card-->
		</div>		
    <?php
            
        }
        
    }
    ?>
	<?if ($arResult["SECTION"]["UF_YOUTUBE"] && ($_SERVER['HTTP_HOST']=="krep-komp.ru" || $_SERVER['HTTP_HOST']=="spb.krep-komp.ru")):?>
	<?$video_view_name = mb_strtolower(mb_substr($h1_section, 0, 1)) . mb_substr($h1_section, 1);?>
<div class="catalog-feed__item catalog-feed__item__withpic catalog-feed__item__white">
		<!--goto-video-->
    <section id="catalog-card_goto-video" class="catalog-card catalog-card_goto-video">
      <div class="div_flex_h3 catalog-card__title"><a href="javascript:void();" title="Видеобзоры на <?=$video_view_name?>" class="catalog-card__link">Видеобзоры на <?=$video_view_name?></a></div>
        <div class="catalog-card__cover catalog-card__cover__white">
          <img class="catalog-card__image catalog-card__image_goto-video" width="262" height="197" src="<?=SITE_TEMPLATE_PATH?>/img/video_view_name.svg" alt="Видеобзоры на <?=$video_view_name?>">
        </div>
      
    </section>
		<!--goto-video-->
		</div>
		
	<?endif?>
		</div>
    </div>
    <!--catalog-feed-->

<?}?>

	
		<!--category-blocknew-->
            <div class="basic-layout__module category-blocknew category-blocknew_nomargin">
	<?
	//Если по шаблону категории должны быть под таблицей
	if($arParams['TYPE_TEMPLATE']=='BOTTOM')
	{
		?><div class="div_h3 category-blocknew__title"><span>Основные категории</span></div>
		<ul class="category-blocknew__list">
        <?$i=0;?><?
		foreach ($arResult['SECTIONS'] as &$arSection)
		{
			$i++;
		?>
			<li class="category-blocknew__item">
                <a href="<?=$arSection['UF_SYM_LINK'] ? $arSection['UF_SYM_LINK'] : $arSection['SECTION_PAGE_URL']?>" target="_self" class="category-block__link">
                    <?=($arSection['UF_SHORT_NAME']) ? $arSection['UF_SHORT_NAME']: $arSection['NAME'];?>
                </a>
            </li>
		
		<?}?>
		</ul><?
	}
	?></div>

	<!--category-blocknew-->
	
			  </div>
	</div>
	
<?$this->EndViewTarget();?> 	
	
<?
if($arResult['SORTING']['SECTION_ID']){
?>	

	<?
	
    foreach($arResult['SORTING']['SECTIONS'] as $sortSection){
        if($sortSection['TOP']){
        ?>
		<div class="basic-layout__module category-blocknew category-blocknew_nomargin <?=$sec_builder->curSorting;?>">
			<div class="div_h3 category-blocknew__title"><span><?=$sortSection["NAME"]?></span></div>
			<ul class="category-blocknew__list">
			<?$i=0;?>
			<?foreach($sortSection['ITEMS'] as $sort_item):?>
				<?$i++;
                $link =  $filterObj->sec_builder->linkBuilder($sort_item, $sortSection);

            ?>
			

				<li class="category-blocknew__item category-blocknew__newitem" >
                    <a href="<?=$link?>" <?=($sort_item['LINK_TARGET']['VALUE']) ? "target='_self'" : "";?> <?=(!empty($sort_item['arFilters']['VALUE']) && empty($sort_item['sef_filter']['VALUE'])) ? "rel='nofollow'" : "";?> class="category-block__link <?=$sort_item['IS_ACTIVE']?>">
						<?=$sort_item['NAME']?> <?=$sort_item['sef_filter']['VALUE_XML_ID']?>
					</a>
				</li>
			<?endforeach;?>
			</ul>
		</div>
        <?
		}
    }
	
}
?>

<?if($_POST['ENUM_LIST']['ELEMENTS']){
	
	require_once __DIR__."/include_parts/section_table.php";
}?>



<?
if($arResult['SORTING']['SECTION_ID']){
?>
	<!--category-blocknew-->
            <div class="basic-layout__module category-blocknew">
			
	<?
	
    foreach($arResult['SORTING']['SECTIONS'] as $sortSection){
        if(!$sortSection['TOP'] && $sortSection['ACTIVE']=='Y'){
			$u=0;
        ?>
        <div class="div_h3 category-blocknew__title" style='display:flex;'><span><?=$sortSection["NAME"]?></span></div>
        <ul class="category-blocknew__list" <?=($u==0) ? 'style="display:none;"' : '';?>>
        <?
		$u++;
$i=0;?>
        <?foreach($sortSection['ITEMS'] as $sort_item):?>
            <?$i++;

            ?>

            <li class="category-blocknew__item">
                <a href="<?=($sort_item['LINK_TARGET']['VALUE']) ? $sort_item['LINK_TARGET']['VALUE'] : $sec_builder->curSection['SECTION_PAGE_URL'].$sort_item['CODE'].'/';?>" <?=($sort_item['LINK_TARGET']['VALUE']) ? "target='_self'" : "";?> class="category-block__link">
                    <?=$sort_item['NAME']?>
                </a>
            </li>
	<?endforeach;?>
        </ul>
        <?
		}
    }
	?></div>

	<!--category-blocknew-->
	<?
	
	/*
	?>
	<!--category-block-->
            <div class="basic-layout__module category-block">
	<?
	//Если по шаблону категории должны быть под таблицей
	if($arParams['TYPE_TEMPLATE']=='BOTTOM')
	{
		?><div class="div_h3 category-block__title">Основные категории</div>
		<ul class="category-block__list">
        <?$i=0;?><?
		foreach ($arResult['SECTIONS'] as &$arSection)
		{
			$i++;
		?>
			<li class="category-block__item">
                <a href="<?=$arSection['UF_SYM_LINK'] ? $arSection['UF_SYM_LINK'] : $arSection['SECTION_PAGE_URL']?>" target="_self" class="category-block__link">
                    <?=($arSection['UF_SHORT_NAME']) ? $arSection['UF_SHORT_NAME']: $arSection['NAME'];?>
                </a>
            </li>
		
		<?}?>
		</ul><?
	}
    foreach($arResult['SORTING']['SECTIONS'] as $sortSection){
        
        ?>
        <div class="div_h3 category-block__title"><?=$sortSection["NAME"]?></div>
        <ul class="category-block__list">
        <?$i=0;?>
        <?foreach($sortSection['ITEMS'] as $sort_item):?>
            <?$i++;?>
            <li class="category-block__item">
                <a href="<?=($sort_item['LINK_TARGET']['VALUE']) ? $sort_item['LINK_TARGET']['VALUE'] : $sort_item['CODE'].'/';?>" <?=($sort_item['LINK_TARGET']['VALUE']) ? "target='_self'" : "";?> class="category-block__link">
                    <?=$sort_item['NAME']?>
                </a>
            </li>
	<?endforeach;?>
        </ul>
        <?
    }
	?></div>
	<!--category-block--><?*/
}
?>

<?
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


<!--simple-article-->
<?if(!($_REQUEST['PAGEN_1'] > 1)  && ($_SERVER['HTTP_HOST']=='krep-komp.ru' || $_SERVER['HTTP_HOST']=='dev2.krep-komp.ru')):?>
<?if($arResult['SECTION']['UF_DESCRIPTION_ABOUT'] /*&& ($USER->IsAdmin() || $arResult['SECTION']['UF_DESCRIPTION_SPECIES'] || $arResult['SECTION']['UF_DESCRIPTION_WHOLESALE'] || $arResult['SECTION']['UF_DESCRIPTION_WARRANTY'] || $arResult['SECTION']['UF_DESCRIPTION_DELIVERY'] || $arResult['SECTION']['UF_DESCRIPTION_SORT'])*/):?>


        <!--product-tabs-->
               <div class="product-page__tabs product-tabs" id="desc">
                  <ul class="product-tabs__list" data-product-page-tabs>
<?if(empty($sec_builder->curSorting[0]['arFilters']['VALUE']) && empty($sec_builder->curSorting[1]['arFilters']['VALUE'])){?>				  
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_about" data-tabby-default>Описание</a>
                     </li>
					 <?}?>
					 
					 <?if($arResult['SECTION']['UF_DESCRIPTION_SPECIES'] && false):?>
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_species">Виды</a>
                     </li>
					 <?endif?>
					 
					 <?if($arResult['SECTION']['UF_DESCRIPTION_WHOLESALE'] || true):?>					 
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_wholesale"><?=explode(" ", $arResult['SECTION']["NAME"])[0]?> оптом</a>
                     </li>
					 <?endif?>
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_payment">Как заказать</a>
                     </li>					 
					 <?if($arResult['SECTION']['UF_DESCRIPTION_WARRANTY'] || true):?>						 
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_warranty">Гарантия</a>
                     </li>
					 <?endif?>
					 <?if($arResult['SECTION']['UF_DESCRIPTION_DELIVERY'] || true):?>						 
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_delivery">Доставка</a>
                     </li>
					 <?endif?>		
					 <?if($arResult['SECTION']['UF_DESCRIPTION_SORT'] && false):?>						 
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_sort">Сортировка</a>
                     </li>	
					<?endif?>			
					 <?if($arResult['SECTION']['UF_YOUTUBE']):?>						 
                     <li class="product-tabs__item">
                        <a class="product-tabs__toggle" href="#description_youtube">Видео</a>
                     </li>	
					<?endif?>						
                  </ul>
               </div>
        <!--product-tabs-->



<div class="product-page__section" id="description_about">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">	
<?if(empty($sec_builder->curSorting[0]['arFilters']['VALUE']) && empty($sec_builder->curSorting[1]['arFilters']['VALUE'])){?>	
<?=$arResult['SECTION']['~UF_DESCRIPTION_ABOUT'];?>
<?=$arResult['SECTION']['~UF_DESCRIPTION_SPECIES'];?>
<?}?>
</div>	
</div>
</div>	

<?if($arResult['SECTION']['UF_DESCRIPTION_SPECIES'] && false):?>
<div class="product-page__section" id="description_species">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">		
<?=$arResult['SECTION']['~UF_DESCRIPTION_SPECIES'];?>
</div>	
</div>
</div>	
<?endif?>

<?if($arResult['SECTION']['UF_DESCRIPTION_WHOLESALE'] || true):?>	
<div class="product-page__section" id="description_wholesale">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">	
<?if($arResult['SECTION']['~UF_DESCRIPTION_WHOLESALE']):?>	
<?=$arResult['SECTION']['~UF_DESCRIPTION_WHOLESALE'];?>
<?else:?>
<h2 style="text-align: left;"> Как купить <?=mb_strtoupper(explode(" ", $arResult['SECTION']["NAME"])[0])?> ОПТОМ?</h2>
Все цены, предоставленные на нашем сайте БАЗОВЫЕ (мелкооптовые).<br />
Для того, чтобы купить <?=mb_strtolower(explode(" ", $arResult['SECTION']["NAME"])[0])?> оптом, нужно сделать заказ от 5 000 рублей. <br />
На такие заказы, мы предоставляем следующие скидки:<br /><br />
От 5 000 рублей – 5%<br />
От 10 000 рублей – 10%<br />
От 15 000 рублей – 15%<br />
От 20 000 рублей – 20%<br />
От 25 000 рублей – 25%<br />
От 100 000 рублей – 30%<br />
От 500 000 рублей – 35%<br /><br />
Скидка сохраняется на месяц, при условии выбора товара на сумму, соответствующей скидки.<br />

<?endif?>
</div>		
</div>
</div>
<?endif?>

<div class="product-page__section" id="description_payment">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">		
<h2 style="text-align: left;">Как сделать заказ?</h2>
Сделать заказ можно несколькими способами:<br /><br />
<ul>
<li>На сайте через корзину (самый быстрый способ, чтобы получить счет).</li>
<li>Отправить заявку через форму на сайте, прикрепив её.</li>
<li>Отправить заявку на почту.</li>
<li>Отправить заявку в мессенджере (Живосайт).</li>
<li>Позвонить по телефону и продиктовать менеджеру.</li>
<ul><br />
<h2 style="text-align: left;">Как получить заказ?</h2>
Получить заказ можно у нас на центральном складе или в любом магазине ПВЗ.
Либо воспользоваться нашей услугой по доставке вашего заказа. 
<br /><br />
Телефон отдела продаж: (499) 350-55-55
</div>
</div>
</div>	

<?if($arResult['SECTION']['UF_DESCRIPTION_WARRANTY'] || true):?>		
<div class="product-page__section" id="description_warranty">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">		
<?if($arResult['SECTION']['~UF_DESCRIPTION_WARRANTY']):?>	
<?=$arResult['SECTION']['~UF_DESCRIPTION_WARRANTY'];?>
<?else:?>
<h2 style="text-align: left;">Гарантия качества “КРЕП-КОМП”</h2>
<p>
	 Все крепежные изделия и <?=mb_strtolower(explode(" ", $arResult['SECTION']["NAME"])[0])?> торговых марок “KREP-KOMP” и “KENNER” изготавливаются на ведущих фабриках на современном оборудовании, и из первичного сырья. На всю продукцию мы предоставляем соответствующие сертификаты. Наша компания КРЕП-КОМП даёт гарантию, и в случае если вас что-то не устроит, вы сможете вернуть нам приобретенные у нас изделия обратно, при условии целостности упаковки.
</p>
<?endif?>
</div>	
</div>
</div>
<?endif?>	

<?if($arResult['SECTION']['UF_DESCRIPTION_DELIVERY'] || true):?>
<div class="product-page__section" id="description_delivery">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">	
<?if($arResult['SECTION']['UF_DESCRIPTION_DELIVERY']):?>	
<?=$arResult['SECTION']['~UF_DESCRIPTION_DELIVERY'];?>
<?else:?>
<h2 style="text-align: left;">Доставка заказов</h2>
<p>
	 Мы выполняем доставку заказов собственным автотранспортом по {{region}}, а также во все города РФ, через транспортные компании. До ТК “Деловые Линии” и “ПЭК”, мы везём бесплатно от любой суммы заказа, услуги самой ТК от города {{city}} до вашего города оплачиваете вы.
</p>
<?endif?>
</div>
</div>
</div>	
<?endif?>

<?if($arResult['SECTION']['UF_DESCRIPTION_SORT'] && false):?>		
<div class="product-page__section" id="description_sort">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">		
<?=$arResult['SECTION']['~UF_DESCRIPTION_SORT'];?>
</div>
</div>
</div>	
<?endif?>
	
<?if($arResult['SECTION']['UF_YOUTUBE']):?>						 
<div class="product-page__section" id="description_youtube">
<div class="basic-layout__module simple-article">
<div class="simple-article__content wysiwyg-block">	
<?$arResult['SECTION']['UF_YOUTUBE'] = explode("|", $arResult['SECTION']['UF_YOUTUBE'])?>
<?foreach($arResult['SECTION']['UF_YOUTUBE'] AS $youtube):?>
<iframe class="youtube_video" width="100%" height="" src="https://www.youtube.com/embed/<?=$youtube;?>" title="<?=$h1_section?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?endforeach?>
</div>
</div>
</div>
<?endif?>	



<?else:?>
        <div class="basic-layout__module simple-article">
            <div class="simple-article__content wysiwyg-block">
                <?if(empty($sec_builder->curSorting[0]['arFilters']['VALUE']) && empty($sec_builder->curSorting[1]['arFilters']['VALUE'])){?>
				    
					
				<?}?>
			</div>	
		</div>
	<?endif?>	
	<?endif;?>
<!--simple-article-->
<?endif?>


<script src="<?=SITE_TEMPLATE_PATH?>/assets/scripts/tabby-12.0.3.min.js?v=XXXXXXa"></script>
<script>var tabs=new Tabby("[data-product-page-tabs]");tabs=new Tabby("[data-delivery-tabs]"),tabs=new Tabby("[data-pickup-tabs]"),tabs=new Tabby("[data-product-widget-tabs]")</script>
