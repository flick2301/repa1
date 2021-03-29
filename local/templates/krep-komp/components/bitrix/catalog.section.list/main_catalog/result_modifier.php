<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

foreach ($arResult['SECTIONS'] as $key => $section) {
    if (!empty($section['UF_PIC'])) {
        foreach($section['UF_PIC'] as $pic_id){
        $section['UF_PIC_SRC'][] = CFile::GetPath($pic_id);
        }
    }
    

    $arResult['SECTIONS'][$key] = $section;
}
