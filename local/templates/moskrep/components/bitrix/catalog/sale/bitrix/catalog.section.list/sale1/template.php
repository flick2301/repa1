<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->setFrameMode(true);

?>


<!--page-heading-->
            <header class="basic-layout__module page-heading">
               <h1 class="page-heading__title"><?=$APPLICATION->GetTitle();?></h1>
            </header>
<!--page-heading-->
<!--catalog-feed-->
            <div class="basic-layout__module catalog-feed">
               <div class="catalog-feed__list">
			   <?
				foreach ($arResult['SECTIONS'] as &$arSection)
				{
				?>
                  <div class="catalog-feed__item">
                     <!--catalog-card-->
                     <section class="catalog-card">
                        <h3 class="catalog-card__title"><a class="catalog-card__link" href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self"><?=$arSection['NAME']?></a></h3>
                        <p class="catalog-card__badge">Sale</p>
                        <div class="catalog-card__cover">
                           <img class="catalog-card__image" src="<?=$arSection['PICTURE']['src']?>" width="262" height="197" alt="<?=$arSection['NAME']?>" title="<?=$arSection['NAME']?>" />
                        </div>
                     </section>
                     <!--catalog-card-->
                  </div>
				<?}?>
				</div>
			</div>
<!--catalot-feed-->


