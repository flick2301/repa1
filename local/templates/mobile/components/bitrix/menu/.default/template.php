<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

			<nav class="nav-catalog">
				<a href="javascript:void(0)" class="nav-catalog__btn">Каталог товаров</a>
                                <div class='nav-catalog__wrap'>
                                    <div class="nav-catalog__wrap-close"><a href="javascript:void(0);" class="nav-catalog__close">Каталог товаров</a></div>
                                    <ul class="nav-catalog__items">

                                        <?
                                        $previousLevel = 0;
                                        foreach($arResult as $arItem):
                                        ?>
                                            <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                                                <?=str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
                                            <?endif?>


                                            <?if ($arItem["IS_PARENT"]):?>

                                            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                                <li class="nav-catalog__item level-item-one-1"><a href="<?=$arItem['LINK']?>" class="nav-catalog__link"><?=$arItem["TEXT"]?></a>
                                                    <div class="catalog-level-two__wrap">
                                                        <div class="catalog-level-two__title"><?=$arItem["TEXT"]?></div>
							<ul class="catalog-level-two__items">
                                            <?elseif($arItem["DEPTH_LEVEL"] == 2):?>
                                                
                                                <li class="catalog-level-two__item"><a href="<?=$arItem['LINK']?>" class="catalog-level-two__link"><?=$arItem["TEXT"]?></a>
				<div class="catalog-level-three__wrap">
										<div class="catalog-level-three__title"><?=$arItem["TEXT"]?></div>
										<ul class="catalog-level-three__items">
		<?else:?>
		      <li class="catalog-level-three__item"><a href="<?=$arItem['LINK']?>" class="catalog-level-three__link"><?=$arItem["TEXT"]?></a></li>
		<?endif?>

	<?else:?>

	

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="nav-catalog__item"><a href="<?=$arItem['LINK']?>" class="nav-catalog__link"><?=$arItem["TEXT"]?></a></li>
				
		<?elseif($arItem["DEPTH_LEVEL"] == 2):?>
			<li class="catalog-level-two__item"><a href="<?=$arItem['LINK']?>" class="catalog-level-two__link"><?=$arItem["TEXT"]?></a></li>
		<?else:?>
		      <li class="catalog-level-three__item"><a href="<?=$arItem['LINK']?>" class="catalog-level-three__link"><?=$arItem["TEXT"]?></a></li>
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