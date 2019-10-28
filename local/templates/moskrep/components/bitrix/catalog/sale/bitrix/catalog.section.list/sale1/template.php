<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->setFrameMode(true);

?>



<h1 class="s38-title"><?=$APPLICATION->GetTitle();?></h1>
<nav class="nav-sale">
    <ul class="nav-sale__items">
<?
    foreach ($arResult['SECTIONS'] as &$arSection)
    {
?>
        <li class="nav-sale__item">
            <a href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self" class="nav-sale__link">
                <div class="nav-sale__lable">sale</div>
                <div class="nav-sale__img">
                    <img src="<?=$arSection['PICTURE']['src']?>" alt="">
                </div>
                <span class="nav-sale__title"><span><?=$arSection['NAME']?></span></span>
            </a>
        </li>
    <?}?>		
    </ul>
</nav>


