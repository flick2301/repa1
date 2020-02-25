<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];

require(realpath(dirname(__FILE__)) . '/top_template.php');


if ($arParams["SHOW_PRODUCTS"] == "Y" && ($arResult['NUM_PRODUCTS'] > 0 || !empty($arResult['CATEGORIES']['DELAY'])))
{
?>
	
    <div class="box-modal" id="added-basket">
        <div  class="box-modal__head">
	    <div class="box-modal__title">Товар добавлен в корзину</div>
            <?
            
            
           


            ?>
	    <div onclick="$('.popUp-container').popUp('close');" class="popUp-close"></div>
	</div>
	<table id="<?=$cartId?>" class="added-product">
	    <thead>
		<tr class="added-product__tr">
		    <th class="added-product__th">Наименование:</th>
		    <th class="added-product__th">Количество:</th>
		    <th class="added-product__th">Сумма:</th>
		    <th class="added-product__th">Удалить:</th>
		</tr>
	    </thead>
	    <tbody id="<?=$cartId?>products">	
            
            <?foreach ($arResult["CATEGORIES"] as $category => $items):
		if (empty($items))
		    continue;
                    
                    //Выбираем последний элемент добавленный в корзину( чтобы отобразить все нужно оставить $items
                    $item_last=array($items[$arResult['NUM_PRODUCTS']-1]);
                    
	    ?>
	        <?foreach ($item_last as $v):?>
                
                <tr class="added-product__tr">
		    <td class="added-product__td">
			<div class="basket-infomedia">
			    <div class="infomedia__img"><a href="<?=$v["DETAIL_PAGE_URL"]?>"><img src="<?echo ($v["PICTURE_SRC"]) ? $v["PICTURE_SRC"] : "/images/no_image.jpg";?>" alt=""></a></div>
			    <div class="infomedia__text">
				<a href="<?=$v["DETAIL_PAGE_URL"]?>" class="infomedia__link"><?=$v["NAME"]?></a>
				<span class="infomedia__price"><?=number_format($v["PRICE"], 2, '.', ' ');?> ₽</span>
			    </div>
			</div>
		    </td>
		    <td class="added-product__td">
			<div class="value added-product__value">
			    <a href="javascript:void(0)" onclick="<?=$cartId?>.changeItemToCart(<?=$v['ID']?>, <?=$v['QUANTITY']-1?>)" rel="nofollow" class="value__minus">—</a>
			    <input type="text" name="value__input" onchange='<?=$cartId?>.changeItemToCart(<?=$v['ID']?>, $(this).val())' value="<?=$v["QUANTITY"]?>" data-product='<?=$v['ID']?>' class="value__input">
			    <a href="javascript:void(0)" onclick="<?=$cartId?>.changeItemToCart(<?=$v['ID']?>, <?=$v['QUANTITY']+1?>)" rel="nofollow" class="value__plus">+</a>
			</div>
		    </td>
		    <td class="added-product__td"><div class="added-product__price"><?=number_format($v["SUM_VALUE"], 2, '.', ' ');?> ₽</div></td>
		    <td class="added-product__td" ><div class="added-product__close" onclick="<?=$cartId?>.removeItemFromCart(<?=$v['ID']?>)"></div></td>
		</tr>
		          
        <?$prod_id = $v['PRODUCT_ID'];?>
		<?$isec_id = $v;?>
              
                
				<?endforeach?>
			<?endforeach?>
            </tbody>
        </table>
        <div class="line-btn">
	    <a href="#" onclick="$('.popUp-container').popUp('close');" class="white-btn">Продолжить покупки</a>
	    <a href="<?=$arParams['PATH_TO_BASKET']?>" class="blue-btn">Перейти в корзину</a>
	</div>
	
	
	<div class="box-modal__separator"></div>
		<?if($USER->IsAdmin()){
				
				
				\Bitrix\Main\Loader::includeModule('iblock');	

				$res = CIBlockElement::GetByID( $prod_id );
				if($ar_res = $res->GetNext()) $isec_id = $ar_res['IBLOCK_SECTION_ID'];
				
				$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, 'ID'=>$isec_id);
				$res = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, false, array('*', 'UF_*'));
				if($ob = $res->GetNext())
				{
					
					
					foreach($ob['UF_SOPUTKA'] as $val):
						$arVal = explode(';', trim($val,';'));
						$arArt[$arVal[0]]=$arVal;
						$db_props = CIBlockElement::GetProperty(CATALOG_IBLOCK_ID, $prod_id, array("sort" => "asc"), Array("CODE"=>$arVal[1]));
						if($ar_props = $db_props->Fetch()){
							
							$arPROPVAL[$arVal[0]] = $ar_props["VALUE"];
						}
						$arSec[]=$arVal[0];
						
					endforeach;
					
					 if($ob['UF_SOPUTKA']){
                                              ?><div class="box-modal__title">Сопутствующие товары:</div><?
                                       }

				}
				
				if($arSec){
					$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, 'CODE'=>$arSec);
					$res = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, false, array('*', 'UF_*'));
					while($ob = $res->GetNext())
					{
					
						?>
						<div class="sorting_item">
						<a href="javascript:void(0);" data-secid="<?=$ob['ID']?>" onclick="GetListItems(<?=$ob['ID']?>, '<?=($arArt[$ob['CODE']][1]) ? $arArt[$ob['CODE']][1] : '0';?>', '<?=($arPROPVAL[$ob['CODE']]) ? $arPROPVAL[$ob['CODE']] : '0';?>');" data-param="<?=$arArt[$ob['CODE']][1]?>" data-param2="<?=$arArt[$ob['CODE']][2]?>" class="sorting_link">
                    
							<span class="sorting_title"><?=$ob['NAME']?></span>
						</a>
					</div>
						<?
					}
					?>
					<br><br>
				<div id='soput_carts'>
				</div><?
				}
				
				/*
				$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, 'PROPERTY_CML2_ARTICLE'=>$arSec);
				$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), array('*'));
				while($ob = $res->GetNextElement())
				{
					$Fielsd = $ob->GetFields();
					$arProperties = $ob->GetProperties();
					?>
                                      <div class="basket-infomedia">
                                              <div class="infomedia__img"><a href="<?=$Fielsd["DETAIL_PAGE_URL"]?>"><img style='width:65px;' src="<?echo ($Fielsd["PREVIEW_PICTURE"]) ? CFile::GetPath($Fielsd["PREVIEW_PICTURE"]) : "/images/no_image.jpg";?>" alt=""></a></div>
                                              <div class="infomedia__text">
                                                      <a href="<?=$Fielsd["DETAIL_PAGE_URL"]?>" class="infomedia__link"><?=$Fielsd["NAME"]?></a>
                                              </div>
                                      </div>
                                      <?

					
				}
					*/
			  }
				?>
				
    </div>

	<script>
		BX.ready(function(){
			<?=$cartId?>.fixCart();

		});
		function GetListItems (id, param1, param2)
		{
			
			$.ajax({
				type: "POST",
				url: '/local/templates/moskrep/components/bitrix/sale.basket.basket.line/.default/ajax_soput.php',
				data: {'ID':id, 'param1':param1, 'param2':param2},
			
				success: function(msg){
					$('#soput_carts').html(msg);
				}
          }); 
		  
		}
	</script>
<?
}