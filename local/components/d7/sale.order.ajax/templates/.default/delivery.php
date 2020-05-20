<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<script type="text/javascript">
	function fShowStore(id, showImages, formWidth, siteId)
	{
		var strUrl = '<?=$templateFolder?>' + '/map.php';
		var strUrlPost = 'delivery=' + id + '&showImages=' + showImages + '&siteId=' + siteId;

		var storeForm = new BX.CDialog({
					'title': '<?=GetMessage('SOA_ORDER_GIVE')?>',
					head: '',
					'content_url': strUrl,
					'content_post': strUrlPost,
					'width': formWidth,
					'height':450,
					'resizable':false,
					'draggable':false
				});

		var button = [
				{
					title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
					id: 'crmOk',
					'action': function ()
					{
						GetBuyerStore();
						BX.WindowManager.Get().Close();
					}
				},
				BX.CDialog.btnCancel
			];
		storeForm.ClearButtons();
		storeForm.SetButtons(button);
		storeForm.Show();
	}

	function GetBuyerStore()
	{
		BX('BUYER_STORE').value = BX('POPUP_STORE_ID').value;
		//BX('ORDER_DESCRIPTION').value = '<?=GetMessage("SOA_ORDER_GIVE_TITLE")?>: '+BX('POPUP_STORE_NAME').value;
		BX('store_desc').innerHTML = BX('POPUP_STORE_NAME').value;
		BX.show(BX('select_store'));
	}

	function showExtraParamsDialog(deliveryId)
	{
		var strUrl = '<?=$templateFolder?>' + '/delivery_extra_params.php';
		var formName = 'extra_params_form';
		var strUrlPost = 'deliveryId=' + deliveryId + '&formName=' + formName;

		if(window.BX.SaleDeliveryExtraParams)
		{
			for(var i in window.BX.SaleDeliveryExtraParams)
			{
				strUrlPost += '&'+encodeURI(i)+'='+encodeURI(window.BX.SaleDeliveryExtraParams[i]);
			}
		}

		var paramsDialog = new BX.CDialog({
			'title': '<?=GetMessage('SOA_ORDER_DELIVERY_EXTRA_PARAMS')?>',
			head: '',
			'content_url': strUrl,
			'content_post': strUrlPost,
			'width': 500,
			'height':200,
			'resizable':true,
			'draggable':false
		});

		var button = [
			{
				title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
				id: 'saleDeliveryExtraParamsOk',
				'action': function ()
				{
					insertParamsToForm(deliveryId, formName);
					BX.WindowManager.Get().Close();
				}
			},
			BX.CDialog.btnCancel
		];

		paramsDialog.ClearButtons();
		paramsDialog.SetButtons(button);
		//paramsDialog.adjustSizeEx();
		paramsDialog.Show();
	}

	function insertParamsToForm(deliveryId, paramsFormName)
	{
		var orderForm = BX("ORDER_FORM"),
			paramsForm = BX(paramsFormName);
			wrapDivId = deliveryId + "_extra_params";

		var wrapDiv = BX(wrapDivId);
		window.BX.SaleDeliveryExtraParams = {};

		if(wrapDiv)
			wrapDiv.parentNode.removeChild(wrapDiv);

		wrapDiv = BX.create('div', {props: { id: wrapDivId}});

		for(var i = paramsForm.elements.length-1; i >= 0; i--)
		{
			var input = BX.create('input', {
				props: {
					type: 'hidden',
					name: 'DELIVERY_EXTRA['+deliveryId+']['+paramsForm.elements[i].name+']',
					value: paramsForm.elements[i].value
					}
				}
			);

			window.BX.SaleDeliveryExtraParams[paramsForm.elements[i].name] = paramsForm.elements[i].value;

			wrapDiv.appendChild(input);
		}

		orderForm.appendChild(wrapDiv);

		BX.onCustomEvent('onSaleDeliveryGetExtraParams',[window.BX.SaleDeliveryExtraParams]);
	}
</script>

<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>" />

<div class="content-feedback basket" id='delivery_form'>
    
	<?
        
	if(!empty($arResult["DELIVERY"]) || true)
	{
		
		$width = ($arParams["SHOW_STORES_IMAGES"] == "Y") ? 850 : 700;
		?>
		<h2 class='s28-title'><?=GetMessage("SOA_TEMPL_DELIVERY")?></h2>
                 <?
                  PrintPropsForm_field(array($arResult["ORDER_PROP"]["USER_PROPS_Y"][6]), $arParams["TEMPLATE_LOCATION"]);
                  PrintPropsForm_field(array($arResult["ORDER_PROP"]["USER_PROPS_Y"][18]), $arParams["TEMPLATE_LOCATION"]);
                  ?>
                <div class='feedback-form'>
                   
                    <div class='feedback-form__left'>
					
		<?

		foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery)
		{
			
			if ($delivery_id !== 0 && intval($delivery_id) <= 0)
			{
				
				foreach ($arDelivery["PROFILES"] as $profile_id => $arProfile)
				{
					?>
					<label class="form__label<?=$arProfile["CHECKED"] == "Y" ? " active" : "";?>">
                                          
                                            <div class="radio__wrap">
                                                            <input type="radio" id="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>"
								name="<?=htmlspecialcharsbx($arProfile["FIELD_NAME"])?>"
								value="<?=$delivery_id.":".$profile_id;?>"
								<?=$arProfile["CHECKED"] == "Y" ? "checked=\"checked\"" : "";?>
								onclick="<? echo ($profile_id=='pickup') ? "IPOLSDEK_pvz.selectPVZ('19','PVZ');" : "submitForm();";?>" class="form__radio">
                                            </div>
                                            <span class="radio__text" onclick="BX('ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>').checked=true;<?=$extraParams?>submitForm();">
										<?=htmlspecialcharsbx($arDelivery["TITLE"])." (".htmlspecialcharsbx($arProfile["TITLE"]).")";?></span>
                                                <?if($arProfile["CHECKED"] == "Y"){?>
                                                <?$this->SetViewTarget('delivery_info');?>
						<div class="export-info">
                                                    
                                                    <?if (count($arDelivery["LOGOTIP"]) > 0):

									$arFileTmp = CFile::ResizeImageGet(
										$arDelivery["LOGOTIP"]["ID"],
										array("width" => "95", "height" =>"55"),
										BX_RESIZE_IMAGE_PROPORTIONAL,
										true
									);

									$deliveryImgURL = $arFileTmp["src"];
								else:
									$deliveryImgURL = $templateFolder."/images/logo-default-d.gif";
								endif;?>
                                                    <div class="export-info__img"><img src="<?=$deliveryImgURL?>" alt=""></div>
                                                    <span class="export-info__title"><?=htmlspecialcharsbx($arDelivery["TITLE"])." (".htmlspecialcharsbx($arProfile["TITLE"]).")";?></span>
                                                    <span class="export-info__info">
                                                                                <?if (strlen($arProfile["DESCRIPTION"]) > 0):?>
											<?=nl2br($arProfile["DESCRIPTION"])?>
										<?else:?>
											<?=nl2br($arDelivery["DESCRIPTION"])?>
										<?endif;?>
                                                    </span>
                                                    <?if($profile_id=='pickup'):?>
                                                    <a href="javascript:void(0);" onclick="IPOLSDEK_pvz.selectPVZ('19','PVZ');" class="blue-btn export-info__btn">Выбрать пункт самовывоза</a>
                                                    
                                                    <p><?echo (strlen($arResult["ORDER_PROP"]["USER_PROPS_Y"][7]["VALUE_FORMATED"]) > 0) ? strstr($arResult["ORDER_PROP"]["USER_PROPS_Y"][7]["VALUE_FORMATED"], '#', true) : "";?></p>
                                                    <?endif;?>
                                                    <ul class="basket-info__items">
                                                        <?if(doubleval($arResult["DELIVERY_PRICE"]) > 0){?>
                                                        <li class="basket-info__item"><span>Стоимость:</span><i></i><strong><?=$arResult["DELIVERY_PRICE_FORMATED"]?></strong></li>
                                                        <li class="basket-info__item"><span>Срок доставки:</span><i></i><strong>1-2 дня</strong></li>
                                                        <?}else{
                                                          $APPLICATION->IncludeComponent('bitrix:sale.ajax.delivery.calculator', '', array(
												"NO_AJAX" => $arParams["DELIVERY_NO_AJAX"],
												"DELIVERY" => $delivery_id,
												"PROFILE" => $profile_id,
												"ORDER_WEIGHT" => $arResult["ORDER_WEIGHT"],
												"ORDER_PRICE" => $arResult["ORDER_PRICE"],
												"LOCATION_TO" => $arResult["USER_VALS"]["DELIVERY_LOCATION"],
												"LOCATION_ZIP" => $arResult["USER_VALS"]["DELIVERY_LOCATION_ZIP"],
												"CURRENCY" => $arResult["BASE_LANG_CURRENCY"],
												"ITEMS" => $arResult["BASKET_ITEMS"],
												"EXTRA_PARAMS_CALLBACK" => $extraParams
											), null, array('HIDE_ICONS' => 'Y'));  
                                                        }?>
                                                    </ul>
								
								

								

							

						</div>
                                            <?$this->EndViewTarget();?>
                                                <?}?>
					</label>
					<?
				} // endforeach
			}
			else // stores and courier
			{
				if (count($arDelivery["STORE"]) > 0)
					$clickHandler = "onClick = \"fShowStore('".$arDelivery["ID"]."','".$arParams["SHOW_STORES_IMAGES"]."','".$width."','".SITE_ID."')\";";
				else
					$clickHandler = "onClick = \"BX('ID_DELIVERY_ID_".$arDelivery["ID"]."').checked=true;submitForm();\"";
				?>
					<label class="form__label<?if ($arDelivery["CHECKED"]=="Y") echo " active";?>">
                                            <div class="radio__wrap">
                                                            <input type="radio" id="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>"
								id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"
								name="<?=htmlspecialcharsbx($arDelivery["FIELD_NAME"])?>"
								value="<?= $arDelivery["ID"] ?>"<?if ($arDelivery["CHECKED"]=="Y") echo " checked";?>
								onclick="submitForm();" class="form__radio">
                                            </div>
                                            <span class="radio__text" ><?= htmlspecialcharsbx($arDelivery["NAME"])?></span>
                                            <?if ($arDelivery["CHECKED"]=="Y"){?>
                                                <?$this->SetViewTarget('delivery_info');?>

						<div class="export-info">

											

								<?
								if (count($arDelivery["LOGOTIP"]) > 0):

									$arFileTmp = CFile::ResizeImageGet(
										$arDelivery["LOGOTIP"]["ID"],
										array("width" => "95", "height" =>"55"),
										BX_RESIZE_IMAGE_PROPORTIONAL,
										true
									);

									$deliveryImgURL = $arFileTmp["src"];
								else:
									$deliveryImgURL = $templateFolder."/images/logo-default-d.gif";
								endif;
								?>

								<div class="export-info__img"><img src="<?=$deliveryImgURL?>" alt=""></div>
								<?=$arDelivery["ID"]==3 || $arDelivery["ID"]==23 || $arDelivery["ID"]==25 || $arDelivery["ID"]==29 || $arDelivery["ID"]==30 ? " <b style='color: red; font-size: 14px;'>Вход в ПВЗ только в масках и перчатках</b>" : ""?>
                                                                <span class="export-info__title"><?= htmlspecialcharsbx($arDelivery["NAME"])?></span>
                                                                <span class="export-info__info" data='1'><?=htmlspecialchars_decode($arDelivery["DESCRIPTION"])?></span>
                                                                
                                                               
                                                                <ul class="basket-info__items">
                                                                    <li class="basket-info__item"><span>Стоимость:</span><i></i><strong><?echo ($arDelivery["ID"]=='2' || $arDelivery["ID"]=='24') ? "Уточняйте у менеджера" : $arDelivery["PRICE_FORMATED"];?></strong></li>
                                                                    <li class="basket-info__item"><span>Срок доставки:</span><i></i><strong><?=$arDelivery["PERIOD_TEXT"]?></strong></li>
                                                                </ul>
								

							
					</div>
				<?$this->EndViewTarget();?>
                                            <?}?>
					</label>
				<?
			}
		}
                ?></div>
                    <div class="feedback-form__right">
                        <?$APPLICATION->ShowViewContent('delivery_info');?>
			
                    </div>
                </div><?
	}
?>
<div class="clear"></div>
</div>