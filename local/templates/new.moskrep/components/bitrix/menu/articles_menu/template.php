<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>


    <div class="blog">
        <div class="blog__section">

        <?if($APPLICATION->GetCurPage() == '/articles/'){?>
            <a class="blog__section__item blog__section__item--active" href="/articles/">Все</a>
            <?}else{?>
            <a class="blog__section__item" href="/articles/">Все</a>
            <?}
        foreach($arResult as $arItem):
            ?>



            <?if ($arItem["SELECTED"]):?>
            <a class="blog__section__item blog__section__item--active" href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?></a>

        <?else:?>
            <a class="blog__section__item" href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?></a>
        <?endif?>


        <?endforeach?>



        </div>
    </div>


<?endif?>