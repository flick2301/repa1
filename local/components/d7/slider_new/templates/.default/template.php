		<div class="intro-slider__list" id="intro-slider__list">
			   <?foreach($arResult["ITEMS"][$arParams["MAIN_SECTION_ID"]] AS $val):?>
			   <?if($val["PROPERTY"]["DOMEN"]["VALUE"] ==false || in_array($_SERVER['HTTP_HOST'], $val["PROPERTY"]["DOMEN"]["VALUE"]))
			   {
				   
						$count++;
						?>
						<div class="intro-slider__item">
							<img class="intro-slider__image" <?=$count>1 ? "src='".$this->GetFolder()."/img/area.webp' data-" : ""?>src="<?=$val["SMALL_IMG_WEBP"]['WEBP_SRC'] ? $val["SMALL_IMG_WEBP"]['WEBP_SRC'] : $val["SMALL_IMG"]["src"]?>"  width="904" height="290" alt="<?=$val["PREVIEW_TEXT"]?>" title="<?=$val["PREVIEW_TEXT"]?>">
							<?if($val["PROPERTY"]["SLIDER_LINK"]["VALUE"]):?><a class="intro-slider__link" href="<?=$val["PROPERTY"]["SLIDER_LINK"]["VALUE"]?>?banner_id=<?=$val['ID']?>">Подробнее</a><?endif?>  

						</div>
				   <?
			   }?>
				<?endforeach?> 
               </div>