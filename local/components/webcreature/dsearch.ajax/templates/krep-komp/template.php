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


<div class="global-search">
<input class="simple-input simple-input--plus global-search__input moskrep_search" type="button" value=""/>	
<label class="global-search__label" for="global-search"><small class="global-search__hint global-search__hint--lite moskrep_submit"><?=Loc::getMessage("DSEARCH_AJAX_SEARCH_SMALL")?></small><small class="global-search__hint global-search__hint--full"><?=Loc::getMessage("DSEARCH_AJAX_SEARCH_ARTNO")?></small></label>
<input name="text" type="text" value="<?=htmlspecialcharsEx($_GET['result'])?>" class="global-search__submit moskrep_input" placeholder="" autocomplete="off" />			  
<div id="text_result">
</div>
</div>
