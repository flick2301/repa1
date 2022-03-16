<?
/**
 * Created by Webcreature.
 * User: Denis Chuchumashev
 * www.webcreature.ru
 * Date: 13.04.2018
 * Time: 9:18
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;
?>

<script type="text/javascript">
BX.message({
   TEMPLATE_URL: '<?=$this->__component->__template->__folder?>',
   SIZE: '<?=$arParams["SIZE"]?>',
   ARTNO: '<?=$arParams["ARTNO"]?>',
   COMPONENT_TEMPLATE: '<?=$arParams["COMPONENT_TEMPLATE"]?>',
   DESCRIPTION_LEN: '<?=$arParams["DESCRIPTION_LEN"]?>',   
   SEARCH_VARIABLE: '<?=$arParams["SEARCH_VARIABLE"]?>',
   IN_CATEGORY: '<?=$arParams["IN_CATEGORY"]?>',
   IBLOCK_TYPE: '<?=$arParams["IBLOCK_TYPE"]?>',
   IBLOCK_ID: '<?=$arParams["IBLOCK_ID"]?>',
   STAT: '<?=$arParams["STAT"]?>',
   STAT_LIMIT: '<?=$arParams["STAT_LIMIT"]?>',   
   CATEGORY: [
   <?php
   foreach ($arParams["CATEGORY"] AS $val) echo "'{$val}',";
   ?>]
 });
</script>


<div class="moskrep-search">
<input class="moskrep_submit" type="button" value="<?=Loc::getMessage("DSEARCH_AJAX_SEARCH")?>"/>	
<input name="text" type="text" value="<?=htmlspecialcharsEx($_GET['result'])?>" class="moskrep_input" placeholder="<?=Loc::getMessage("DSEARCH_AJAX_SEARCH_ARTNO")?>" autocomplete="off" />			  
<div id="text_result">
</div>
</div>


