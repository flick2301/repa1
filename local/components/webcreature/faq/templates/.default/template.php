<div class="faq">
<?foreach($arResult AS $val):?>
<div class="faq__theme">
<div class="faq__topic"><?=$val["NAME"]?></div>
<?foreach($val["ITEMS"] AS $item):?>
<div class="faq__box">
		<div class="faq__name"><?=$item["NAME"]?></div>
		<div class="faq__desc"><?=$item["PREVIEW_TEXT"]?></div>
</div>
<?endforeach?>	
</div>
<?endforeach?>	
</div>

<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
<?foreach($arResult AS $val):?><?$cnt++?><?$item_cnt=0?><?foreach($val["ITEMS"] AS $item):?><?$item_cnt++?>{
        "@type": "Question",
        "name": "<?=str_replace(Array("\"", "\n"), "'", $item["NAME"])?>",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "<?=str_replace(Array("\"", "\n"), "'", $item["PREVIEW_TEXT"])?>"
        }
	}<?if($cnt!=count($arResult) || $item_cnt!=count($val["ITEMS"])):?>,<?endif?>
<?endforeach?><?endforeach?>]
    }
    </script>