<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->setFrameMode(true);

?>







<ul class="pay-choice">
<?foreach ($arResult['SECTIONS'] as &$arSection):
    $i++;
?>
    <li class="pay-choice__item pay-choice-<?=$i?>"><a href="<?=$arSection['SECTION_PAGE_URL']?>" target="_self" class="pay-choice__link"><?=$arSection['NAME']?></a></li>
<?endforeach;?>
</ul>



<style>
    <?
    $i=0;
    foreach ($arResult['SECTIONS'] as &$arSection)
			{
        $i++;
        ?>
    .pay-choice-<?=$i?> a:before { width: 64px; height: 64px;
    background: url(<?=$arSection['UF_PIC_SRC'][0]?>) no-repeat;
}

.pay-choice-<?=$i?> a:hover:before {
    background: url(<?=$arSection['UF_PIC_SRC'][1]?>) no-repeat;
}
                        <?}?>
    </style>
    
    