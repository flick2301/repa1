<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Доставка");
?>

<?$APPLICATION->SetAdditionalCSS($APPLICATION->GetCurPage()."style.css", true);?>

<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array()); ?>
			<h1 class="s38-title"><?=$APPLICATION->ShowTitle();?></h1>

<ul class='delivery_items'>
	<li data-tab='tab_1' class='delivery_item active'>Москва и МО</li>
	<li data-tab='tab_2' class='delivery_item spb'>Санкт-Петербург и ЛО</li>
	<li data-tab='tab_3' class='delivery_item'>Доставка по России</li>
</ul>



<div id='tab_1' class='delivery__tabs-list active'>
<?
$APPLICATION->IncludeFile(
 $APPLICATION->GetCurPage()."tab1.php",
 array(),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
</div>


<div id='tab_2' class='delivery__tabs-list spb'>
<?
$APPLICATION->IncludeFile(
 $APPLICATION->GetCurPage()."tab2.php",
 array(),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
</div>


<div id='tab_3' class='delivery__tabs-list'>
<?
$APPLICATION->IncludeFile(
 $APPLICATION->GetCurPage()."tab2.php",
 array(),
 array("SHOW_BORDER" => true, "MODE"=>"php")
);
?>
</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>