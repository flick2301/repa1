<?php
namespace Exchange1C;


class NewCSaleOrderLoader extends \CSaleOrderLoader
{
    public function nodeHandler(\CDataXML $value, $fileStream)
    {
        $value_ar = $value->GetArray();
		$arAgentInfo = $this->collectAgentInfo($value_ar[GetMessage("CC_BSC1_AGENT")]["#"]);
		if(!empty($value_ar[GetMessage("CC_BSC1_DOCUMENT")]) || !ImportDiscount::isUserExist($arAgentInfo["AGENT"]["ID"]))
        {
            parent::nodeHandler($value, $fileStream); // это мне не надо было, пусть родитель мучается
			
			$value = $value_ar[GetMessage("CC_BSC1_AGENT")]["#"];
            $arAgentInfo = $this->collectAgentInfo($value);
			
			try
			{
				if($arAgentInfo["AGENT"]["OKPO_CODE"])
				{
					$user = new ImportDiscount($arAgentInfo["AGENT"]["ID"], $arAgentInfo["AGENT"]["OKPO_CODE"]);
				}
								
			}catch(ImportDiscount $exception)
			{
				echo $exception->getMessage();
			}
			// $arAgentInfo - вот тут у нас уже нормальные данные, прям тут можем их записывать в БД или еще чего нибудь
        }
        elseif($this->arParams["IMPORT_NEW_ORDERS"] == "Y")
        {
            $value = $value_ar[GetMessage("CC_BSC1_AGENT")]["#"];
            $arAgentInfo = $this->collectAgentInfo($value);
			
			try
			{
				$user = new ImportDiscount($arAgentInfo["AGENT"]["ID"], $arAgentInfo["AGENT"]["OKPO_CODE"]);
				/*ЭТО БЫЛО ТОЛЬКО ДЛЯ ТЕСТИРОВАНИЯ НА ИЗМЕНЕНИЯ ИНФОРМАЦИИ ПОЛЬЗОВАТЕЛЕЙ
				if($arAgentInfo["AGENT"]["CONTACT"]["PHONE"])
				{	
					\Bitrix\Main\Diag\Debug::dumpToFile($arAgentInfo, "", '/upload/1loader.txt');
					$user->changePhone($arAgentInfo["AGENT"]["CONTACT"]["PHONE"]);
				}
				*/
				
			}catch(ImportDiscount $exception)
			{
				echo $exception->getMessage();
			}
			// $arAgentInfo - вот тут у нас уже нормальные данные, прям тут можем их записывать в БД или еще чего нибудь
        }
    }
}