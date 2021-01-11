<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->setFrameMode(true);

?>



<h1 class="s28-title"><?=$arResult["SECTION"]["NAME"]?></h1>

<ul class="card-nav-product">
<?
    foreach ($arResult['SECTIONS'] as &$arSection)
    {
 ?>
    <li class="card-nav-product__item">
        <a href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self" class="card-nav-product__link">
            <div class="card-nav-img">
                <img src="<?=$arSection['PICTURE']['src']?>" alt="">
            </div>
            <div class="card-nav-text"><?=$arSection['NAME']?></div>
        </a>
    </li>
  <?}?>		
</ul>



