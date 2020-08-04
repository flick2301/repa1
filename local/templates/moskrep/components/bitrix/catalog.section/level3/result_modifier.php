<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult['ITEMS'] as $key=>$arItem){
   
    if(stripos($arItem['NAME'], 'кг') !== false):
        $arResult['ITEMS'][$key]['UNIT']= ' кг';
    else:
        $arResult['ITEMS'][$key]['UNIT']= ' шт.';
    endif;
	
	$rsStore = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' => $arItem['ID']), false, false, array('STORE_ID', 'AMOUNT', 'STORE_NAME'));
    while($arStore = $rsStore->Fetch()){
        $arResult['ITEMS'][$key]['STORE'][$arStore['STORE_ID']] = $arStore;
    }
    
    foreach($arItem['PROPERTIES'] as $prop){
        if(!in_array($prop['CODE'], ['SOPUTSTVUYUSHCHIE_TOVARY', 'PO_PRIMENENIYU', 'DIAMETR', 'DLINA', 'VYSOTA', 'SHIRINA', 'RAZMER_POD_KLYUCH_MM', 'SHAG_REZBY_MM'])){
            if($arProp[$prop['NAME']]=='' || $arProp[$prop['NAME']]==$prop['VALUE'])
                $arProp[$prop['NAME']]=$prop['VALUE'];
            else
                $arProp[$prop['NAME']]='false';
        }
    }
	
	if($arItem['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"] > 1){
		$price = $arItem['PRICES'][ID_SALE_PRICE]['VALUE'] ? $arItem['PRICES'][ID_SALE_PRICE]['VALUE'] : $arItem['PRICES'][ID_BASE_PRICE]['VALUE'];
		$arResult['ITEMS'][$key]["PRICE_FOR_ONE"] = number_format($price/$arItem['PROPERTIES']["KOLICHESTVO_V_UPAKOVKE"]["VALUE"], 2, '.', ' ');
	}

    //Получаем массив из размеров
    $ar_size = array();
if(count($arSizes)>0 && (count($arSizes)!=1 || $arSizes[0]!='DIAMETR_VNUTRENNIY')){
        foreach($arSizes as $size){
            $ar_size[] = $arItem['PROPERTIES'][$size]["VALUE"];
        }
    }else{

        $ar_size = array(
            $arItem['PROPERTIES']["DIAMETR"]["VALUE"],
            $arItem['PROPERTIES']["VYSOTA"]["VALUE"],
            $arItem['PROPERTIES']["SHIRINA"]["VALUE"],
            $arItem['PROPERTIES']["DLINA"]["VALUE"],
			$arItem['PROPERTIES']['DIAMETR_VNUTRENNIY']["VALUE"]
        );
    }
	
	
    $sizes = array_diff($ar_size, ['']);
    if(count($arSizes) === 1 && $arSizes['0']=='DIAMETR') {

        $arResult['ITEMS'][$key]['SIZES'] = 'M ' . implode($sizes, 'x');
    }else{
        $arResult['ITEMS'][$key]['SIZES']=implode($sizes, 'x');
    }
        //Вводим массив c ключами из размеров с значениями в виде ITEMS id
	if($arItem['PROPERTIES']["DIAMETR_VNUTRENNIY"]["VALUE"]){
		$vnut_diametr = true;
		$ss = str_replace('м', '', $arResult['ITEMS'][$key]['SIZES']);
		$arResult['SIZES'][$ss][$key]=$arResult['ITEMS'][$key];
		
		
	}else{
		$vnut_diametr=false;
		$arResult['SIZES'][$arResult['ITEMS'][$key]['SIZES']][$key]=$arResult['ITEMS'][$key];
	}
    
}

