

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