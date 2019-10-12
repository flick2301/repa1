

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
 
 <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W2BJX6S');</script>
<!-- End Google Tag Manager -->

