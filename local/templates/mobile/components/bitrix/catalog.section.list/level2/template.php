<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->setFrameMode(true);

?>


<h1 class="s28-title"><?=$arResult["SECTION"]["NAME"]?></h1>
<nav class="nav-sale">
    <ul class="nav-sale__items">
<?
    foreach ($arResult['SECTIONS'] as &$arSection)
    {
?>
        <li class="nav-sale__item">
            <a href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self" class="nav-sale__link">
                <div class="nav-sale__img">
                    <img src="<?=$arSection['PICTURE']['src']?>" alt="">
                </div>
                <span class="nav-sale__title"><?=$arSection['NAME']?></span>
            </a>
        </li>
    <?}?>		
    </ul>
</nav>


 <div class="content-feedback">
		<?$rsSites = CSite::GetByID("s1");
         $arSite = $rsSites->Fetch();?>
        <?$APPLICATION->IncludeComponent(
	"d7:main.feedback",
	"",
	Array(
		"EMAIL_TO" => $arSite["EMAIL"],
		"EVENT_MESSAGE_ID" => array("7"),
		"OK_TEXT" => "Спасибо, ваше сообщение отправлено.",
		"REQUIRED_FIELDS" => array("NAME","EMAIL","MESSAGE"),
		"USE_CAPTCHA" => "N",
                "MOBILE_VERSION" => "Y"
	)
);?> 
	</div> 