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
<div id='search-popup' class="moskrep-search c-header__searchbox">
						
							<input class="c-header__searchbox-input" name="search" type="text" placeholder="Найти товар" autocomplete="off">
							<button class="c-header__searchbox-submit" type="submit">
								<svg aria-hidden="true" width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.9673 12.1943L16 16M13.8116 7.40645C13.8116 10.9446 10.9436 13.8129 7.40579 13.8129C3.86797 13.8129 1 10.9446 1 7.40645C1 3.86826 3.86797 1 7.40579 1C10.9436 1 13.8116 3.86826 13.8116 7.40645Z" stroke="white" stroke-width="2" stroke-linecap="round"/>
								</svg>                
								Найти товар
							</button>
						
					</div>




