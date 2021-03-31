<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$cartId = "bx_basket2";
$arParams['cartId'] = $cartId;
$this->setFrameMode( true );
?>

<script>
	var <?=$cartId?> = new BitrixSmallCart;
</script>

<div class="shelf__basket" id='<?=$cartId?>'>
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


