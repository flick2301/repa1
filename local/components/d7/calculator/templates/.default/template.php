<div class="mass-widget">

	<div class="mass-widget__widget-header">
		<div id="mass-widget-cleaner" class="mass-widget-cleaner">x</div>	
		<img class="mass-widget__logo" src="<?=SITE_TEMPLATE_PATH?>/assets/design/website-logo/krep-komp.svg" alt="КРЕП-КОМП" />
	</div>
	
	
	
	<div class="mass-widget__widget-body">

<form id="mass-widget__form" method="POST">	

<?global $USER;
if($arResult["LOG"] && $USER->isAdmin()):?>
<?=$arResult["LOG"]?>
<?endif?>


<div class="mass-widget__form-block">	
		<select class="mass-widget__form-control input-lg mass-widget-loader-select mass-widget-loader-select-type" name="TYPE">
		<option value="" class="mass-option-disabled">- Выберите вид крепежа -</option>
<?foreach($arResult["SECTIONS"] AS $section):?>			
	<option value="<?=$section["ID"]?>" <?if($section["ID"]==$_POST["TYPE"]):?>selected="true"<?endif?>><?=$section["NAME"]?></option>			
<?endforeach?>		
		</select>	
</div>		


<?if(count($arResult["NAMES"])):?>
<div class="mass-widget__form-block">			
<select class="mass-widget__form-control input-lg mass-widget-loader-select" name="NAMES">
<option class="mass-option-disabled" value="">- Выберите стандарт -</option>
<?foreach($arResult["NAMES"] AS $name):?>			
	<option value="<?=$name["ID"]?>" <?if($name["ID"]==$_POST["NAMES"]):?>selected="true"<?endif?>><?=$name["NAME"]?></option>			
<?endforeach?>		
</select>		
</div>
<?endif?>

<?if(count($arResult["DIAMETR_VNUTRENNIY"])):?>
<div class="mass-widget__form-block">	
<select class="mass-widget__form-control input-lg mass-widget-loader-select" name="DIAMETR_VNUTRENNIY">
<option value="" class="mass-option-disabled">- Внутренний диаметр -</option>
<?foreach($arResult["DIAMETR_VNUTRENNIY"] AS $interior_diametr):?>			
	<option value="<?=$interior_diametr?>" <?if($interior_diametr==$_POST["DIAMETR_VNUTRENNIY"]):?>selected="true"<?endif?>><?=$interior_diametr?></option>			
<?endforeach?>	
</select>
</div>
<?endif?>


<?if(count($arResult["DIAMETR"])):?>
<div class="mass-widget__form-block">	
<select class="mass-widget__form-control input-lg mass-widget-loader-select" name="DIAMETR">
<option value="" class="mass-option-disabled">- Выберите диаметр -</option>
<?foreach($arResult["DIAMETR"] AS $diametr):?>			
	<option value="<?=$diametr?>" <?if($diametr==$_POST["DIAMETR"]):?>selected="true"<?endif?>><?=$diametr?></option>			
<?endforeach?>	
</select>
</div>
<?endif?>


<?if(count($arResult["LENGTH"])):?>
<div class="mass-widget__form-block">	
<select class="mass-widget__form-control input-lg mass-widget-loader-select" name="LENGTH">
<option class="mass-option-disabled" value="">- Выберите длину -</option>
<?foreach($arResult["LENGTH"] AS $length):?>			
	<option value="<?=$length?>" <?if($length==$_POST["LENGTH"] || count($arResult["LENGTH"])==1):?>selected="true"<?endif?>><?=$length?></option>			
<?endforeach?>	
</select>
</div>
<?endif?>



<?if($arResult["WEIGHT"]):?>
<div class="mass-widget__mass-one-unit">Масса 1 шт ≈ <?=round($arResult["WEIGHT"] * 1000, 3)?> гр</div>
<div class="mass-widget__form-block">
<label class="mass-count-label">Количество</label>
<input id="mass-widget__count" type="text" class="mass-widget__form-control mass-widget__input-lg mass-count" placeholder="0">
</div>
<div class="mass-widget__form-block">
<label class="mass-weight-label">Вес (кг)</label>
<input id="mass-widget__result" type="text" class="mass-widget__form-control mass-widget__input-lg mass-weight" placeholder="0">
</div>
<input id="mass-widget__weight" type="hidden" class="unit-weight-value" value="<?=$arResult["WEIGHT"]?>">

<?elseif ($_POST["LENGTH"]):?>
<div class="mass-widget__mass-one-unit">Масса изделия не известна</div>
<?endif?>

<?if(count($arResult["ITEMS"])):?>
<?foreach($arResult["ITEMS"] AS $item):?>
<?=$item["NAME"]?><br />
<?endforeach?>
<?endif?>
		

</form>
		
</div>
		
		
		
	<div class="mass-widget__widget-footer">
	</div>
</div>

		