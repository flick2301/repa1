<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
//CJSCore::Init(array('window'));
?>

<?/*
<script>
var popup = new BX.CDialog({
'title':'Выбрать товары', 
'content_url':'/robots.txt', 
'width':'550', 
'height':'350'
});

popup.Show();
</script>
*/?>


<!--<a id="modal-can-register-link" href="#modal-can-register" rel="modal-can-register">Окно для десктопной версии</a>
<br />-->

<?if(SITE_TEMPLATE_ID=='krep-komp_mobile'):?>
<a href="javascript:void(0);" class="modal-can-register-link" style="display: block;">Окно для мобильной версии</a>


<div class="modal fade box-modal modal-can-register-mobile" id="modal-can-register-mobile">
<div class="inmodal-can-register-mobile">
<div class="can-register-mobile">

<div class="can-register-mobile_close"></div>

<div class="can-register-mobile_title">
Еще не зарегистрированы?
</div>

<div class="can-register-mobile-info">
<div class="can-register-mobile-info_item can-register-mobile-info_item__sale">
<div class="can-register-mobile-info_title">Выгодно</div>
<ul class="can-register-mobile-info-group">
<li class="can-register-mobile-info-group_item">Скидки на квартал 5%, 10%, 15%</li>
<li class="can-register-mobile-info-group_item">Цены в каталоге с учетом скидки</li>
<ul>
</div>
<div class="can-register-mobile-info_item can-register-mobile-info_item__history">
<div class="can-register-mobile-info_title">Удобно</div>
<ul class="can-register-mobile-info-group">
<li class="can-register-mobile-info-group_item">Узнай статус заказа</li>
<li class="can-register-mobile-info-group_item">Личный менеджер</li>
<li class="can-register-mobile-info-group_item">История заказов</li>
<ul>
</div>
</div>

<button class="can-register-mobile__button" onclick="window.open('/personal/', '_blank');"> Авторизоваться </button>

<div class="can-register-mobile__no-personal"> Еще нет кабинета?  </div>

<a class="can-register-mobile__registration" href="/personal/?register=yes"> Зарегистрироваться </a>

</div>
</div>
</div>






<?else:?>
<a href="javascript:void(0);" class="modal-can-register-link" style="display: block;">Окно для десктопной версии</a>





<div class="modal fade box-modal modal-can-register" id="modal-can-register">
<div class="inmodal-can-register">
<div class="can-register">

<div class="can-register_close"></div>

<div class="can-register_title">
Авторизуйтесь и оцените преимущества личного кабинета!
</div>

<ul class="can-register-info">
<li class="can-register-info_item can-register-info_item__status">Отслеживание статуса и местанахождения заказа;</li>
<li class="can-register-info_item can-register-info_item__sale">Закрепление личного менеджера и скидок на квартал: <b>5%, 10%, 15%</b>;</li>
<li class="can-register-info_item can-register-info_item__personal">Показ цен в каталоге с учетом персональной скидки;</li>
<li class="can-register-info_item can-register-info_item__history">История заказов и возможность их повторения;</li>
</ul>

<button class="can-register__button" onclick="window.open('/personal/', '_blank');"> Авторизоваться </button>

<div class="can-register__no-personal"> Еще нет кабинета?  </div>

<a class="can-register__registration" href="/personal/?register=yes"> Зарегистрироваться </a>
</div>
</div>
</div>
<?endif?>







<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>