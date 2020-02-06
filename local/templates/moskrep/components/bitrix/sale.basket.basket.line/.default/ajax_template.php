<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];

require(realpath(dirname(__FILE__)) . '/top_template.php');


if ($arParams["SHOW_PRODUCTS"] == "Y" && ($arResult['NUM_PRODUCTS'] > 0 || !empty($arResult['CATEGORIES']['DELAY'])))
{
?>
	
    <div class="box-modal" id="added-basket">
        <div  class="box-modal__head">
	    <div class="box-modal__title">Товар добавлен в корзину</div>
            <?
            
            
           


            ?>
	    <div onclick="$('.popUp-container').popUp('close');" class="popUp-close"></div>
	</div>
	<table id="<?=$cartId?>" class="added-product">
	    <thead>
		<tr class="added-product__tr">
		    <th class="added-product__th">Наименование:</th>
		    <th class="added-product__th">Количество:</th>
		    <th class="added-product__th">Сумма:</th>
		    <th class="added-product__th">Удалить:</th>
		</tr>
	    </thead>
	    <tbody id="<?=$cartId?>products">	
            
            <?foreach ($arResult["CATEGORIES"] as $category => $items):
		if (empty($items))
		    continue;
                    
                    //Выбираем последний элемент добавленный в корзину( чтобы отобразить все нужно оставить $items
                    $item_last=array($items[$arResult['NUM_PRODUCTS']-1]);
                    
	    ?>
	        <?foreach ($item_last as $v):?>
                
                <tr class="added-product__tr">
		    <td class="added-product__td">
			<div class="basket-infomedia">
			    <div class="infomedia__img"><a href="<?=$v["DETAIL_PAGE_URL"]?>"><img src="<?echo ($v["PICTURE_SRC"]) ? $v["PICTURE_SRC"] : "/images/no_image.jpg";?>" alt=""></a></div>
			    <div class="infomedia__text">
				<a href="<?=$v["DETAIL_PAGE_URL"]?>" class="infomedia__link"><?=$v["NAME"]?></a>
				<span class="infomedia__price"><?=number_format($v["PRICE"], 2, '.', ' ');?> ₽</span>
			    </div>
			</div>
		    </td>
		    <td class="added-product__td">
			<div class="value added-product__value">
			    <a href="javascript:void(0)" onclick="<?=$cartId?>.changeItemToCart(<?=$v['ID']?>, <?=$v['QUANTITY']-1?>)" rel="nofollow" class="value__minus">—</a>
			    <input type="text" name="value__input" onchange='<?=$cartId?>.changeItemToCart(<?=$v['ID']?>, $(this).val())' value="<?=$v["QUANTITY"]?>" data-product='<?=$v['ID']?>' class="value__input">
			    <a href="javascript:void(0)" onclick="<?=$cartId?>.changeItemToCart(<?=$v['ID']?>, <?=$v['QUANTITY']+1?>)" rel="nofollow" class="value__plus">+</a>
			</div>
		    </td>
		    <td class="added-product__td"><div class="added-product__price"><?=number_format($v["SUM_VALUE"], 2, '.', ' ');?> ₽</div></td>
		    <td class="added-product__td" ><div class="added-product__close" onclick="<?=$cartId?>.removeItemFromCart(<?=$v['ID']?>)"></div></td>
		</tr>
		          
        <?$prod_id = $v['PRODUCT_ID'];?>
              <?if($USER->IsAdmin()){
				
				\Bitrix\Main\Loader::includeModule('iblock');				
				$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, 'ID'=>$v['PRODUCT_ID']);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), array('*'));
				if($ob = $res->GetNextElement())
				{
					$arProperties = $ob->GetProperties();
					$arArt=explode(';', trim($arProperties['SOPUTSTVUYUSHCHIE_TOVARY']['VALUE'],';'));
					
				}
				  
				$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, 'PROPERTY_CML2_ARTICLE'=>$arArt);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), array('*'));
				while($ob = $res->GetNextElement())
				{
					$Fielsd = $ob->GetFields();
					$arProperties = $ob->GetProperties();
					
					//echo $Fielsd['ID'].' = '.$arProperties['CML2_ARTICLE']['VALUE'].'<br />';
				}
					
			  }
				?>
                
				<?endforeach?>
			<?endforeach?>
            </tbody>
        </table>
        <div class="line-btn">
	    <a href="#" onclick="$('.popUp-container').popUp('close');" class="white-btn">Продолжить покупки</a>
	    <a href="<?=$arParams['PATH_TO_BASKET']?>" class="blue-btn">Перейти в корзину</a>
	</div>
	<?if($USER->IsAdmin()){
				
				\Bitrix\Main\Loader::includeModule('iblock');				
				$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, 'ID'=>$v['PRODUCT_ID']);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), array('*'));
				if($ob = $res->GetNextElement())
				{
					$arProperties = $ob->GetProperties();
					$arArt=explode(';', trim($arProperties['SOPUTSTVUYUSHCHIE_TOVARY']['VALUE'],';'));
					if($arProperties['SOPUTSTVUYUSHCHIE_TOVARY']['VALUE']){
						?><div class="box-modal__title">Сопутствующие товары:</div><?
					}
					
				}
				  
				$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, 'PROPERTY_CML2_ARTICLE'=>$arArt);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), array('*'));
				while($ob = $res->GetNextElement())
				{
					$Fielsd = $ob->GetFields();
					$arProperties = $ob->GetProperties();
					
					?>
					<div class="basket-infomedia">
						<div class="infomedia__img"><a href="<?=$Fielsd["DETAIL_PAGE_URL"]?>"><img style='width:65px;' src="<?echo ($Fielsd["PREVIEW_PICTURE"]) ? CFile::GetPath($Fielsd["PREVIEW_PICTURE"]) : "/images/no_image.jpg";?>" alt=""></a></div>
						<div class="infomedia__text">
							<a href="<?=$Fielsd["DETAIL_PAGE_URL"]?>" class="infomedia__link"><?=$Fielsd["NAME"]?></a>
							
						</div>
					</div>
					<?
					//echo $Fielsd['ID'].' = '.$arProperties['CML2_ARTICLE']['VALUE'].'<br />';
				}
					
			  }
				?>
	
	<div class="box-modal__separator"></div>
		
    </div>

	<script>
		BX.ready(function(){
			<?=$cartId?>.fixCart();
		});
	</script>
<?
}