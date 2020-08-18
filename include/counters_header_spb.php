<!-- Google Analitycs -->
 <script type="text/javascript">
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
   $userID = $USER->GetID();
   if(isset($userID))
   {
	   ?>ga('set', 'userId', '<?=$userID?>');
		
	   <?
   }else{
	   ?>
	   ga('set', 'userId', 'auto');
			
			<?
   }
	?>	
	
	
	
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

    <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(29426710, "init", {
        id:29426710,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/29426710" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->