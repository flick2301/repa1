<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

if(!empty($arResult["CATEGORIES"])):?>
        
        <div class="result__title result__title--first"></div>  
	<ul class="result__price-list">
            
		<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
			
			<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
			<li class="result__item">
				

				<?if($category_id === "all"):?>
					<td class="title-search-all"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>
				<?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
					$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];
				?>
                                        
					<a class="result__link" href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
						<?$price = array();?>
						<?foreach($arElement["PRICES"] as $arPrice):?>
							<?$price[] = $arPrice['VALUE'];?>
						<?endforeach;?>
                                        
                                                <span class="result__price"><? echo number_format(min($price), 2, '.', ' ');?> ₽</span>
					
				<?elseif(isset($arItem["ICON"])):?>
					<a href="<?echo $arItem["URL"]?>" class="result__link"><?echo $arItem["NAME"]?></a>
				<?else:?>
					<td class="title-search-more"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>
				<?endif;?>
			</li>
			<?endforeach;?>
		<?endforeach;?>
		<tr>
			<th class="title-search-separator">&nbsp;</th>
			<td class="title-search-separator">&nbsp;</td>
		</tr>
        </ul>
           <div class="title-search-fader"></div>
<?endif;
?>