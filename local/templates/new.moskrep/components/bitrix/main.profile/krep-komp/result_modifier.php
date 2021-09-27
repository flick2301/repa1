<?
use Bitrix\Main\Loader; 

Loader::includeModule("highloadblock"); 

use Bitrix\Highloadblock as HL; 
use Bitrix\Main\Entity;

$hlbl = 9; // Указываем ID нашего highloadblock блока к которому будет делать запросы.
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch(); 

$entity = HL\HighloadBlockTable::compileEntity($hlblock); 
$entity_data_class = $entity->getDataClass();

$arResult["arUser"]['PERSONAL_MANAGER'] = $entity_data_class::getList(['filter'=>['ID'=>$arResult["arUser"]["UF_PERSONAL_MANAGER"][0]]])->fetch();