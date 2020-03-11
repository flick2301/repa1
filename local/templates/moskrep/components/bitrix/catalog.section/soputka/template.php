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
            
		    <td class="blue-table__td_soput"><div class='infomedia__img'><a  href="<?=$item['DETAIL_PAGE_URL']?>" title='<?=($item['PROPERTIES']['ROOT_NAME']['VALUE']) ? $item['PROPERTIES']['ROOT_NAME']['VALUE'] : $item['NAME'];?>' target="_self"><img  src="<?=$item['PREVIEW_PICTURE']['src']?>" alt='<?=$item['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?>' /></a></div></td>
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
	    <td class="blue-table__td_soput" style='padding-right:10px;'>
		<div class="value">
		    <a href="javascript:void(0)" rel="nofollow" class="value__minus">—</a>
			<input type="text" name="" data-quantity="<?=($item['CATALOG_QUANTITY'])?>" onchange='ChangeInputCart("<?=$item['NAME']?>", $(this))' id="QUANTITY_<?=$item['ID']?>" value="1" class="value__input">
		    <a href="javascript:void(0)" rel="nofollow" class="value__plus">+</a>
		</div>
		<a href="javascript:void(0)" data-product="<?=$item['ID']?>" data-name="<?=$item['NAME']?>" data-price="<?=$price?>" rel="nofollow" class="blue-btn basket-btn-soputka">В корзину</a>
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
	
	
	var buyBtnDetail = document.body.querySelectorAll('.basket-btn-soputka');
	var IDs=[];
    for (var i = 0; i < buyBtnDetail.length; i++) {
        BX.bind(buyBtnDetail[i], 'click', BX.delegate(function (e) {
            add2basketDetailSoputka(e)
        }, this));
		
		
	IDs.push({'id': buyBtnDetail[i].dataset.product, 'google_business_vertical': 'retail'});
		
    
    }
	
	gtag('event','view_item_list', {
		'send_to': 'AW-958495754',
				'items': IDs
					});
    
    function add2basketDetailSoputka(e) {
        var id = e.target.dataset.product,
                quantity = 1;
				
        if (!!BX('QUANTITY_' + id)) {
            quantity = BX('QUANTITY_' + id).value;
        }
       
        BX.ajax({
            url: window.location.href,
            data: {
                action: 'ADD2BASKET',
                ajax_basket: 'Y',
                quantity: quantity,
                id: e.target.dataset.product
            },
            method: 'POST',
            dataType: 'json',
            onsuccess: function (data) {
                if (data.STATUS == 'OK') {
                    //BX.addClass(e.target, 'active2');
					BX.removeClass(e.target, 'basket-btn-soputka');
					BX.addClass(e.target, 'basket-add');
					e.target = 'Добавлен';
                   
                    BX.onCustomEvent('OnBasketAdd');
					ga ('send', 'event', 'Корзина', 'Добавить в корзину');
					gtag('event','add_to_cart', {
						'send_to': 'AW-958495754',
						'value': e.target.dataset.price,
						'items': [
						{
							'id':  e.target.dataset.product, 
							'google_business_vertical': 'retail'
						}]
					});
					$('.header-basket-none').text(data.MESSAGE);
                    //$('.header-basket').popUp();
                } else {
                   console.log(data);
				   $('.header-basket-none').text(data.MESSAGE);
                   $('.header-basket-none').popUp();
                }
            }
        }); 
    }
	
	
});
</script>
<style>
#soput_carts{
	margin-top:10px;
}
.basket-btn-soputka {
    border-radius: 0 0 3px 3px;
    
    height: 27px;
    padding: 0;
    font-size: 0.8125rem;
    -webkit-box-shadow: none;
    box-shadow: none;
}
.basket-add {
    border-radius: 0 0 3px 3px;
    background: #21cf0c;
    height: 27px;
    padding: 0;
    font-size: 0.8125rem;
    -webkit-box-shadow: none;
    box-shadow: none;
}
.basket-add:hover {
   
    background: #21cf0c !important;
   
}
</style>

		