<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


global $APPLICATION;
include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");
$ral_in_ar = $arResult['ITEMS'][0]['PROPERTIES']["TSVET"]["VALUE"];

//Параметр FOR_SEO устанавливается если это раздел справочника, а не каталога
//А значит текст и заголовок(шапка) не берутся из каталога, а из справочника, значит условие FOR_SEO != Y
if($arParams['FOR_SEO']!='Y'){
    

    $APPLICATION->SetPageProperty('title', $arResult["NAME"].", цена - купить в интернет-магазине в Москве");

    $clock = date('G');
	
	
    ?>

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

<div class="catalog-filter catalog-filter--new">


    <div class="catalog-filter__item">
        <ul class="show-list show-list--model">
        <?$APPLICATION->ShowViewContent('filter_in_upakovka');?>
        </ul>
    </div>
    <div class="catalog-filter__item" style="float:right">

        <?$APPLICATION->ShowViewContent('filter_in_stock_2');?>
    </div>
</div>

<div class="sale-category sale-category--new">
    <table class="blue-table price-category <?=($ral_in_ar) ? 'blue-table__8-rows' : 'blue-table__7-rows';?>">
	<thead class="blue-table__thead">
            <tr class="blue-table__tr">
                <th class="blue-table__th blue-table__name"><span class='link-sorting'><span class="link-sorting__style">Размер,мм</span></span></th>
                
                <th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Фасовка</span></span></th>
		<th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Артикул</span></span></th>
                <th class="blue-table__th"><span class="link-sorting"><span class="link-sorting__style">Наличие</span></span></th>
		<th class="blue-table__th"><span class="link-sorting"><span class="link-sorting__style">Получение</span></span></th>
                
            <?if($ral_in_ar){?>
		<th class="blue-table__th"><span class='link-sorting'><span class="link-sorting__style">Цвет, RAL</span></span></th>
            <?}?>
                
		<th class="blue-table__th blue-table__price"><span class='link-sorting'><span class="link-sorting__style">Стоимость</span></span></th>
		<th class="blue-table__th">Купить</th>
	    </tr>
	</thead>
    <tbody class="blue-table__tbody">
						
			
				
<?php
    foreach($arResult['SIZES'] as $key=>$size){
        
        $index=0;
        foreach ($size as $item)
        {
			
            
            $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['PRICES'][ID_BASE_PRICE]['VALUE'];
            $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        ?>
        
        
        <tr class="blue-table__tr">
            <?if($index==0){?>
            <td rowspan='<?=count($size);?>' class="blue-table__td"><strong class="name-b"><?=$item['SIZES']?>
                    <div class="name-b__photo">
                        <img src="<?=$item['PREVIEW_PICTURE']['src']?>" alt='<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?>' />
                    </div>
                </strong></td>
	    <?
            
            }
            $index++;
            ?>
           
            <td class="blue-table__td"><span class="articul-b"><a class="name_b" href="<?=$item['DETAIL_PAGE_URL']?>" target="_self"><?=($item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"]) ? $item['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"] : '1';?> <?=$item['UNIT']?></a></span></td>
            <td class="blue-table__td"><span class="articul-b"><a href="<?=$item['DETAIL_PAGE_URL']?>" target="_self"><?=$item['PROPERTIES']["CML2_ARTICLE"]["VALUE"]?>
                    </a></span></td>
	        <td class="blue-table__td"><?echo ($item['CATALOG_QUANTITY']+$item['CATALOG_QUANTITY_RESERVED']) ? '<span class="availability-b active">В наличии</span>' : '<span class="availability-b">Под заказ</span>';?></td>
            <td class="blue-table__td">
								<span class="pickup-view">
									<div class="pickup-block">
										<strong>Самовывоз</strong>
										<p><?echo STORE_ID_KASHIRKA['1'];?><br> <?echo STORE_ID_KASHIRKA['2'];?></p>
										<p>В наличии: <strong class="icon-nal"><?=$item['STORE'][STORE_ID_KASHIRKA[0]]['AMOUNT']?> уп.</strong></p>
										<p>Доступно к получению: <strong><?=($item['STORE'][STORE_ID_KASHIRKA[0]]['AMOUNT'] && $clock<17) ? "Сегодня" : (($item['STORE'][STORE_ID_KASHIRKA[0]]['AMOUNT']) ? "Завтра c 9:00" : (($item['STORE'][STORE_ID_KOLEDINO[0]]['AMOUNT']) ? (($clock<17) ? "Сегодня при заказе до 14:30" : "Завтра при заказе до 14:30")  : "Под заказ"))?></strong></p>
										<div class="separator-block"></div>
										<p><?echo STORE_ID_KOLEDINO['1'];?><br> <?echo STORE_ID_KOLEDINO['2'];?></p>
										<p>В наличии: <strong class="icon-nal"><?=$item['STORE'][STORE_ID_KOLEDINO[0]]['AMOUNT']?> уп.</strong></p>
										<p>Доступно к получению: <strong><?=($item['STORE'][STORE_ID_KOLEDINO[0]]['AMOUNT'] && $clock<17) ? "Сегодня" : (($item['STORE'][STORE_ID_KOLEDINO[0]]['AMOUNT']) ? "Завтра c 9:00" : "Под заказ")?></strong></p>
                                        <div class="separator-block"></div>
										<p><?echo STORE_ID_UZHKA['1'];?><br> <?echo STORE_ID_UZHKA['2'];?></p>
										<p>В наличии: <strong class="icon-nal"><?=$item['STORE'][STORE_ID_UZHKA[0]]['AMOUNT']?> уп.</strong></p>
										<p>Доступно к получению: <strong><?=($item['STORE'][STORE_ID_UZHKA[0]]['AMOUNT'] && $clock<17) ? "Сегодня" : (($item['STORE'][STORE_ID_UZHKA[0]]['AMOUNT']) ? "Завтра c 9:00" : (($item['STORE'][STORE_ID_KOLEDINO[0]]['AMOUNT']) ? (($clock<17) ? "Сегодня при заказе до 14:30" : "Завтра при заказе до 14:30") : "Под заказ"))?></strong></p>
									</div>
								</span>
								<span class="delivery-view">
									<div class="delivery-block">
										<strong>Доставка</strong>
										<p>На следующий день<br> При заказе до 16:00</p>
									</div>
								</span>
							</td>
	<?if($ral_in_ar){?>
            <td class="blue-table__td"><div class="color-b"><i style="background: #<?=$array_rals[$item['PROPERTIES']["TSVET"]["VALUE"]]?>;"></i><?=$item['PROPERTIES']["TSVET"]["VALUE"]?></div></td>
        <?}?>
            
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
			<input type="text" name="" id="QUANTITY_<?=$item['ID']?>" value="1" class="value__input">
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






<?if($arResult['ID']==1657):?>
<div class="tech_title">Технические характеристики</div>
<table class="tech" cellpadding="0" cellspacing="0" rules="all">
<tr>
<th>Диаметр	внешний (мм)</th>
<th>Длина (мм)</th>
<th>Диаметр резьбы</th>
<th>Размер под ключ (мм)</th>
<th>Толщина прикрепляемого материала (мм)</th>
<th>Диаметр бура</th>
</tr>
<tr><td>8</td><td>45</td><td>м6</td><td>10</td><td>5</td><td>8</td></tr>
<tr class="dark"><td>8</td><td>60</td><td>м6</td><td>10</td><td>20</td><td>8</td></tr>
<tr><td>8</td><td>80</td><td>м6</td><td>10</td><td>40</td><td>8</td></tr>
<tr class="dark"><td>8</td><td>85</td><td>м6</td><td>10</td><td>50</td><td>8</td></tr>
<tr><td>8</td><td>100</td><td>м6</td><td>10</td><td>60</td><td>8</td></tr>
<tr class="dark"><td>10</td><td>50</td><td>м8</td><td>13</td><td>5</td><td>10</td></tr>
<tr><td>10</td><td>55</td><td>м8</td><td>13</td><td>6</td><td>10</td></tr>
<tr class="dark"><td>10</td><td>60</td><td>м8</td><td>13</td><td>10</td><td>10</td></tr>
<tr><td>10</td><td>80</td><td>м8</td><td>13</td><td>25</td><td>10</td></tr>
<tr class="dark"><td>10</td><td>85</td><td>м8</td><td>13</td><td>30</td><td>10</td></tr>
<tr><td>10</td><td>100</td><td>м8</td><td>13</td><td>45</td><td>10</td></tr>
<tr class="dark"><td>10</td><td>110</td><td>м8</td><td>13</td><td>55</td><td>10</td></tr>
<tr><td>10</td><td>120</td><td>м8</td><td>13</td><td>65</td><td>10</td></tr>
<tr class="dark"><td>10</td><td>125</td><td>м8</td><td>13</td><td>70</td><td>10</td></tr>
<tr><td>10</td><td>130</td><td>м8</td><td>13</td><td>75</td><td>10</td></tr>
<tr class="dark"><td>10</td><td>140</td><td>м8</td><td>13</td><td>85</td><td>10</td></tr>
<tr><td>12</td><td>65</td><td>м10</td><td>17</td><td>3</td><td>12</td></tr>
<tr class="dark"><td>12</td><td>70</td><td>м10</td><td>17</td><td>5</td><td>12</td></tr>
<tr><td>12</td><td>80</td><td>м10</td><td>17</td><td>10</td><td>12</td></tr>
<tr class="dark"><td>12</td><td>100</td><td>м10</td><td>17</td><td>20</td><td>12</td></tr>
<tr><td>12</td><td>110</td><td>м10</td><td>17</td><td>30</td><td>12</td></tr>
<tr class="dark"><td>12</td><td>120</td><td>м10</td><td>17</td><td>40</td><td>12</td></tr>
<tr><td>12</td><td>130</td><td>м10</td><td>17</td><td>50</td><td>12</td></tr>
<tr class="dark"><td>12</td><td>140</td><td>м10</td><td>17</td><td>60</td><td>12</td></tr>
<tr><td>12</td><td>150</td><td>м10</td><td>17</td><td>70</td><td>12</td></tr>
<tr class="dark"><td>12</td><td>160</td><td>м10</td><td>17</td><td>80</td><td>12</td></tr>
<tr><td>16</td><td>75</td><td>м12</td><td>19</td><td>5</td><td>16</td></tr>
<tr class="dark"><td>16</td><td>100</td><td>м12</td><td>19</td><td>10</td><td>16</td></tr>
<tr><td>16</td><td>110</td><td>м12</td><td>19</td><td>20</td><td>16</td></tr>
<tr class="dark"><td>16</td><td>130</td><td>м12</td><td>19</td><td>40</td><td>16</td></tr>
<tr><td>16</td><td>150</td><td>м12</td><td>19</td><td>60</td><td>16</td></tr>
<tr class="dark"><td>16</td><td>220</td><td>м12</td><td>19</td><td>120</td><td>16</td></tr>
<tr><td>20</td><td>100</td><td>м16</td><td>24</td><td>10</td><td>20</td></tr>
<tr class="dark"><td>20</td><td>110</td><td>м16</td><td>24</td><td>15</td><td>20</td></tr>
<tr><td>20</td><td>140</td><td>м16</td><td>24</td><td>40</td><td>20</td></tr>
<tr class="dark"><td>20</td><td>150</td><td>м16</td><td>24</td><td>50</td><td>20</td></tr>
<tr><td>20</td><td>160</td><td>м16</td><td>24</td><td>60</td><td>20</td></tr>
<tr class="dark"><td>20</td><td>200</td><td>м16</td><td>24</td><td>100</td><td>20</td></tr>
</table>

<div class="tech_title">Параметры монтажа</div>
<table class="tech" cellpadding="0" cellspacing="0" rules="all">
<tr><th>Диаметр анкера</th><th>8</th><th>10</th><th>12</th><th>16</th><th>20</th></tr>
<tr><td>Мин. глубина отверстия (мм)</td><td>50</td><td>60</td><td>70</td><td>80</td><td>90</td></tr>
<tr class="dark"><td>Диаметр отверстия в детали (мм)</td><td>9</td><td>11</td><td>13</td><td>17</td><td>21</td></tr>
<tr><td>Мин. толщина основания (мм)</td><td>70</td><td>80</td><td>90</td><td>100</td><td>120</td></tr>
<tr class="dark"><td>Критическое расстояние до края (мм)</td><td>55</td><td>65</td><td>70</td><td>80</td><td>85</td></tr>
<tr><td>Критическое осевое расстояние (мм)</td><td>60</td><td>70</td><td>75</td><td>90</td><td>95</td></tr>
<tr class="dark"><td>Момент затяжки в бетоне (Нм)</td><td>8</td><td>25</td><td>40</td><td>50</td><td>80</td></tr>
<tr><td>Момент затяжки в кирпиче (Нм)</td><td>4</td><td>12,5</td><td>20</td><td>25</td><td></td></tr>
</table>

<div class="tech_title">Рассчетное усилие на вырывание и срез</div>
<table class="tech" cellpadding="0" cellspacing="0" rules="all">
<tr><th colspan="6">Бетон B20</th></tr>
<tr><td>Диаметр анкера</td><td>8</td><td>10</td><td>12</td><td>16</td><td>20</td></tr>
<tr class="dark"><td>Усилие на вырывание N (kH)</td><td>1,4</td><td>2,1</td><td>2,8</td><td>4,2</td><td>5,6</td></tr>
<tr><td>Усилие на срез Q (kH)</td><td>2,5</td><td>4,5</td><td>7,3</td><td>8,8</td><td>10,5</td></tr>
</table>


<table class="tech" cellpadding="0" cellspacing="0" rules="all">
<tr><th colspan="5">Кирпич М150</th></tr>
<tr><td>Диаметр анкера</td><td>8</td><td>10</td><td>12</td><td>16</td></tr>
<tr class="dark"><td>Усилие на вырывание N (kH)</td><td>0,5</td><td>0,6</td><td>0,8</td><td>0,9</td></tr>
<tr><td>Усилие на срез Q (kH)</td><td>1</td><td>1,2</td><td>1,6</td><td>1,8</td></tr>
</table>

<div class="tech_title">Схема монтажа</div>
<ol class="tech">
<li>Просверлить отверстие</li>
<li>Очистить отверстие от пыли</li>
<li>Установить анкер через деталь</li>
<li>Закрутить анкер</li>
<ol>
<br />

<img src="/img/anker-bolt.jpg" alt="Схема монтажа. Анкер-болт" />
<?endif?>





<?if($arResult['UF_DETAIL_TEXT']):?>
<div class='set-default-parametr-page-cat'><?=html_entity_decode($arResult['UF_DETAIL_TEXT'], ENT_QUOTES, "UTF-8");?></div>
<?endif;?>

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

		