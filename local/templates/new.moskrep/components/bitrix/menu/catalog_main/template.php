<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<div id="catalog_main_mobile_menu">
	<div class="menu_close_bar">
		<span></span>
		<div>Каталог</div>
	</div>
	<div class="items">
	<?foreach ($arResult["ITEMS"] AS $key=>$arItem): $cnt++;?>
		<div data-rel="<?=$cnt?>">
			<p data-rel="<?=$cnt?>" class="catalog-nav__item level1 <?if ($arItem["IS_PARENT"]):?>parent<?endif?>">
				<a href="<?=$arItem['LINK']?>"  class="catalog-nav__lvl1-toggle"><span><span><?=$arItem["TEXT"]?></span></span></a>
			</p>
			<?if ($arItem["IS_PARENT"]):?>
			<div data-rel="<?=$cnt?>" class="children level1">
				<?foreach ($arItem["ITEMS"] AS $arItem_2): $cnt++;?>
					<p data-rel="<?=$cnt?>" class="catalog-nav__item level2 <?if ($arItem_2["IS_PARENT"]):?>parent<?endif?>">
						<a href="<?=$arItem_2['LINK']?>"  class="catalog-nav__lvl1-toggle"><span><span><?=$arItem_2["TEXT"]?></span></span></a>
					</p>
					<?if ($arItem["IS_PARENT"]):?>	
						<!--lvl3-->
						<div data-rel="<?=$cnt?>" class="children level2">		
						<?foreach ($arItem_2["ITEMS"] AS $arItem_3): $cnt++;?>
							<p class="catalog-nav__item level3">
								<a href="<?=$arItem_3['LINK']?>"  class="catalog-nav__lvl1-toggle">
									<span><span><?=$arItem_3["TEXT"]?></span></span>
								</a>
							</p>					
						<?endforeach?>		

						</div>		
					<?endif?>							
				<?endforeach?>
						
			</div>						
			<?endif?>
		</div>	
	<?endforeach?>
	</div>
</div>
<?unset($cnt);?>









<div id="new_catalog_bar">

	<button class="main-button main-button--plus catalog-nav__toggle <?if(MOBILE=="Y"):?>open_mobile_menu<?else:?>open_menu<?endif?>" id="catalog-nav__toggle"><i class="simple-menu-icon main-button__icon"></i>Каталог&nbsp;<span>товаров</span></button>

	<nav class="catalog_main_menu">
        <div id="catalog_main_menu">
			<div class="basic-layout__section">
				<div class="left">
				  

				<?$limit = 6;?>
				<?foreach ($arResult["ITEMS"] AS $key=>$arItem):?>
					<?$cnt = 0; $count = 0;?>
				
					<div class="catalog-nav__item<?if(!$key):?> first<?endif?>" >
						<a href="<?=$arItem['LINK']?>"  class="catalog-nav__lvl1-toggle">
							<span><?=$arItem["TEXT"]?></span>
						</a>
						<!--lvl1-->
				
						<?foreach ($arItem["ITEMS"] AS $arItem_2):?>
							<?$cnt += (count($arItem_2["ITEMS"]) < $limit ? count($arItem_2["ITEMS"]) : $limit) + 2;?>
							<?
							/*УТОЧНИТЬ ЗАЧЕМ ЭТО??
								if (count($arItem_2["ITEMS"])) $arNewItem["ITEMS"][] = $arItem_2;
								else $arNewItem2["ITEMS"][] = $arItem_2;
							*/
							?>
						<?endforeach?>
				
						<?
						if (count($arNewItem["ITEMS"]) && count($arNewItem["ITEMS"]))
							$arItem["ITEMS"] = array_merge($arNewItem["ITEMS"], $arNewItem2["ITEMS"]);
						unset($arNewItem, $arNewItem2);
						?>
						
						<div class="item_title"><?=$arItem["TEXT"]?></div>
						<?if ($arItem["IS_PARENT"]):?>
							<div class="catalog-nav__lvl2_new">
							<!--lvl2-->
								<div class="catalog-nav__lvl2_new-list" data-count='<?=$count?>' data-cnt='<?=$cnt?>'>
									<div data-count='<?=count($arItem_2["ITEMS"])?>'>					
									<?foreach ($arItem["ITEMS"] AS $arItem_2):
										$cnt_item = 0;
										if(!count($arItem_2["ITEMS"]))
											$no_count++;
										else 
											$no_count = 0;
										
										if((($count + 2) > $cnt/4) && (count($arItem_2["ITEMS"]) || $no_count == 1)):
											$count = 0;?>
									</div>
									<div>
										<?endif;
										$count = $count + 2;?>
										
										<?if (!count($arItem_2["ITEMS"])):?>						
											<div class="catalog-nav__lvl3_new-item <?if($count<=2 || $no_count==1):?>margin<?endif?>">
												<a href="<?=$arItem_2['LINK']?>" class="catalog-nav__lvl3_new-link"><?=$arItem_2["TEXT"]?></a>
											</div>						
										<?else:?>
											<div class="catalog-nav__lvl2_new-item" >
												<span class="catalog-nav__lvl2_new-item catalog-nav__lvl2_new-item-title" >
													<a href="<?=$arItem_2['LINK']?>" class="catalog-nav__lvl2_new-toggle"><span><?=$arItem_2["TEXT"]?></span></a>
												</span>						

												<!--lvl3-->
												<div class="catalog-nav__lvl3_new">
													<div class="catalog-nav__lvl3_new-list">				
													<?foreach ($arItem_2["ITEMS"] AS $arItem_3):?>
														<?$cnt_item++;?>
														<?if ($cnt_item <= $limit) $count++?>
														
														<div class="catalog-nav__lvl3_new-item <?if($cnt_item > $limit) echo "hide";?>">
															<a href="<?=$arItem_3['LINK']?>" class="catalog-nav__lvl3_new-link"><?=$arItem_3["TEXT"]?></a>
														</div>						
													<?endforeach?>	
													
													<?if($cnt_item > $limit):?>
														<div class="catalog-nav__lvl3_new-item more">
															<a href="<?=$arItem_2['LINK']?>">Все категории</a>
														</div>
													<?endif?>						
													</div>
												</div>		

											</div>	
										<?endif?>				
									<?endforeach?>		
									</div>
								</div>						
							</div>
						<?endif?>	
					</div>	
				<?endforeach?>


				</div>
			</div>
		</div>
	</nav>

</div>	

<?endif?>

