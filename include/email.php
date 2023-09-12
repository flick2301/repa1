<?
if($_SERVER['HTTP_HOST']=='spb.krep-komp.ru'){
echo 'spb@krep-komp.ru';
}elseif($_SERVER['HTTP_HOST']=='kazan.krep-komp.ru'){
echo 'kazan@krep-komp.ru';
}elseif($_SERVER['HTTP_HOST']=='nizhniy-novgorod.krep-komp.ru'){
echo 'nnov@krep-komp.ru';
}elseif($_SERVER['HTTP_HOST']=='voronezh.krep-komp.ru'){
echo 'voronej@krep-komp.ru';
}elseif($_SERVER['HTTP_HOST']=='novosibirsk.krep-komp.ru'){
echo 'novosibirsk@krep-komp.ru';
}elseif($_SERVER['HTTP_HOST']=='kaluga.krep-komp.ru'){
echo 'kaluga@krep-komp.ru';
}elseif($_SERVER['HTTP_HOST']=='pskov.krep-komp.ru'){
echo 'pskov@krep-komp.ru';
}elseif($_SERVER['HTTP_HOST']=='ryazan.krep-komp.ru'){
echo 'ryazan@krep-komp.ru';
}elseif($_SERVER['HTTP_HOST']=='tula.krep-komp.ru'){
echo 'tula@krep-komp.ru';
}else{
echo 'sale@krep-komp.ru';
}
?>