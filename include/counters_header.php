<!-- Google Analitycs -->
 <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-69398243-1', 'auto');
    function getRetailCrmCookie(name) {
         var matches = document.cookie.match(new RegExp(
             '(?:^|; )' + name + '=([^;]*)'
         ));

         return matches ? decodeURIComponent(matches[1]) : '';
     }
     ga('set', 'dimension1', getRetailCrmCookie('_ga'));

   ga('require', 'displayfeatures');
   ga('require', 'linkid', 'linkid.js');
   var clientId='';
   ga(function(tracker) {
   clientId = tracker.get('clientId');
   
   ga('set', 'dimension2', clientId); });
   ga('send', 'pageview');
   <?
   global $USER;
   global $APPLICATION;
   global $userEmail;
   
   $rsUser = CUser::GetByID($USER->GetId());
	$arUser = $rsUser->Fetch();
	$userEmail = $arUser["EMAIL"];
   if(isset($arUser["PERSONAL_PHONE"]))
   {
	   $queryUrl = 'https://team.krep-komp.ru/rest/1/rdgiynh922m6xmy9/crm.contact.list';
		$data = array(
			'filter' => array("PHONE" => $arUser["PERSONAL_PHONE"]),
			'select' => array("ID")
		);
		$res = getContact($queryUrl, $data);
	   ?>ga('set', 'userId', '<?=$res["result"][0]["ID"]?>');
		
	   <?
   }else{
	   ?>
	   ga('set', 'userId', 'auto');
			
			<?
   }
	?>

<!--Дополнение GA2-->
/*ga(function(tracker) {
    function guid() {
      function s4() {
        return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
      }

      result = '';

      for(i=0; i<8; i++)
        result += s4();

      return result;
    }
});
	
   ga('set', 'dimension2', tracker.get('clientId'));
   ga('set', 'dimension5', guid());*/
<!--Дополнение GA2-->


<!--Дополнение GA-->
ga(function(tracker) {
    function guid() {
      function s4() {
        return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
      }

      result = '';

      for(i=0; i<8; i++)
        result += s4();

      return result;
    }
});

   ga('set', 'dimension5', guid());
 <!--Дополнение GA--> 
   
      </script>
 <!-- /Google Analitycs -->
 
<!-- Global site tag (gtag.js) - Google Ads: 958495754 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-958495754"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-958495754');
</script>


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
<?if($APPLICATION->GetCurPage() == "/"):?>
<!-- Criteo Homepage dataLayer -->
<script>
        var dataLayer = dataLayer || [];
        dataLayer.push({  
            'event': 'crto_homepage',
            crto: {             
                'email': '<?=$arUser["EMAIL"]?>' // может быть пустой строкой
            }
        });
</script>
<!-- END Criteo Homepage dataLayer -->
<?endif;?>


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
					"streetAddress": "Варшавское шоссе, 148, этаж 5, офис 501",
					"postalCode" : "117519",
					"addressLocality" : "Москва"
			 },
			"telephone": "+7(499) 350-55-55",
			"email": "sale@krep-komp.ru"
			}
		</script>


<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "url": "https://krep-komp.ru/",
  "logo": "https://krep-komp.ru/local/templates/moskrep/assets/design/website-logo/krep-komp.svg",
  "contactPoint": [{
    "@type": "ContactPoint",
    "telephone": "+7(499) 350-55-55",
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
   "https://www.instagram.com/krep_komp/",
   "https://www.facebook.com/krep.komp.ru"
  ]
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