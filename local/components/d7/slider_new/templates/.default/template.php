               <div class="intro-slider__list" id="intro-slider__list">
			   <?foreach($arResult["ITEMS"][$arParams["MAIN_SECTION_ID"]] AS $val):?>
                  <div class="intro-slider__item">
                     <img class="intro-slider__image" src="<?=$val["SMALL_IMG"]["src"]?>" width="904" height="290" alt="<?=$val["NAME"]?>">
                     <?if($val["PROPERTY"]["SLIDER_LINK"]["VALUE"]):?><a class="intro-slider__link" href="<?=$val["PROPERTY"]["SLIDER_LINK"]["VALUE"]?>">Подробнее</a><?endif?>  

                  </div>
				<?endforeach?> 
               </div>