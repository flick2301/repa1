<?$APPLICATION->SetAdditionalCSS("/include/css/grade_confirm.css", true);?>
<?$APPLICATION->AddHeadScript("/include/js/grade.js");?>

<div class="grade">
	<div class="grade__button"><span>Оценка <b>сайта</b></span></div>
	<div class="grade__bottom"> 
		<a class="grade__btn grade__btn--one" data-fancybox data-options='{"touch" : false}' data-src="#modalGreen"><span>Похвалить</span></a>
		<a class="grade__btn grade__btn--two" data-fancybox data-options='{"touch" : false}' data-src="#modalRed"><span>Пожаловаться</span></a>
	</div>
</div>


<div class="mdl" id="modalGreen">
	<div class="mdl__close" data-fancybox-close></div>
	<div class="mdl__title">Похвалить</div>
	<form class="mdl__form" action="/ajax/grade_site.php">
	<div class="mdl__result"></div>	
	<input type="hidden" name="GNICE" value="Y" />
		<div class="mdl__box"> 
			<div class="mdl__name">Сообщение*</div>
			<textarea class="mdl__textarea"  name="GTEXT" required="required"  value="Что больше понравилось?"></textarea>
		</div>
		<div class="mdl__box"> 
			<div class="mdl__name">Имя*</div>
			<input class="mdl__input" type="text" name="GNAME" required="required"  placeholder="">
		</div>
		<div class="mdl__box"> 
			<div class="mdl__name">E-mail</div>
			<input class="mdl__input" type="email" name="GEMAIL" placeholder="">
		</div>
		<div class="mdl__box"> 
			<div class="mdl__name">Телефон</div>
			<input class="mdl__input send-a-request__input phonemask" name="GPHONE" type="tel" placeholder="+7">
		</div>
		<input type='hidden' value='<?=$_GET['ORDER_ID']?>' name="GORDERID">
		<input class="mdl__button" type="submit" value="Отправить">
	</form>
</div>

<div class="mdl" id="modalRed">
	<div class="mdl__close" data-fancybox-close></div>
	<div class="mdl__title">Пожаловаться</div>
	<form class="mdl__form" action="/ajax/grade_site.php">
	<div class="mdl__result"></div>	
		<div class="mdl__box"> 
			<div class="mdl__name">Что не понравилось?*</div>
			<textarea class="mdl__textarea"  name="GTEXT" required="required"  value="Как мы можем улучшить свою работу?"></textarea>
		</div>
		<div class="mdl__box"> 
			<div class="mdl__name">Имя*</div>
			<input class="mdl__input" type="text" name="GNAME" required="required" placeholder="">
		</div>
		<div class="mdl__box"> 
			<div class="mdl__name">E-mail</div>
			<input class="mdl__input" type="email" name="GEMAIL" placeholder="">
		</div>
		<div class="mdl__box"> 
			<div class="mdl__name">Телефон</div>
			<input class="mdl__input send-a-request__input phonemask" name="GPHONE" type="tel" placeholder="+7">
		</div>
		<input type='hidden' value='<?=$_GET['ORDER_ID']?>' name="GORDERID">
		<input class="mdl__button" type="submit" value="Отправить">
	</form>
</div>