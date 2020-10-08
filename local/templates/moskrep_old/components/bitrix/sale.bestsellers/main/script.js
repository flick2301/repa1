/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


BX.ready(function () {
    var buyBtnDetail = document.body.querySelectorAll('#tab-1 .product-list__btn');

    for (var i = 0; i < buyBtnDetail.length; i++) {
        BX.bind(buyBtnDetail[i], 'click', BX.delegate(function (e) {
            add2basketDetail(e)
        }, this));
    
    }
    
    function add2basketDetail(e) {
        var id = e.target.dataset.product,
                quantity = 1;
        if (!!BX('QUANTITY_' + id)) {
            quantity = BX('QUANTITY_' + id).value;
        }
       
        BX.ajax({
            url: window.location.href,
            data: {
                action: 'ADD2BASKET',
                ajax_basket: 'Y',
                quantity: quantity,
                id: e.target.dataset.product
            },
            method: 'POST',
            dataType: 'json',
            onsuccess: function (data) {
                if (data.STATUS == 'OK') {
                    BX.addClass(e.target, 'active');
                   
                    BX.onCustomEvent('OnBasketChange');
                } else {
                   console.log(data);
                }
            }
        }); 
    }
    
    
   
    
    
    
    //улетает картинка
    $(".product-list__btn").on("click",function(){
       var item = BX.findParent(BX.findParent(this));
       var id = BX.findChild(item, {"tag" : "img"}, true);
      //  var id = (this).target.dataset.product;
        var_left = $(".header-basket").offset().left;
        var_top = $(".header-basket").offset().top;

       
        $(id)
            .clone()
            .css({'position' : 'absolute', 'z-index' : '11100', top: $(this).offset().top-300, left:$(this).offset().left-100})
            .appendTo("body")
            .animate({opacity: 0.05,
                left: $(".header-basket").offset()['left'],
                top: $(".header-basket").offset()['top'],
                width: 20}, 1000, function() {
                $(this).remove();
            });

    });
});