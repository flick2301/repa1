<?if(!strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse')):?>
<!-- Google Analitycs -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-69398243-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-69398243-1');
</script>
<!-- /Google Analitycs -->
 


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W2BJX6S');</script>
<!-- End Google Tag Manager -->


<script>
<?if(isset($arUser["PERSONAL_PHONE"])):?>
dataLayer.push({  
    'UID':'<?=$res["result"][0]["ID"]?>' // Уникальный идентификатор пользователя взятый из CRM Bitrix24
});
<?endif;?>
</script>


<!-- Yandex.Metrika counter -->
<script>
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(29426710, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
   });
</script>
<!-- /Yandex.Metrika counter -->




<!--json-ld-->
<script type="application/ld+json">
			{
			  "@context": "http://schema.org",
			  "@type": "Organization",
			  "name" : "Интернет-магазин строительного крепежа «КРЕП-КОМП»",
			  "address": {
					"@type" : "PostalAddress",
					"streetAddress": "проспект Энергетиков, 22Л",
					"postalCode" : "195298",
					"addressLocality" : "Санкт-Петербург"
			 },
			"telephone": "+7(812) 309-95-45",
			"email": "sale@krep-komp.ru"
			}
		</script>


<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "url": "https://spb.krep-komp.ru/",
  "logo": "https://spb.krep-komp.ru/local/templates/moskrep/assets/design/website-logo/krep-komp.svg",
  "contactPoint": [{
    "@type": "ContactPoint",
    "telephone": "+7(812) 309-95-45",
    "contactType": "customer service"
  }]
}
</script>


<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Person",
  "name": "Интернет-магазин строительного крепежа «КРЕП-КОМП»",
  "url": "https://krep-komp.ru/",
  "sameAs": [
   "https://vk.com/krep_komp",
   "https://www.youtube.com/channel/UCOKXuIbajRZpYJ4uShRzMYw",
   
   
  }]
}
</script>
<!--json-ld-->


<script async>
(function ct_load_script() {
var ct = document.createElement('script'); ct.type = 'text/javascript'; ct.async=true;
ct.src = document.location.protocol+'//cc.calltracking.ru/phone.a7431.11162.async.js?nc='+Math.floor(new Date().getTime()/300000);
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ct, s);
})();
</script>
<?endif?>
