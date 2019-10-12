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
            
            
            if (isset($_POST['sbblchangeItemToCart'])){
                CSaleBasket::Update($_POST['sbblchangeItemToCart'][0], array('QUANTITY'=>$_POST['sbblchangeItemToCart'][1]));            
            }


            ?>
	    <div onclick="$('.popUp-container').popUp('close');" class="popUp-close"></div>
	</div>
	<table id="<?=$cartId?>" class="added-product">
	    
	    <tbody id="<?=$cartId?>products">	
            
            <?foreach ($arResult["CATEGORIES"] as $category => $items):
		if (empty($items))
		    continue;
	    ?>
	        <?foreach ($items as $v):?>
                
                <tr class="added-product__tr added-product__top">
		    <td class="added-product__td" colspan='3'>
                        <div class="added-product__title">Наименование:</div>
			<div class="basket-infomedia">
			    <div class="infomedia__img"><a href="<?=$v["DETAIL_PAGE_URL"]?>"><img src="<?=$v["PICTURE_SRC"]?>" alt=""></a></div>
			    <div class="infomedia__text">
				<a href="<?=$v["DETAIL_PAGE_URL"]?>" class="infomedia__link"><?=$v["NAME"]?></a>
				<span class="infomedia__price"><?=number_format($v["PRICE"], 2, '.', ' ');?> ₽</span>
			    </div>
			</div>
		    </td>
                </tr>
                <tr class='added-product__tr added-product__bottom'>
		    <td class="added-product__td">
                        <div class="added-product__title">Количество:</div>
			<div class="value added-product__value">
			    <a href="javascript:void(0)" onclick="<?=$cartId?>.changeItemToCart(<?=$v['ID']?>, <?=$v['QUANTITY']-1?>)" class="value__minus">—</a>
			    <input type="text" name="" value="<?=$v["QUANTITY"]?>" class="value__input">
			    <a href="javascript:void(0)" onclick="<?=$cartId?>.changeItemToCart(<?=$v['ID']?>, <?=$v['QUANTITY']+1?>)" class="value__plus">+</a>
			</div>
		    </td>
		    <td class="added-product__td">
                        <div class="added-product__title">Сумма:</div>
                        <div class="added-product__price"><?=number_format($v["SUM_VALUE"], 2, '.', ' ');?> ₽</div></td>
		    <td class="added-product__td" ><div class="added-product__close" onclick="<?=$cartId?>.removeItemFromCart(<?=$v['ID']?>)"></div></td>
		</tr>
            
            
                
                
				<?endforeach?>
			<?endforeach?>
            </tbody>
        </table>
        <div class="line-btn">
	    <a href="javascript:void();" onclick="$('.popUp-container').popUp('close');" class="white-btn">Продолжить покупки</a>
	    <a href="<?=$arParams['PATH_TO_ORDER']?>" class="blue-btn">Оформить заказ</a>
	</div>
	<div class="box-modal__separator"></div>
		
    </div>

	<script>
		BX.ready(function(){
			<?=$cartId?>.fixCart();
		});
	</script>
<?
}