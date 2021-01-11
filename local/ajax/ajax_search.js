
function get_result (){
    //очищаем результаты поиска
    $('#search_result').html('');
    //пока не получили результаты поиска - отобразим прелоадер
    $('#search_result').append('<div><img width="150" src="/search/preloader.GIF"></div>');
    $.ajax({
        type: "POST",
        url: "/local/ajax/ajax_search.php",
        data: "q="+q,
        dataType: 'json',
        success: function(json){
            //очистим прелоадер
            $('.title-search-result').html('');
             BX.style(BX('title_sr'), 'display', 'block');
            $('.title-search-result').append('<ul class="result__price-list"></div>');
            //добавляем каждый элемент массива json внутрь div-ника с class="live-search" (вёрстку можете использовать свою)
            $.each(json, function(index, element) {
                $('.title-search-result').find('.result__price-list').append('<li class="result__item"><a href="'+element.URL+'" class="result__link"><b>'+element.TITLE+'</b></a></li>');
                //console.log (element.BODY_FORMATED);
            });
            
        }
    });
}
var timer = 0;
var q = '';
BX.ready(function() {
    
    $('#title-search-input').keyup(function() {
        q = this.value; 
        clearTimeout(timer);
        timer = setTimeout(get_result, 1000);
    }); 
    $('#reset_live_search').click(function() {
        $('#search_result').html('');
    });
});