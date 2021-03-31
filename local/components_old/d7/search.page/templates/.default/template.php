<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="search-page">
    
    <form action="" method="get">

	<input type="text" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" class='d7' size="40" />
        <a href="javascript:void(0)" onclick="BX('search_submit_form').click();" class="nav-search__btn">Поиск</a>
        
        <input style="display:none;" id="search_submit_form" name="s" type="submit" value="Поиск">
    </form>
    <div class='search_result'>
        <?php
        if(count($arResult['ITEMS'])==0){
            ?>
            <div class="search-item">
		<h4>По запросу "<?=$arResult["REQUEST"]["QUERY"]?>" ничего не найдено</h4>
		
            </div>
            <?   
        }
        foreach($arResult['ITEMS'] as $item){
            ?>
            <div class="search-item">
		<h4><a href="<?=$item['URL']?>"><?=$item['TITLE']?></a></h4>
		<div class="search-preview"><?=$item['ARTICLE']?></div>
            </div>
        <?php
        }
        ?>
    </div>

</div>