<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$cartId = "bx_basket1";
$arParams['cartId'] = $cartId;
$this->setFrameMode( true );

?>

<script>
	var <?=$cartId?> = new BitrixSmallCart;
</script>

<div class="client-widget__cart header-basket" style='margin-top:0px !important;' id="<?=$cartId?>">
	<?
        
	/** @var \Bitrix\Main\Page\FrameBuffered $frame */
	$frame = $this->createFrame($cartId, false)->begin();
	require(realpath(dirname(__FILE__)) . '/ajax_template.php');
        
	$frame->beginStub();
        
	$arResult['COMPOSITE_STUB'] = 'Y';
	require(realpath(dirname(__FILE__)) . '/top_template.php');
	unset($arResult['COMPOSITE_STUB']);
	$frame->end();
	?>
</div>
<div class='header-basket-none'>
Уточните у менеджера
<?

/** @var \Bitrix\Main\Page\FrameBuffered $frame */
	//$frame = $this->createFrame($cartId, false)->begin();
	
	//require(realpath(dirname(__FILE__)) . '/ajax_form.php');
	//$frame->beginStub();
        
	
	?>
    
</div>
<div class='header-basket-sberbank'>
    После обработки заказа менеджер свяжется с Вами и вышлет ссылку для оплаты по карте!
</div>


<script>
	<?=$cartId?>.siteId       = '<?=SITE_ID?>';
	<?=$cartId?>.cartId       = '<?=$cartId?>';
	<?=$cartId?>.ajaxPath     = '<?=$componentPath?>/ajax.php';
	<?=$cartId?>.templateName = '<?=$templateName?>';
	<?=$cartId?>.arParams     =  <?=CUtil::PhpToJSObject ($arParams)?>;
	<?=$cartId?>.closeMessage = '<?=GetMessage('TSB1_COLLAPSE')?>';
	<?=$cartId?>.openMessage  = '<?=GetMessage('TSB1_EXPAND')?>';
	<?=$cartId?>.activate();

</script>

