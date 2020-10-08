<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

			<nav class="catalog-nav<?echo (CSite::InDir('/index.php') ? ' nav-catalog--main' : '');?>">
				<h4 class="catalog-nav__title" data-sreader>Каталог товаров</h4>
                  <button class="main-button main-button--plus catalog-nav__toggle<?echo (CSite::InDir('/index.php') ? ' catalog-nav__toggle--special' : '');?>" id="catalog-nav__toggle"><i class="simple-menu-icon main-button__icon"></i>Каталог товаров</button>
                  <div class="catalog-nav__wrap" id="catalog-nav__wrap">
                     <button class="catalog-nav__close" id="catalog-nav__close"><i class="colored-close-icon"></i>Закрыть</button>
				<ul class="catalog-nav__list<?echo (CSite::InDir('/index.php') ? ' active' : '');?>">

<?
$previousLevel = 0;
foreach($arResult as $arItem):
?>
<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>


	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="catalog-nav__item" ><a href="<?=$arItem['LINK']?>"  class="catalog-nav__lvl1-toggle"><?=$arItem["TEXT"]?></a>
				<!--lvl2-->
                <div class="catalog-nav__lvl2">
                    <button class="catalog-nav__back" data-lvl2-back><i class="catalog-back-icon"></i>Назад</button>
					<ul class="catalog-nav__lvl2-list">
		<?elseif($arItem["DEPTH_LEVEL"] == 2):?>
			<li class="catalog-nav__lvl2-item" ><a href="<?=$arItem['LINK']?>" class="catalog-nav__lvl2-toggle"><?=$arItem["TEXT"]?><i class="catalog-more-icon"></i></a>
				<!--lvl3-->
				<div class="catalog-nav__lvl3">
					<button class="catalog-nav__back" data-lvl3-back><i class="catalog-back-icon"></i>Назад</button>
										<div class="catalog-nav__lvl3-title"><?=$arItem["TEXT"]?></div>
										<ul class="catalog-nav__lvl3-list">
		<?else:?>
		      <li class="catalog-nav__lvl3-item" ><a href="<?=$arItem['LINK']?>" class="catalog-nav__lvl3-link"><?=$arItem["TEXT"]?></a></li>
		<?endif?>

	<?else:?>

	

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="nav-catalog__item" ><a href="<?=$arItem['LINK']?>" class="catalog-nav__lvl1-toggle"><?=$arItem["TEXT"]?></a></li>
				
		<?elseif($arItem["DEPTH_LEVEL"] == 2):?>
			<li class="catalog-nav__lvl2-item" ><a href="<?=$arItem['LINK']?>" class="catalog-nav__lvl2-link"><?=$arItem["TEXT"]?></a></li>
		<?else:?>
		      <li class="catalog-nav__lvl3-item" ><a href="<?=$arItem['LINK']?>" class="catalog-nav__lvl3-link"><?=$arItem["TEXT"]?></a></li>
		<?endif?>
		
		
		
	<?endif?>

		

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>		

		
	
<?endforeach?>


<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul>
</div>
</li>", ($previousLevel-1) );?>
<?endif?>

</ul>
</div>
</nav>

<?endif?>

