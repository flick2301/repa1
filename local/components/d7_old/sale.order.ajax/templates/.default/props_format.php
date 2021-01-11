<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!function_exists("showFilePropertyField"))
{
	function showFilePropertyField($name, $property_fields, $values, $max_file_size_show=50000)
	{
		$res = "";

		if (!is_array($values) || empty($values))
			$values = array(
				"n0" => 0,
			);

		if ($property_fields["MULTIPLE"] == "N")
		{
			
			$res .= "<label for=\"\"><input class='dddd' type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[0]\" id=\"".$name."[0]\" onchange='$(\".f_name\").val(this.files[0].name)'></label>";
		
		}
		else
		{
			$res = '
			<script type="text/javascript">
				function addControl(item)
				{
					var current_name = item.id.split("[")[0],
						current_id = item.id.split("[")[1].replace("[", "").replace("]", ""),
						next_id = parseInt(current_id) + 1;

					var newInput = document.createElement("input");
					newInput.type = "file";
					newInput.name = current_name + "[" + next_id + "]";
					newInput.id = current_name + "[" + next_id + "]";
					newInput.onchange = function() { addControl(this); };

					var br = document.createElement("br");
					var br2 = document.createElement("br");

					BX(item.id).parentNode.appendChild(br);
					BX(item.id).parentNode.appendChild(br2);
					BX(item.id).parentNode.appendChild(newInput);
				}
			</script>
			';

			$res .= "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[0]\" id=\"".$name."[0]\"></label>";
			$res .= "<br/><br/>";
			$res .= "<label for=\"\"><input type=\"file\" size=\"".$max_file_size_show."\" value=\"".$property_fields["VALUE"]."\" name=\"".$name."[1]\" id=\"".$name."[1]\" onChange=\"javascript:addControl(this);\"></label>";
		}

		return $res;
	}
}

if (!function_exists("PrintPropsForm"))
{
	function PrintPropsForm($arSource = array(), $locationTemplate = ".default")
	{
		if (!empty($arSource))
		{
			?>
			
				<div class='feedback-form__<?=(count($arSource)>3) ? 'left' : 'right';?>'>
			
					<?
					foreach ($arSource as $arProperties)
					{
                                            if($arProperties["ID"] != '6'):
						?>
						<label class='feedback-form__label' data-property-id-row="<?=intval(intval($arProperties["ID"]))?>">

						<?
						if ($arProperties["TYPE"] == "CHECKBOX")
						{
							?>
							<input type="hidden" name="<?=$arProperties["FIELD_NAME"]?>" value="">

							<div class="bx_block r1x3 pt8" style='display:block;'>
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r1x3 pt8" style='display:block;'>
								<input type="checkbox" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"]=="Y") echo " checked";?>>

								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>
							</div>

							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "TEXT")
						{
							
							if($arProperties["NAME"]=='roistat'){
                                                       
                                                        ?>
                                                       <input type="hidden" value="<?=$_COOKIE["roistat_visit"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" class="form__input"> 
                                                        <?
                                                               
                                                    
													}elseif($arProperties["CODE"]=='FILE_ID'){
														
														$files = current($_FILES);
														$arr_file=Array(
														"name" => $files['name'][0],
														"size" => $files['size'][0],
														"tmp_name" => $files['tmp_name'][0],
														"type" => "",
														"old_file" => "",
														"del" => "Y",
														"MODULE_ID" => "iblock");
														$fid = CFile::SaveFile($arr_file, "landings");
														
													 ?>
                                                       <input type="hidden" value="<?=$fid>0 ? $fid : ($_REQUEST["hidden_id_file"] ? $_REQUEST["hidden_id_file"] : '');?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" class="form__input"> 
                                                        <?	
													}else{
							?>							<?if($arProperties["NAME"]=='ИНН' || $arProperties["NAME"]=='Наименование компании'){
								$arRegProp[] = $arProperties;
								
														
							}?>
                                                        <span class="feedback-form__title">
                                                            <?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
                                                        <?=$arProperties["NAME"]?>:</span>
                                                        <input type="text" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" class="form__input">
							
							<?
                                                        }
						}
						elseif ($arProperties["TYPE"] == "SELECT")
						{
							?>
							<br/>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r3x1">
								<select name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
									<?
									foreach($arProperties["VARIANTS"] as $arVariants):
									?>
										<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
									<?
									endforeach;
									?>
								</select>

								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>
							</div>
							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "MULTISELECT")
						{
							?>
							<br/>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r3x1">
								<select multiple name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
									<?
									foreach($arProperties["VARIANTS"] as $arVariants):
									?>
										<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
									<?
									endforeach;
									?>
								</select>

								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>
							</div>
							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "TEXTAREA")
						{
							$rows = ($arProperties["SIZE2"] > 10) ? 4 : $arProperties["SIZE2"];
                                                      
							?>
							<br/>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>
                                                        
							<div class="bx_block r3x1">
								<textarea rows="<?=$rows?>" cols="<?=$arProperties["SIZE1"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>"><?=$arProperties["VALUE"]?></textarea>

								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>
							</div>
							<div style="clear: both;"></div>
							<?
                                                        
						}
						elseif ($arProperties["TYPE"] == "LOCATION")
						{/* НЕ ИСПОЛЬЗУЕМ СВОЙСТВО МЕСТОПОЛОЖЕНИЕ В ПАРАМЕТРАХ ПОЛЬЗОВАТЕЛЯ
							?>
							<span class="feedback-form__title">
						            <?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
                                                            <?endif;?>		
                                                          <?=$arProperties["NAME"]?>
								
							</span>

							<div class="r3x1" data="<?=$value?>">

								<?
								$value = 0;
								if (is_array($arProperties["VARIANTS"]) && count($arProperties["VARIANTS"]) > 0)
								{
									foreach ($arProperties["VARIANTS"] as $arVariant)
									{
										if ($arVariant["SELECTED"] == "Y")
										{
											$value = $arVariant["ID"];
											break;
										}
									}
								}

								// here we can get '' or 'popup'
								// map them, if needed
								if(CSaleLocation::isLocationProMigrated())
								{
									$locationTemplateP = $locationTemplate == 'popup' ? 'search' : 'steps';
									$locationTemplateP = $_REQUEST['PERMANENT_MODE_STEPS'] == 1 ? 'steps' : $locationTemplateP; // force to "steps"
								}
								?>

								<?if($locationTemplateP == 'steps'):?>
									<input type="hidden" id="LOCATION_ALT_PROP_DISPLAY_MANUAL[<?=intval($arProperties["ID"])?>]" name="LOCATION_ALT_PROP_DISPLAY_MANUAL[<?=intval($arProperties["ID"])?>]" value="<?=($_REQUEST['LOCATION_ALT_PROP_DISPLAY_MANUAL'][intval($arProperties["ID"])] ? '1' : '0')?>" />
								<?endif?>
                                                               
								<?CSaleLocation::proxySaleAjaxLocationsComponent(array(
									"AJAX_CALL" => "N",
									"COUNTRY_INPUT_NAME" => "COUNTRY",
									"REGION_INPUT_NAME" => "REGION",
									"CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
									"CITY_OUT_LOCATION" => "Y",
									"LOCATION_VALUE" => $value,
									"ORDER_PROPS_ID" => $arProperties["ID"],
									"ONCITYCHANGE" => ($arProperties["IS_LOCATION"] == "Y" || $arProperties["IS_LOCATION4TAX"] == "Y") ? "submitForm()" : "",
									"SIZE1" => $arProperties["SIZE1"],
								),
								array(
									"ID" => $value,
									"CODE" => "",
									"SHOW_DEFAULT_LOCATIONS" => "Y",

									// function called on each location change caused by user or by program
									// it may be replaced with global component dispatch mechanism coming soon
									"JS_CALLBACK" => "submitFormProxy",

									// function window.BX.locationsDeferred['X'] will be created and lately called on each form re-draw.
									// it may be removed when sale.order.ajax will use real ajax form posting with BX.ProcessHTML() and other stuff instead of just simple iframe transfer
									"JS_CONTROL_DEFERRED_INIT" => intval($arProperties["ID"]),

									// an instance of this control will be placed to window.BX.locationSelectors['X'] and lately will be available from everywhere
									// it may be replaced with global component dispatch mechanism coming soon
									"JS_CONTROL_GLOBAL_ID" => intval($arProperties["ID"]),

									"DISABLE_KEYBOARD_INPUT" => "Y",
									"PRECACHE_LAST_LEVEL" => "Y",
									"PRESELECT_TREE_TRUNK" => "Y",
									"SUPPRESS_ERRORS" => "Y"
								),
								$locationTemplateP,
								true,
								'location-block-wrapper'
								)?>
                                                               

								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>

							</div>
							<div style="clear: both;"></div>
							<?
						*/}
						elseif ($arProperties["TYPE"] == "RADIO")
						{
							?>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r3x1">
								<?
								if (is_array($arProperties["VARIANTS"]))
								{
									foreach($arProperties["VARIANTS"] as $arVariants):
									?>
										<input
											type="radio"
											name="<?=$arProperties["FIELD_NAME"]?>"
											id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"
											value="<?=$arVariants["VALUE"]?>" <?if($arVariants["CHECKED"] == "Y") echo " checked";?> />

										<label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"><?=$arVariants["NAME"]?></label></br>
									<?
									endforeach;
								}
								?>

								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>
							</div>
							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "FILE")
						{
							?>
							<?
							
								$files = current($_FILES);
								$arr_file=Array(
														"name" => $files['name'][0],
														"size" => $files['size'][0],
														"tmp_name" => $files['tmp_name'][0],
														"type" => "",
														"old_file" => "",
														"del" => "Y",
														"MODULE_ID" => "iblock");
														$fid = CFile::SaveFile($arr_file, "landings");
								if ($fid>0):
									
									$arProperties["VALUE"] = $fid;
									
								else:
									$arProperties["VALUE"] = $_REQUEST["hidden_id_file"];
									
									
								endif;
								
							?>
							<?if($_REQUEST["hidden_id_file"]) $hidden_file_id = CFile::GetByID($_REQUEST["hidden_id_file"])->Fetch();?>
							<input type="hidden" value="<?=$fid>0 ? $fid : $_REQUEST["hidden_id_file"];?>" name="hidden_id_file">
							<span class="feedback-form__title">
                                                            <?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
                                                        <?=$arProperties["NAME"]?>:</span>
							
							<div class="bx_block r3x1 example"  style='display:block;'>
								<?=showFilePropertyField("ORDER_PROP_".$arProperties["ID"], $arProperties, $arProperties["VALUE"], $arProperties["SIZE1"])?>
								<div>Обзор...</div>
								<input class="f_name" type="text" id="f_name" value="<?=($files['name'][0]) ? $files['name'][0] : ($hidden_file_id['ORIGINAL_NAME'] ? $hidden_file_id['ORIGINAL_NAME'] : 'Файл не выбран.')?>" disabled />
								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>
							</div>
							<script>
							$('input[type="file"]').on('change', function(element) {
		alert('sfd');
        
    });
							</script>
							<div style="clear: both;"></div><br/>
							<?
						}
						?>
						</label>

						<?if(CSaleLocation::isLocationProEnabled()):?>

							<?
							$propertyAttributes = array(
								'type' => $arProperties["TYPE"],
								'valueSource' => $arProperties['SOURCE'] == 'DEFAULT' ? 'default' : 'form' // value taken from property DEFAULT_VALUE or it`s a user-typed value?
							);

							if(intval($arProperties['IS_ALTERNATE_LOCATION_FOR']))
								$propertyAttributes['isAltLocationFor'] = intval($arProperties['IS_ALTERNATE_LOCATION_FOR']);

							if(intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']))
								$propertyAttributes['altLocationPropId'] = intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']);

							if($arProperties['IS_ZIP'] == 'Y')
								$propertyAttributes['isZip'] = true;
							?>

							<script>

								<?// add property info to have client-side control on it?>
								(window.top.BX || BX).saleOrderAjax.addPropertyDesc(<?=CUtil::PhpToJSObject(array(
									'id' => intval($arProperties["ID"]),
									'attributes' => $propertyAttributes
								))?>);

							</script>
						<?endif?>

						<?
                                                endif;
					}
					?>
					
				</div>
				<?if(count($arSource)>3){?>
                                <div class="feedback-form__right">
			
									<label class="feedback-form__label">
										<span class="feedback-form__title"><?=GetMessage("SOA_TEMPL_SUM_COMMENTS")?>:</span>
										<textarea name="ORDER_DESCRIPTION" id="ORDER_DESCRIPTION" class="form__textarea"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>
										<input type="hidden" name="" value="">
									</label>
								
								</div>
					<?}?>
					<?if(count($arRegProp)>0){?>
					<h2 class="s28-title" style='width:100%'>Реквизиты</h2><br>
					<p>Введите наименование и ИНН организации или приложите файл с карточкой компании</p><br>
					<div class='feedback-form__left'>
			
					<?
					;
					foreach ($arRegProp as $arProperties)
					{
						?>
						<label class='feedback-form__label' data-property-id-row="<?=intval(intval($arProperties["ID"]))?>">
						<?
						if ($arProperties["TYPE"] == "TEXT")
						{
							?>
                                                        <span class="feedback-form__title">
                                <?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
                                                        <?=$arProperties["NAME"]?>:</span>
                                                        <input type="text" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" class="form__input">
							
							<?
                                                        
						}else{}
						?></label><?
					}
					?>
					</div>
					<?}?>
			<?
		}
	}
        
        
        
        
        
        
        function PrintPropsForm_field($arSource = array(), $locationTemplate = ".default")
	{
		if (!empty($arSource))
		{
			?>
				
					<?
					foreach ($arSource as $arProperties)
					{
						?>
						<label class='feedback-form__label' data-property-id-row="<?=intval(intval($arProperties["ID"]))?>">

						<?
						if ($arProperties["TYPE"] == "CHECKBOX")
						{
							?>
							<input type="hidden" name="<?=$arProperties["FIELD_NAME"]?>" value="">

							<div class="bx_block r1x3 pt8" style='display:block;'>
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r1x3 pt8" style='display:block;'>
								<input type="checkbox" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" value="Y"<?if ($arProperties["CHECKED"]=="Y") echo " checked";?>>

								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>
							</div>

							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "TEXT")
						{
							
                                                        if($arProperties["NAME"]=='roistat'){
                                                       ?>
                                                       <input type="hidden" value="<?=$_COOKIE["roistat_visit"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" class="form__input"> 
                                                        <?
                                                                
                                                    }else{
							?>
							
                                                        <span class="feedback-form__title">
                                                            <?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
                                                        <?=$arProperties["NAME"]?>:</span>
                                                        <input type="text" value="<?=$arProperties["VALUE"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" class="form__input">
							
							<?
                                                        }
						}
						elseif ($arProperties["TYPE"] == "SELECT")
						{
							?>
							<br/>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r3x1">
								<select name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
									<?
									foreach($arProperties["VARIANTS"] as $arVariants):
									?>
										<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
									<?
									endforeach;
									?>
								</select>

								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>
							</div>
							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "MULTISELECT")
						{
							?>
							<br/>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r3x1">
								<select multiple name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>" size="<?=$arProperties["SIZE1"]?>">
									<?
									foreach($arProperties["VARIANTS"] as $arVariants):
									?>
										<option value="<?=$arVariants["VALUE"]?>"<?if ($arVariants["SELECTED"] == "Y") echo " selected";?>><?=$arVariants["NAME"]?></option>
									<?
									endforeach;
									?>
								</select>

								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>
							</div>
							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "TEXTAREA")
						{
							$rows = ($arProperties["SIZE2"] > 10) ? 4 : $arProperties["SIZE2"];
                                                      
							?>
							<br/>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>
                                                        
							<div class="bx_block r3x1">
								<textarea rows="<?=$rows?>" cols="<?=$arProperties["SIZE1"]?>" name="<?=$arProperties["FIELD_NAME"]?>" id="<?=$arProperties["FIELD_NAME"]?>"><?=$arProperties["VALUE"]?></textarea>

								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>
							</div>
							<div style="clear: both;"></div>
							<?
                                                        
						}
						elseif ($arProperties["TYPE"] == "LOCATION")
						{
							?>
							<span class="feedback-form__title">
						            <?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
                                                            <?endif;?>		
                                                          <?=$arProperties["NAME"]?>
								
							</span>

							<div class="r3x1">

								<?
								$value = 0;
								if (is_array($arProperties["VARIANTS"]) && count($arProperties["VARIANTS"]) > 0)
								{
									foreach ($arProperties["VARIANTS"] as $arVariant)
									{
										if ($arVariant["SELECTED"] == "Y")
										{
											$value = $arVariant["ID"];
											break;
										}
									}
								}
                                                               
                                                              
								// here we can get '' or 'popup'
								// map them, if needed
								if(CSaleLocation::isLocationProMigrated())
								{
									$locationTemplateP = $locationTemplate == 'popup' ? 'search' : 'steps';
									$locationTemplateP = $_REQUEST['PERMANENT_MODE_STEPS'] == 1 ? 'steps' : $locationTemplateP; // force to "steps"
								}
								?>

								<?if($locationTemplateP == 'steps'):?>
									<input type="hidden" id="LOCATION_ALT_PROP_DISPLAY_MANUAL[<?=intval($arProperties["ID"])?>]" name="LOCATION_ALT_PROP_DISPLAY_MANUAL[<?=intval($arProperties["ID"])?>]" value="<?=($_REQUEST['LOCATION_ALT_PROP_DISPLAY_MANUAL'][intval($arProperties["ID"])] ? '1' : '0')?>" />
								<?endif?>
                                                               
								<?CSaleLocation::proxySaleAjaxLocationsComponent(array(
									"AJAX_CALL" => "N",
									"COUNTRY_INPUT_NAME" => "COUNTRY",
									"REGION_INPUT_NAME" => "REGION",
									"CITY_INPUT_NAME" => $arProperties["FIELD_NAME"],
									"CITY_OUT_LOCATION" => "Y",
									"LOCATION_VALUE" => $value,
									"ORDER_PROPS_ID" => $arProperties["ID"],
									"ONCITYCHANGE" => ($arProperties["IS_LOCATION"] == "Y" || $arProperties["IS_LOCATION4TAX"] == "Y") ? "submitForm()" : "",
									"SIZE1" => $arProperties["SIZE1"],
								),
								array(
									"ID" => $value,
									"CODE" => "",
									"SHOW_DEFAULT_LOCATIONS" => "Y",

									// function called on each location change caused by user or by program
									// it may be replaced with global component dispatch mechanism coming soon
									"JS_CALLBACK" => "submitFormProxy",

									// function window.BX.locationsDeferred['X'] will be created and lately called on each form re-draw.
									// it may be removed when sale.order.ajax will use real ajax form posting with BX.ProcessHTML() and other stuff instead of just simple iframe transfer
									"JS_CONTROL_DEFERRED_INIT" => intval($arProperties["ID"]),

									// an instance of this control will be placed to window.BX.locationSelectors['X'] and lately will be available from everywhere
									// it may be replaced with global component dispatch mechanism coming soon
									"JS_CONTROL_GLOBAL_ID" => intval($arProperties["ID"]),

									"DISABLE_KEYBOARD_INPUT" => "Y",
									"PRECACHE_LAST_LEVEL" => "Y",
									"PRESELECT_TREE_TRUNK" => "Y",
									"SUPPRESS_ERRORS" => "Y"
								),
								$locationTemplateP,
								true,
								'location-block-wrapper'
								)?>
                                                               

								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>

							</div>
							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "RADIO")
						{
							?>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r3x1">
								<?
								if (is_array($arProperties["VARIANTS"]))
								{
									foreach($arProperties["VARIANTS"] as $arVariants):
									?>
										<input
											type="radio"
											name="<?=$arProperties["FIELD_NAME"]?>"
											id="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"
											value="<?=$arVariants["VALUE"]?>" <?if($arVariants["CHECKED"] == "Y") echo " checked";?> />

										<label for="<?=$arProperties["FIELD_NAME"]?>_<?=$arVariants["VALUE"]?>"><?=$arVariants["NAME"]?></label></br>
									<?
									endforeach;
								}
								?>

								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>
							</div>
							<div style="clear: both;"></div>
							<?
						}
						elseif ($arProperties["TYPE"] == "FILE")
						{
							?>
							<br/>
							<div class="bx_block r1x3 pt8">
								<?=$arProperties["NAME"]?>
								<?if ($arProperties["REQUIED_FORMATED"]=="Y"):?>
									<span class="bx_sof_req">*</span>
								<?endif;?>
							</div>

							<div class="bx_block r3x1">
								<?=showFilePropertyField("ORDER_PROP_".$arProperties["ID"], $arProperties, $arProperties["VALUE"], $arProperties["SIZE1"])?>

								<?
								if (strlen(trim($arProperties["DESCRIPTION"])) > 0):
								?>
								<div class="bx_description">
									<?=$arProperties["DESCRIPTION"]?>
								</div>
								<?
								endif;
								?>
							</div>

							<div style="clear: both;"></div><br/>
							<?
						}
						?>
						</label>

						<?if(CSaleLocation::isLocationProEnabled()):?>

							<?
							$propertyAttributes = array(
								'type' => $arProperties["TYPE"],
								'valueSource' => $arProperties['SOURCE'] == 'DEFAULT' ? 'default' : 'form' // value taken from property DEFAULT_VALUE or it`s a user-typed value?
							);

							if(intval($arProperties['IS_ALTERNATE_LOCATION_FOR']))
								$propertyAttributes['isAltLocationFor'] = intval($arProperties['IS_ALTERNATE_LOCATION_FOR']);

							if(intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']))
								$propertyAttributes['altLocationPropId'] = intval($arProperties['CAN_HAVE_ALTERNATE_LOCATION']);

							if($arProperties['IS_ZIP'] == 'Y')
								$propertyAttributes['isZip'] = true;
							?>

							<script>

								<?// add property info to have client-side control on it?>
								(window.top.BX || BX).saleOrderAjax.addPropertyDesc(<?=CUtil::PhpToJSObject(array(
									'id' => intval($arProperties["ID"]),
									'attributes' => $propertyAttributes
								))?>);

							</script>
						<?endif?>

						<?
					}
					?>
				
			<?
		}
	}
}
?>