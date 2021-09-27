<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");//Зависит от выбранного пункта меню!?>


<?if (!$_GET['mobile']):?>

   <div class="basic-layout__columns basic-layout__columns--reverse">
     <div class="basic-layout__content">
		 
<?/* 
<!--page-heading-->
			<header class="basic-layout__module page-heading">       
			<h1>Личные данные</h1>
      </header>
			<!--page-heading-->

<script>
<!--
var opened_sections = ['reg'];
//-->

var cookie_prefix = 'BITRIX_SM';
</script>
<form method="post" name="form1" id="form_lk" action="/personal/private/" enctype="multipart/form-data">
<input type="hidden" name="sessid" id="sessid" value="4071f093eda69d6b2bc34e771e6ec7d5" /><input type="hidden" name="lang" value="s1" />
<input type="hidden" name="ID" value=1 />


      <!--user-account-->
      <div class="user-account">
        <div class="user-account__item">
         <label class="user-account__label" for="user-account__name">Имя:</label>
         <input class="simple-input user-account__input" type="text" name="NAME" id="user-account__name" value="Сергей">
        </div>
        <div class="user-account__item">
         <label class="user-account__label" for="user-account__surname">Фамилия:</label>
         <input class="simple-input user-account__input" type="text" name="LAST_NAME" id="user-account__surname" value="Костырев">
        </div>
        <div class="user-account__item">
         <label class="user-account__label" for="user-account__midname">Отчество:</label>
         <input class="simple-input user-account__input" type="text" name="SECOND_NAME" id="user-account__midname" value="Владимирович">
        </div>
        <div class="user-account__item">
         <label class="user-account__label" for="user-account__email">E-Mail:<span class="starrequired">*</span></label>
         <input class="simple-input user-account__input" type="text" name="EMAIL" id="user-account__email" value="moskrep-market@yandex.ru">
        </div>
        <div class="user-account__item">
         <label class="user-account__label" for="user-account__personal">Личный менеджер:</label>
         <input class="simple-input user-account__input" type="text" name="PERSONAL_MANAGER" id="user-account__personal" value="Штанникова Маргарита               ">
        </div>			  
        <div class="user-account__footer">
         <input onclick="BX.submit(BX('form_lk'));" class="main-button main-button--plus user-account__submit" type="button" value="Сохранить">
        </div>
      </div>
      <!--user-account-->
	  
	  <div class="user-notifications-mail">
	  <div class="user-notifications-title">Уведомления на электронную почту</div>
	  <div class="user-notifications-item"><label><input class="user-notifications-checkbox" type="checkbox" name="" value="1" /> Регистрация заказа</label></div>
	  <div class="user-notifications-item"><label><input class="user-notifications-checkbox" type="checkbox" name="" value="1" /> Статус доставки</label></div>
	  <div class="user-notifications-item"><label><input class="user-notifications-checkbox" type="checkbox" name="" value="1" /> Получать новостную рассылку</label></div>
	  </div>
	  
	  <div class="user-notifications-sms">
	  <div class="user-notifications-title">Уведомления по СМС</div>
	  <div class="user-notifications-item"><label><input class="user-notifications-checkbox" type="checkbox" name="" value="1" /> Регистрация заказа</label></div>
	  <div class="user-notifications-item"><label><input class="user-notifications-checkbox" type="checkbox" name="" value="1" /> Статус доставки</label></div>
	  <div class="user-notifications-item"><label><input class="user-notifications-checkbox" type="checkbox" name="" value="1" /> Получать новостную рассылку</label></div>	  
	  </div>	  

</form>*/?>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"krep-komp",
	Array(
		"CHECK_RIGHTS" => "N",
		"SEND_INFO" => "N",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(),
		"USER_PROPERTY_NAME" => ""
	)
);?>

			
		</div>
		
		
		
		
		
		
		
		
<?global $USER;
if ($USER->IsAuthorized()):?>

<aside class="basic-layout__sidebar">
 
 <!--table-of-contents-->
		
<!--<div class="contacts__leftside">

       <div class="sidebar">
        <div class="sidebar__menu">
         <div class="sidebar__profile"> 
          <div class="sidebar__icon">СК</div>
          <div class="sidebar__name">Сергей Костырев</div>
         </div>

          <div class="sidebar__group"> <a class="sidebar__link sidebar__link--orders" href="/personal/">Мои заказы</a></div>
          <div class="sidebar__group"> <a class="sidebar__link sidebar__link--active sidebar__link--settings" href="/personal/private/">Личные данные</a></div>
          <div class="sidebar__group"> <a class="sidebar__link sidebar__link--docs" href="/personal/change_pass/">Сменить пароль</a></div>
          <div class="sidebar__group"> <a class="sidebar__link sidebar__link--exit" href="/personal/?logout=yes">Выйти из профиля</a></div>				 
        </div>
       </div>
					
</div>-->


 <div class="contacts__leftside ">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu", 
						"left_bottom_full", 
						array(
							"ROOT_MENU_TYPE" => "left_bottom",
							"MAX_LEVEL" => "1",
							"CHILD_MENU_TYPE" => "left_bottom",
							"USE_EXT" => "Y",
							"VIBOR_CATALOG_TABLE" => array(
								0 => "",
								1 => "2411",
								2 => "2403",
								3 => "",
								),
							"COMPONENT_TEMPLATE" => "left_bottom_full",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(),
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
							),
						false
					);?>
</div>					
</aside>
<?endif?>		
		
		
</div>	


















<!--Мобильная версия-->
<?else:?>

<div class="filter filter--page">
<div class='filter__block'>

 
 <div class="contacts__leftside ">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu", 
						"left_bottom_full", 
						array(
							"ROOT_MENU_TYPE" => "left_bottom",
							"MAX_LEVEL" => "1",
							"CHILD_MENU_TYPE" => "left_bottom",
							"USE_EXT" => "Y",
							"VIBOR_CATALOG_TABLE" => array(
								0 => "",
								1 => "2411",
								2 => "2403",
								3 => "",
								),
							"COMPONENT_TEMPLATE" => "left_bottom_full",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(),
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
							),
						false
					);?>					
</div>

					
	

							<div class='filter__rightside'>


<?$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"krep-komp",
	Array(
		"CHECK_RIGHTS" => "N",
		"SEND_INFO" => "N",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(),
		"USER_PROPERTY_NAME" => ""
	)
);?>

			
		
</div>
</div>
</div>


<?endif?>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
