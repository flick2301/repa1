<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array());
global $APPLICATION;

?>



<h1 class="s38-title"><?=$APPLICATION->ShowTitle();?></h1>

<nav class="nav-sale">
    <ul class="nav-sale__items">
    <?foreach($arResult['SECTIONS'] as $section){
		//print_r(CFile::GetPath($section['PICTURE']));
        $file = CFile::ResizeImageGet($section['PICTURE'], array('width'=>$arParams['LIST_PREV_PIC_W_L2'], 'height'=>$arParams['ITEMS_PREV_PIC_H']), BX_RESIZE_IMAGE_PROPORTIONAL, true);    
    ?>			
        <li class="nav-sale__item">
            
	    <a href="<?=$section['SECTION_PAGE_URL']?>" class="nav-sale__link">
	        <div class="nav-sale__img"><img src="<?=$file['src']?>" alt="<?=$section['NAME']?>"></div>
	        <span class="nav-sale__title"><span><?=$section['NAME']?></span></span>
	    </a>
	</li>
    <?}?>
    </ul>
</nav>
			


