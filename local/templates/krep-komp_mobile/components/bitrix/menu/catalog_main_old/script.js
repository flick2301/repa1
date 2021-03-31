BX.ready(function () {
	
	$(document).on('click', '#catalog-nav__toggle.open_menu', function() {
		openMenu(this);
	});
	
	$(document).on('click', '#catalog-nav__toggle.open_mobile_menu', function() {
			openMenu(this, true);
	});	
		
	$(document).on('click', '#catalog_main_mobile_menu .menu_close_bar', function() {
			$('.basic-layout__header').removeClass('static');		
			$('#catalog_main_mobile_menu').slideUp(300);
			$('.basic-layout__header').css('z-index', 8);
	});	
	
	$(document).on('click', '#catalog_main_mobile_menu .catalog-nav__item.parent > a', function(e) {
			e.preventDefault();
			if ($(this).parent().parent().children('.children')) {
				$(this).parent().parent().children('.children[rel=' + $(this).parent().attr('rel') + ']').show();
				//$(this).parent().parent().children('.children').show();
				//$(this).parent().parent().children('.children').attr('rel');
				$('#catalog_main_mobile_menu .menu_close_bar span').attr('rel', $(this).parent().parent().children('.children').attr('rel'));
				$('#catalog_main_mobile_menu .menu_close_bar span').show();
				if ($(this).parent().parent().children('.children').hasClass('level1')) {$('#catalog_main_mobile_menu .catalog-nav__item.level1').hide();}
				if ($(this).parent().parent().children('.children').hasClass('level2')) {$('#catalog_main_mobile_menu .catalog-nav__item.level2').hide();}
				if ($(this).parent().parent().children('.children').hasClass('sale')) {$('#catalog_main_mobile_menu .catalog-nav__item.level2').hide();}
				$('#catalog_main_mobile_menu .menu_close_bar div').text($(this).text());
			}	
	});	
	
	$(document).on('click', '#catalog_main_mobile_menu .catalog-nav__item.parent > a span', function() {
		if ($(this).parent('a').attr('href')) window.location.href = $(this).parent('a').attr('href');
	});
		
	$(document).on('click', '#catalog_main_mobile_menu .menu_close_bar span', function(e) {
		e.stopPropagation();
		$('#catalog_main_mobile_menu .children').hide();
		$('#catalog_main_mobile_menu div[rel=' + $(this).attr('rel') + ']').parent().show();
		$('#catalog_main_mobile_menu div[rel=' + $(this).attr('rel') + ']').parent().children('li').show();
		$('#catalog_main_mobile_menu div[rel=' + $(this).attr('rel') + ']').parent().parent().parent().children('li').show();
		
		if ($('#catalog_main_mobile_menu div[rel=' + $(this).attr('rel') + ']').parent().children('li').hasClass('level1')) {
			$('#catalog_main_mobile_menu .menu_close_bar span').hide();		
			$('#catalog_main_mobile_menu .catalog-nav__item').show();
			$('#catalog_main_mobile_menu .menu_close_bar div').text('Каталог');
		}
		else {
			$('#catalog_main_mobile_menu .menu_close_bar div').text($('#catalog_main_mobile_menu li[rel=' + $(this).attr('rel') + ']').text());
			$('#catalog_main_mobile_menu .menu_close_bar span').attr('rel', 1);
		}
	});		
	
	//$('#catalog_main_menu  .catalog-nav__lvl2_new-list').css('height', $('body').height());
	//$('#catalog_main_menu  .catalog-nav__lvl2_new-list').css('height', $('body').height());
	
	
	$('#catalog_main_menu .catalog-nav__item').hover(function() {
		$('#catalog_main_menu .catalog-nav__item.active').removeClass('active');
		$(this).addClass('active');
		menuResizer();
	});
	
	$(document).on('mouseover', '#catalog_main_menu .sale', function() {
		//$('#catalog_main_menu .catalog-nav__item').removeClass('active');
	});	

	$(window).resize(function() {
		menuResizer();
	});	

/*		
	$(document).on('mouseover', '#catalog_main_menu .catalog-nav__item, #catalog_main_menu .sale', function() {
		if (!$(this).hasClass('first')) $('#catalog_main_menu .catalog-nav__item.first').removeClass('active');
	});
*/	
});

function menuResizer() {
		var height = $('#catalog_main_menu .catalog-nav__item.active .catalog-nav__lvl2_new-list').height();
		if (!height || (height < 800 && $(window).width() < 685)) height = 1000;
		else if (height < 800) height = '100%';
		else height += 200;
		$('#catalog_main_menu').css('height', height);	
		
		if ($(window).width() < 685 && $('#catalog-nav__toggle.open_menu').hasClass('active')) {
			openMenu($('#catalog-nav__toggle.open_menu'));
			//openMenu($('#catalog-nav__toggle.open_mobile_menu'), true);
		}
		else if ($(window).width() > 685) {
			$('.basic-layout__header').removeClass('static');
			$('#catalog_main_mobile_menu').slideUp(300);
		}
}

function openMenu(elem, mobile) {
	
	$('html').scrollTop(0);
	
if (mobile || $(window).width() < 685) {
			$('.basic-layout__header').css('z-index', 9);		
			$('.basic-layout__header').addClass('static');
			$('#catalog_main_mobile_menu').slideDown(300);
			$('#catalog_main_menu').fadeOut();
			$(elem).removeClass('active');	
		}
		else {
			if ($(elem).hasClass('active')) {
			$('#catalog_main_menu').fadeOut(500);
			$('#catalog_main_menu').slideUp(300);
			$(elem).removeClass('active');
			$('#catalog_main_menu .catalog-nav__item').removeClass('active');
		}
			else {
			$('#catalog_main_menu').fadeIn =(500);
			$('#catalog_main_menu').slideDown(300);
			$(elem).addClass('active');	
			$('#catalog_main_menu .catalog-nav__item').removeClass('active');
			$('#catalog_main_menu .catalog-nav__item.first').addClass('active');
			//$('#catalog_main_menu .sale .catalog-nav__item').addClass('active');
			menuResizer();
		}
	}		
}