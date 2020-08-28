<?foreach($arResult["ITEMS"] AS $key=>$item):?>
                  <!--contact-block-->
                  <article class="simple-article__section contact-block">
                     <div class="contact-block__info">
                        <h3 class="contact-block__title"><?=str_replace(" в ", "<br />в ", $item["NAME"])?></h3>
						<p class="contact-block__text"><?=$item["PROP"]["ADDRESS"]["~VALUE"]?></p>
                        <p class="contact-block__text"><?=$item["PREVIEW_TEXT"]?></p>
                        <ul class="contact-block__list">
                            <?if($item["PROP"]["PHONE"]["VALUE"]):?><li class="contact-block__data">
                              <a class="contact-block__link contact-block__link--phone" href="tel:<?=str_replace(" ", "", $item["PROP"]["PHONE"]["VALUE"])?>"><i class="social-phone-icon contact-block__icon"></i><?=str_replace(array("+7", "(", ")"), array("8", "", ""), $item["PROP"]["PHONE"]["VALUE"])?></a>
                           </li><?endif?>
                            <?if($item["PROP"]["EMAIL"]["VALUE"]):?><li class="contact-block__data">
                              <a class="contact-block__link contact-block__link--email" href="mailto:<?=$item["PROP"]["EMAIL"]["VALUE"]?>"><i class="social-email-icon contact-block__icon"></i><?=$item["PROP"]["EMAIL"]["VALUE"]?></a>
                           </li><?endif?>						   
                            <?if($item["PROP"]["SKYPE"]["VALUE"]):?><li class="contact-block__data">
                              <a class="contact-block__link" href="skype:<?=$item["PROP"]["SKYPE"]["VALUE"]?>"><i class="social-skype-icon contact-block__icon"></i><?=$item["PROP"]["SKYPE"]["VALUE"]?></a>
                           </li><?endif?>
                        </ul>
                     </div>
                     <div class="contact-block__maps" id="map<?=$arParams["SECTION_ID"]?><?=($key + 1)?>">
                        <?=$item["DETAIL_TEXT"]?>
                     </div>
                  </article>
                  <!--contact-block-->
<?endforeach?>