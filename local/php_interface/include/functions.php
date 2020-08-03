<?

//Напишем функцию получения экземпляра класса:
function GetEntityDataClass($HlBlockId) {
	//подключаем модуль highloadblock
CModule::IncludeModule('highloadblock');
    if (empty($HlBlockId) || $HlBlockId < 1)
    {
        return false;
    }
    $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($HlBlockId)->fetch();   
    $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}

?>