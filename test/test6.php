<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");//Зависит от выбранного пункта меню!?>

<?CJSCore::Init(array('ajax'));?>


<script>
//js

offersId = 54;

var postData = {               
  'sessid': BX.bitrix_sessid(),
  'site_id': BX.message('SITE_ID'),
  'action': 'add',
  'id': offersId,
  'quantity': 1,
};
BX.ajax({
   url: '/test/file.php',
   method: 'POST',
   data: postData,
   dataType: 'json',
   onsuccess: function(result){      
      console.log(result);
   },
   onfailure: function(result){
      console.log(result);
   } 
});

</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
