$(function(){
var lastId,
    topMenu = $(".blog__substence__list"),
    topMenuHeight = topMenu.outerHeight(),
    menuItems = topMenu.find("a"),
    scrollItems = menuItems.map(function(){
      var item = $($(this).attr("href"));
      if (item.length) { return item; }
    });

menuItems.click(function(e){	
  var href = $(this).attr("href"),
      offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+20;
  $('html, body').stop().animate({ 
      scrollTop: offsetTop
  }, 500);
  e.preventDefault();
});


$(window).scroll(function(){
   var fromTop = $(this).scrollTop()+topMenuHeight;
   var cur = scrollItems.map(function(){
     if ($(this).offset().top < fromTop)
       return this;
   });
   
   cur = cur[cur.length-1];
   var id = cur && cur.length ? cur[0].id : "";
   
   if (lastId !== id) {
       lastId = id;
       console.log(lastId);
       
       $(".blog__substence__link").removeClass("blog__substence__link--active");
       $(".blog__substence__link[href='#"+id+"']").addClass("blog__substence__link--active");
   }                   
});


});