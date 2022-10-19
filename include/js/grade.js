$(document).ready(function() {
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
});