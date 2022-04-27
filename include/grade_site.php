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
		<input class="mdl__button" type="submit" value="Отправить">
	</form>
</div>

<script>
$('.grade__button').on('click', function() {
    $('.grade').addClass('grade--active');
});
$('.grade__btn').on('click', function() {
    $('.grade').removeClass('grade--active');
});

$(document).on('click', '.mdl__button', function(e) {
	//e.preventDefault();
	//$(this).submit();
});

$(".mdl__form").submit(function(e) {
	
	e.preventDefault();
	$('.mdl__result').text('');
	

if (!$(this).children().children('[name=GNAME]').val() || !$(this).children().children('[name=GTEXT]').val()) {
	$('.mdl__result').text('Не все обязательные поля заполнены!');
	retutn;
}
	
	var $that = $(this),
	data = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)

      $.ajax({
         url: $(this).attr("action"),
         data: data,
         type: 'post',
		 contentType: false, // важно - убираем форматирование данных по умолчанию
		 processData: false, // важно - убираем преобразование строк по умолчанию
         /*dataType: "json",*/
		beforeSend: function() {
		},	 
         success: function (data) {
			console.log(data);
			$('.mdl__result').text('Спасибо Вам за отзыв!');
			$that.children().children('input, textarea').val('');
			setTimeout(function() {$('.mdl__close').trigger('click')}, 1500);
         },
         error: function (data) {
            $('.mdl__result').text('Ошибка на сервере! ' + data);
         },
		 complete: function() {
		},	 
      });
});
</script>


<style>

	.grade {
  position: fixed;
  left: 30px;
  bottom: 15px;
  display: flex;
    flex-direction: column-reverse;
  z-index: 350;
  transition: 0.3s; }
  @media (max-width: 767px) {
    .grade {
      left: 15px; } }
  .grade--active {
    bottom: 30px;
    background-color: #493fda;
    border-radius: 10px; }
    .grade--active .grade__button {
      border: unset;
      background-color: #493fda;
      box-shadow: unset; }
      .grade--active .grade__button span {
        color: #fff; }
    .grade--active .grade__bottom {
      visibility: visible;
      opacity: 1; }
  .grade__button {
    padding: 13px 20px;
    background: #ffffff;
    border: 1px solid #493fda;
    box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.16);
    border-radius: 10px;
    cursor: pointer;
    transition: 0.3s; }
	
	.grade__button b{
		font-weight: 500;
	}
	
    .grade__button:hover {
      background-color: #493fda; }
      .grade__button:hover span {
        color: #fff; }
    .grade__button span {
      font-family: "Montserrat";
      font-weight: 500;
      font-size: 14px;
      color: #493fda;
      padding-left: 28px;
      background-position: left center;
      background-repeat: no-repeat;
      background-image: url(/upload/modal/smile-1.svg);
      transition: 0.3s; }
  .grade__bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.3);
    padding-top: 12px;
    padding-bottom: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0px 10px;
    visibility: hidden;
    opacity: 0; }
  .grade__btn {
    font-weight: 400;
    font-size: 12px;
    font-family: "Montserrat";
    color: #ffffff;
    margin-left: 28px;
    padding: 2px 0px;
    padding-left: 24px;
    background-position: left center;
    background-repeat: no-repeat;
    transition: 0.3s;
    cursor: pointer; }
    .grade__btn:first-child {
      margin-left: 0px; }
    .grade__btn--one {
      background-image: url(/upload/modal/green-1.svg); }
      .grade__btn--one:hover {
        background-image: url(/upload/modal/green-2.svg); }
    .grade__btn--two {
      background-image: url(/upload/modal/red-1.svg); }
      .grade__btn--two:hover {
        background-image: url(/upload/modal/red-2.svg); }

.fancybox-close-small {
  display: none; }

.mdl {
  max-width: 380px;
  width: 100%;
  padding: 30px 35px 50px 35px !important;
  display: none; }
  .mdl__close {
    position: absolute;
    right: 15px;
    top: 15px;
    z-index: 15;
    background: #493fda;
    background-image: url(/upload/modal/close-icon.svg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: 14px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    transition: 0.3s;
    cursor: pointer; }
    .mdl__close:hover {
      background-color: #3a0fb5; }
  .mdl__title {
    font-family: "Montserrat";
    font-weight: 700;
    font-size: 24px;
    color: #000000;
    text-align: center;
    margin-bottom: 30px; }
  .mdl__box {
    margin-top: 14px; }
    .mdl__box:first-child {
      margin-top: 0px; }
  .mdl__name {
    font-family: "Montserrat";
    font-weight: 400;
    font-size: 16px;
    color: #000000;
    margin-bottom: 8px; }
  .mdl__textarea {
    font-family: "Montserrat";
    padding: 11px 16px;
    background: none;
    border: none;
    outline: none;
    background: #ffffff;
    border: 2px solid #dfdfdf;
    border-radius: 4px;
    color: #000000;
    font-weight: 400;
    font-size: 16px;
    height: 114px;
    width: 100%;
    resize: none; }
    .mdl__textarea::placeholder {
      color: rgba(0, 0, 0, 0.5); }
  .mdl__input {
    font-family: "Montserrat";
    padding: 11px 16px;
    background: none;
    border: none;
    outline: none;
    background: #ffffff;
    border: 2px solid #dfdfdf;
    border-radius: 4px;
    color: #000000;
    font-weight: 400;
    font-size: 16px;
    width: 100%; }
    .mdl__input::placeholder {
      color: rgba(0, 0, 0, 0.5); }
  .mdl__button {
    font-family: "Montserrat";
    background: none;
    border: none;
    outline: none;
    margin-top: 30px;
    text-align: center;
    background-color: #493fda;
    color: #fff;
    padding: 11px 20px;
    width: 100%;
    border-radius: 9px;
    font-weight: 400;
    font-size: 14px;
    transition: 0.3s;
    cursor: pointer; }
    .mdl__button:hover {
      background-color: #3a0fb5; }

.mdl__result {
	color: #493fda;
}
.test {
  width: 280px;
  padding: 15px 50px;
  background-color: #493fda;
  color: #fff;
  text-align: center;
  text-transform: uppercase;
  display: block;
  transition: 0.3s;
  margin: 150px auto;
  cursor: pointer; }
  .test:hover {
    background-color: #3a0fb5; }

.map {
  width: 100%;
  height: 100%; }
  @media (max-width: 767px) {
    .map {
      height: 250px; } }

#map {
  width: 100%;
  height: 100%; }

.prod .product__availible{
padding: 0px;
    margin-top: 8px;
    border: 0px;
}

.prod {
  padding: 0px !important;
  max-width: 1150px;
  width: 100%;
  border-radius: 16px !important;
  display: none; }
  @media (max-width: 767px) {
    .prod {
      margin: 20px 0 !important; } }
  .prod__topside {
    display: flex; }
    @media (max-width: 767px) {
      .prod__topside {
        flex-direction: column; } }
  .prod__leftside {
    width: calc(100% - 575px); }
    @media (max-width: 1023px) {
      .prod__leftside {
        width: calc(100% - 440px); } }
    @media (max-width: 767px) {
      .prod__leftside {
        width: 100%; } }
  .prod__rightside {
    display: flex;
    width: 575px; }
    @media (max-width: 1023px) {
      .prod__rightside {
        width: 440px; } }
    @media (max-width: 767px) {
      .prod__rightside {
        width: 100%;
      } }
  .prod__left {
    max-width: 280px;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #f0f0f0; }
    @media (max-width: 1023px) {
      .prod__left {
        max-width: 200px; } }
    @media (max-width: 767px) {
      .prod__left {
		    width: 50%;
        max-width: unset; } }
  .prod__right {
    padding: 30px 24px 35px 40px; }
    @media (max-width: 1023px) {
      .prod__right {
        padding: 30px 15px 35px 20px; } }
    @media (max-width: 767px) {
      .prod__right {
	      width: 50%;
        padding: 25px 15px; } }
  .prod__title {
    font-family: "Montserrat";
    font-weight: 700;
    font-size: 24px;
    line-height: 1.2;
    color: #000000;
    margin-bottom: 25px; }
    @media (max-width: 1023px) {
      .prod__title {
        font-size: 20px; } }
    @media (max-width: 767px) {
      .prod__title {
		font-size: 18px;
        margin-bottom: 15px; } }
  .prod__list {
    max-height: 360px;
    padding-right: 40px;
    overflow-y: auto; }
    .prod__list::-webkit-scrollbar {
      background-color: rgba(0, 0, 0, 0.1);
      width: 2px; }
    .prod__list::-webkit-scrollbar-thumb {
      width: 2px;
      background-color: rgba(0, 0, 0, 0.5); }
    @media (max-width: 1023px) {
      .prod__list {
        padding-right: 15px; } }
    @media (max-width: 767px) {
      .prod__list {
        max-height: 320px; } }
  .prod__name {
    font-family: "Montserrat";
    font-weight: 700;
    font-size: 12px;
    line-height: 1.35;
    color: #000000;
    margin-bottom: 8px; }
  .prod__time {
    font-family: "Montserrat";
    font-weight: 400;
    font-size: 12px;
    line-height: 1.35;
    color: #000000;
    margin-bottom: 4px; }
  .prod__item {
    margin-top: 24px; }
    .prod__item:first-child {
      margin-top: 0px; }
    @media (max-width: 767px) {
      .prod__item {
        margin-top: 20px; } }
  .prod .product__botside {
 
    border-top: 1px solid #f0f0f0; }

  @media (max-width: 1023px) {
    .prod .product__topside {
      padding: 15px; }
    .prod .product__link {
      padding: 15px;
      padding-top: 0px; }
    .prod .product__name {
      padding: 0px 15px;
      padding-bottom: 15px; }
    .prod .product__params {
      padding: 15px; }
    .prod .product__botside {
      padding: 15px; } }
	  
	  @media (max-width: 767px) {

		.grade{
			display: none;
		}
	  	.grade__button b{
		display: none;
	}
	
	.grade__btn--one span{
		display: none;
	}
	
	.grade__btn--two span{
		display: none;
	}
	
	.grade__btn{
		margin-left: 20px;
	}
	
	.grade__button {
    padding: 10px 20px 8px;}
	

	
	.grade__btn{
		    padding: 10px;
	}
	
	.grade__bottom{
	    padding-top: 12px;
    padding-bottom: 12px;
	}
	

	
	  }
	   @media (max-width: 380px) {
		.prod .product__price{
			font-size: 15px;
		}
		
		.prod .product__param{
			font-size: 12px;
		}
		
		.prod__right {
    padding: 25px 10px;
}

.prod .product__buy{
    width: 30px;
    height: 30px;
}

.prod .product__price--one{
font-size: 12px;
}

.prod .product__buy svg {
    height: 15px;
    width: 15px;
}
	   }
	   
	   	.grade__bottom {
	border-top: 0px;
	padding: 10px 20px 8px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
	margin: 0px ;
	}
		.grade__btn{
		margin-left: 20px;
	}
	

</style>