<?
$aMenuLinks = Array(
	Array(
		"О нас",
		"/about/",
		Array(),
		Array(),
		""
	),
	Array(
		"Сертификаты",
		"/certificates/",
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Доставка",
		"/delivery/",
		Array(),
		Array(),
		""
	),
	Array(
		"Import&nbsp;<span class='import'>进口</span>", 
		"/import/",
		Array(),
		Array(),
		""
	),
	Array(
		"Способы оплаты",
		"/oplata/",
		Array(),
		Array(),
		""
	),
	Array(
		"Обмен и возврат",
		"/obmen-i-vozvrat/",
		Array(),
		Array(),
		""
	),
	Array(
		"Контакты",
		"/contacts/",
		Array(),
		Array(),
		""
	),
	Array(
		"Статьи",
		"/articles/",
		Array(),
		Array(),
		""
	),
    Array(
		"Скачать Прайс",
		"/prays-listy/",
		Array(),
		Array(),
		""
	),
    Array(
		"Правила торговли",
		"/pravila-torgovli/	",
		Array(),
		Array(),
		""
	),		
	Array(
		"Калькулятор веса",
		"/calculator/",
		Array(),
		Array(),
		""
	),	
    Array(
		"Карта сайта",
		"/map/",
		Array(),
		Array(),
		""
	),
	
);
foreach($aMenuLinks as $key=>$val)
{
	if(array_search("/articles/", $val) && $_SERVER['HTTP_HOST']!='krep-komp.ru')
		unset($aMenuLinks[$key]);
}
?>