<?php
header('Content-Type: text/html; charset=utf-8');

class GetAreas {
protected $host = 'localhost'; // адрес сервера 
protected $database = 'mapdb'; // имя базы данных
protected $user = 'mapusr'; // имя пользователя
protected $password = 'cW_FmNv{hoa3doM]X'; // пароль

protected $link;
protected $areas_groups = Array();
protected $areas_types = Array();
protected $areas = Array();

public $text;

function __construct() {
	$this->link = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die("Ошибка " . mysqli_error($this->link));
	mysqli_set_charset($this->link, 'utf8');
	
	$this->areas_groups = $this->getGroups();
	foreach ($this->areas_groups AS $group) {
		$this->text .= "function {$group["js_function"]}(main) {\n";
		//$this->text .= $group["name"];
		
	$i = "0";	
	$this->areas_types = $this->getTypes($group["delivery_id"]);	
	foreach ($this->areas_types AS $type) {
		$this->text .= "var coords = [];\n";
			
			$this->areas = $this->getAreas($type["id"]);
			foreach ($this->areas AS $area) {
				$this->text .= "coords.push([{$area["lat"]}, {$area["lon"]}]);\n";
			}
		
		$this->text .= "addPolygon([coords], '{$type["name"]}', {$i}, ".(count($this->areas_types) - $i).");\n\n";
		$i++;
	}		
		
		$this->text .= "}\n\n";
	}	
	


	mysqli_close($this->link);
}

function getGroups(): array { //Доставки
	$sql = mysqli_query($this->link, "SELECT * FROM `delivery` ORDER BY `sort`");
	while($res = mysqli_fetch_assoc($sql)) {
		$arr[] = $res;
	}
	return $arr;
}

function getTypes(int $delivery_id): array { //Зоны
	$sql = mysqli_query($this->link, "SELECT * FROM `types` WHERE `delivery_id`='{$delivery_id}' ORDER BY `delivery_id`, `max` DESC");
	while($res = mysqli_fetch_assoc($sql)) {
		$arr[] = $res;
	}
	return $arr;
}

function getAreas($type): array { //Координаты
	$sql = mysqli_query($this->link, "SELECT * FROM `areas` WHERE `type`='{$type}' ORDER BY `id`");
	$i = 0;
	$arr=array();
	while($res = mysqli_fetch_assoc($sql)) {
		$i++;
		if ($i==1) $start_coords = $res;
		if ($i==count(mysqli_num_rows($sql))) $end_coords = $res;
		$arr[] = $res;
	}
	
	if (start_coords["lat"]!=$end_coords["lat"] && $start_coords["lon"]!=$end_coords["lon"]) $arr[] = $start_coords;
	
	return $arr;
}
}

$getAreas = new GetAreas();
echo $getAreas->text;
?>