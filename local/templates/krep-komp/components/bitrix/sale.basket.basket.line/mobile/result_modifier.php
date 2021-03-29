<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
if (isset($_POST['sbblchangeItemToCart'])){
				
                CSaleBasket::Update($_POST['sbblchangeItemToCart'][0], array('QUANTITY'=>$_POST['sbblchangeItemToCart'][1]));
				?>
				<script>
				BX.onCustomEvent('OnBasketChange');
				</script>
				<?
				
}