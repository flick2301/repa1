<div class="slider">
	<div class="container">
		<div class="slider__wrapper">
			<div class="slider__leftside">
				<div class="slider__main owl-carousel">

					<?foreach($arResult["ITEMS"][$arParams["MAIN_SECTION_ID"]] AS $val):?>
						<?if($val["PROPERTY"]["DOMEN"]["VALUE"] ==false || in_array($_SERVER['HTTP_HOST'], $val["PROPERTY"]["DOMEN"]["VALUE"])) {
							$count++;
						?>

						<?if($val["PROPERTY"]["SLIDER_LINK"]["VALUE"]):?>

						<a class="slider__link" href="<?=$val["PROPERTY"]["SLIDER_LINK"]["VALUE"]?>?banner_id=<?=$val['ID']?>">
							<img class="slider__img" loading="lazy" src="<?=$val["SMALL_IMG_WEBP"]['WEBP_SRC'] ? $val["SMALL_IMG_WEBP"]['WEBP_SRC'] : $val["SMALL_IMG"]["src"]?>">
							<img class="slider__img slider__img--mobile" loading="lazy" src="<?=$val["SMALL_IMG_WEBP"]['WEBP_SRC'] ? $val["SMALL_IMG_WEBP"]['WEBP_SRC'] : $val["SMALL_IMG"]["src"]?>">
						</a>
						
						<?else:?>

						<a class="slider__link" href='javascript::void();'>
							<img class="slider__img" loading="lazy" src="<?=$val["SMALL_IMG_WEBP"]['WEBP_SRC'] ? $val["SMALL_IMG_WEBP"]['WEBP_SRC'] : $val["SMALL_IMG"]["src"]?>">
							<img class="slider__img slider__img--mobile" loading="lazy" src="<?=$val["SMALL_IMG_WEBP"]['WEBP_SRC'] ? $val["SMALL_IMG_WEBP"]['WEBP_SRC'] : $val["SMALL_IMG"]["src"]?>">
						</a>

						<?endif?>
						
					<?}?>
					<?endforeach?>
				</div>
				<div class="slider__wrapp">
					<div class="slider__navigation"></div>
				</div>
				<div class="slider__dots"></div>
			</div>
		</div>
	</div>
</div>