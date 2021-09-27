<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

       <div class="sidebar">
        <div class="sidebar__menu">
         <div class="sidebar__profile"> 
          <div class="sidebar__icon">СК</div>
          <div class="sidebar__name">Сергей Костырев
		  
		  <!--Если есть скидка-->
		  <div class="sidebar__name-discount">Ваша скидка</div>
		  <div class="sidebar__name-discount-icons">
		  <div class="sidebar__name-discount-icon sidebar__name-discount-icon_copper active"></div>
		  <div class="sidebar__name-discount-icon sidebar__name-discount-icon_silver"></div>
		  <div class="sidebar__name-discount-icon sidebar__name-discount-icon_gold"></div>
		  </div>
		  <!--/Если есть скидка-->

		  </div>
         </div>
		 
		 <div class="sidebar__manager"> 
		 <div class="sidebar__manager-title" id="sidebar__manager-title">Личный менеджер</div>		
		 <div class="sidebar__manager-schedule">График работы Пн-Пт с 9 до 18</div>	
		 <div class="sidebar__manager-name">Иван Иванов</div>			 
		 <div class="sidebar__manager-mail">Yandex@yandex.ru</div>	
		 <div class="sidebar__manager-phone">8 888 888 88 88</div>			 
		 </div>

          <div class="sidebar__group sidebar__group--nohr"> <a class="sidebar__link sidebar__link--orders-active" href="/personal/?active=true">Активные заказы</a></div>
		  <div class="sidebar__group"> <a class="sidebar__link sidebar__link--orders" href="/personal/">Все заказы</a></div>
          <!--<div class="sidebar__group sidebar__group--nohr"> <a class="sidebar__link sidebar__link--active sidebar__link--favorites" href="/personal/favorites/">Избранные</a></div>
		  <div class="sidebar__group"> <a class="sidebar__link sidebar__link--viewed" href="/personal/viewed/">Просмотренные</a></div>-->		  
          <div class="sidebar__group"> <a class="sidebar__link sidebar__link--active sidebar__link--settings" href="/personal/private/">Личные данные</a></div>
		  <!--<div class="sidebar__group"> <a class="sidebar__link sidebar__link--organizations" href="/personal/organizations/">Данные организаций</a></div>-->
          <div class="sidebar__group"> <a class="sidebar__link sidebar__link--docs" href="/personal/change_pass/">Сменить пароль</a></div>
          <div class="sidebar__group"> <a class="sidebar__link sidebar__link--exit" href="/personal/?logout=yes">Выйти из профиля</a></div>				 
        </div>
       </div>
			  

<?endif?>


			
			
				
				
					
				
			
			
	