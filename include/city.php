<?if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'):?>
Санкт-Петербург
<?elseif($_SERVER['HTTP_HOST']=='kazan.krep-komp.ru'):?>
Казань
<?elseif($_SERVER['HTTP_HOST']=='nizhniy-novgorod.krep-komp.ru'):?>
Нижний Новгород
<?elseif($_SERVER['HTTP_HOST']=='voronezh.krep-komp.ru'):?>
Воронеж
<?else:?>
Москва
<?endif;?>