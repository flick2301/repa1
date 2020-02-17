<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


global $APPLICATION;
include($_SERVER["DOCUMENT_ROOT"]."/include/array_rals.php");
$ral_in_ar = $arResult['ITEMS'][0]['PROPERTIES']["TSVET"]["VALUE"];





?>
<div class="sale-category sale-category--new">
    <table class="blue-table price-category <?=($ral_in_ar) ? 'blue-table__8-rows' : 'blue-table__7-rows';?>">
		<tbody class="blue-table__tbody_soput">
						
			
				
<?php
    foreach($arResult['SIZES'] as $key=>$size){
        
        $index=0;
        foreach ($size as $item)
        {
			
            
            $price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_SALE_PRICE]['VALUE'] : $item['MIN_PRICE']['VALUE'];
            $old_price = $item['PRICES'][ID_SALE_PRICE]['VALUE'] ? $item['PRICES'][ID_BASE_PRICE]['VALUE'] : 0;
        ?>
        
        
        <tr class="blue-table__tr_soput">
            <?if($index==0){?>
            
	    <?
            
            }
            $index++;
            ?>
           
		    <td class="blue-table__td_soput"><img  src="<?=$item['PREVIEW_PICTURE']['src']?>" alt='<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?>' /></td>
            <td class="blue-table__td_soput"><span class="articul-b"><a class="name_b" href="<?=$item['DETAIL_PAGE_URL']?>" title='<?=($item['PROPERTIES']['ROOT_NAME']['VALUE']) ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME'];?>' target="_self"><?=($item['PROPERTIES']['ROOT_NAME']['VALUE']) ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME'];?></a></span></td>
            
	        

            
	    <td class="blue-table__td_soput blue-table__price">
	        <span class="price-b"><?echo number_format($price, 2, '.', ' ');?> ₽</span>
                <?echo ($old_price) ? '<span class="carousel-product__price-old">'.number_format($old_price, 2, '.', ' ').' ₽</span>': '';?> 
				<?if($item['PRICE_FOR_ONE']){?>
					<br><span class="price-b" style="font-size: 0.8rem;line-height: 1.9;color: darkslategray;font-family: inherit;color: #6d6d6d;">
						<?=$item['PRICE_FOR_ONE']?> ₽ за <?=$item['UNIT']?>
					</span>
				<?}?>
		
            </td>
	    <td class="blue-table__td_soput">
		<div class="value">
		    <a href="javascript:void(0)" rel="nofollow" class="value__minus">—</a>
			<input type="text" name="" data-quantity="<?=($item['CATALOG_QUANTITY'])?>" onchange='ChangeInputCart("<?=$item['NAME']?>", $(this))' id="QUANTITY_<?=$item['ID']?>" value="1" class="value__input">
		    <a href="javascript:void(0)" rel="nofollow" class="value__plus">+</a>
		</div>
		<a href="javascript:void(0)" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" rel="nofollow" class="blue-btn basket-btn">В корзину</a>
	    </td>
	</tr>
                                                        
						
			
<?php
        }
    }
?>

					
    </tbody>
</table>
</div>


	

<script>
BX.ready(function () {
    var buyBtnDetail = document.body.querySelectorAll('.basket-btn');
	var IDs=[];
	var sum=0;
    for (var i = 0; i < buyBtnDetail.length; i++) {
     
		
	IDs.push(buyBtnDetail[i].dataset.product);
	sum =  sum+Number(buyBtnDetail[i].dataset.price);
		
    
    }
	
	
	
	console.log(IDs);
	console.log(sum);
	
	
});
</script>

		