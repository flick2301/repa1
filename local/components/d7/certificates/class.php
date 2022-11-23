<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc,
    Bitrix\Iblock\ElementTable,
    Bitrix\Iblock;

	use Bitrix\Main\Application,
    Bitrix\Main\Context,
    Bitrix\Main\Request,
    Bitrix\Main\Server;




/**
 * @var $APPLICATION CMain
 * @var $USER CUser
 */

Loc::loadMessages(__FILE__);

if (!Loader::includeModule("iblock"))
{

	return;
}

class classCertificates extends CBitrixComponent
{
    public function executeComponent()
	{
		global $APPLICATION;

		$context = Application::getInstance()->getContext();
		$server = $context->getServer();
		$arFolder = explode("/", $server->getRequestUri());
		array_pop($arFolder);
		array_pop($arFolder);
		if(!empty($arFolder[1]))
			$folder = implode("/", $arFolder);
		else
			$folder = $this->arParams["SEF_FOLDER"];





	    $arDefaultUrlTemplates404 = array(
	       "sections" => "",
		   "items" => "#SECTION_CODE_PATH#/",
        );

        $arComponentVariables = array(
	      "SECTION_ID",
	      "SECTION_CODE",
        );

        if($this->arParams["SEF_MODE"] == "Y")
        {

			$arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $this->arParams["SEF_URL_TEMPLATES"]);

	        $arVariables = array();

	        /*$componentPage = CComponentEngine::ParseComponentPath(
				$folder."/",
				$arUrlTemplates,
				$arVariables
			);*/

			$engine = new CComponentEngine($this);
			$engine->addGreedyPart("#SECTION_CODE_PATH#");
			$engine->addGreedyPart("#SMART_FILTER_PATH#");
			$engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
			$componentPage = $engine->guessComponentPath(
				$this->arParams["SEF_FOLDER"],
				$arUrlTemplates,
				$arVariables
			);


			$b404 = false;

	        if(!$componentPage)
	        {
				$componentPage = "sections";
				$b404 = true;
	        }



	        $this->arResult = array(
				"FOLDER" => $this->arParams["SEF_FOLDER"],
				"URL_TEMPLATES" => $arUrlTemplates,
				"VARIABLES" => $arVariables,
                "VARS" => $componentPage
                );

        }
        else
        {
	        $arVariables = array();

	        $arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases, $this->arParams["VARIABLE_ALIASES"]);
	        CComponentEngine::InitComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

			$componentPage = "";

	        if(isset($arVariables["SECTION_ID"]) && intval($arVariables["SECTION_ID"]) > 0)
				$componentPage = "items";
	        elseif(isset($arVariables["SECTION_CODE"]) && strlen($arVariables["SECTION_CODE"]) > 0)
				$componentPage = "items";
			else
				$componentPage = "sections";
            global $APPLICATION;

            $this->arResult = array(
				"FOLDER" => "",
				"URL_TEMPLATES" => Array(
					"sections" => htmlspecialcharsbx($APPLICATION->GetCurPage()),
					"items" => htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arVariableAliases["SECTION_ID"]."=#SECTION_ID#"),
				),
				"VARIABLES" => $arVariables,
	        );
        }



		//ЕСЛИ ЧПУ ВЫКЛЮЧЕН
		if ($this->arResult['VARIABLES']['SECTION_ID'] && $this->arParams['ADD_SECTIONS_CHAIN'])
		{

			$this->arResult['PATH'] = array();
			$pathIterator = CIBlockSection::GetNavChain(
				$this->arParams['IBLOCK_ID'],
				$this->arResult['VARIABLES']['SECTION_ID'],
				array(
						'ID', 'CODE', 'XML_ID', 'EXTERNAL_ID', 'IBLOCK_ID',
						'IBLOCK_SECTION_ID', 'SORT', 'NAME', 'ACTIVE',
						'DEPTH_LEVEL', 'SECTION_PAGE_URL'
				)
			);
			$pathIterator->SetUrlTemplates('', $this->arParams['SECTION_URL']);
			while ($path = $pathIterator->GetNext())
			{
				$ipropValues = new Iblock\InheritedProperty\SectionValues($this->arParams['IBLOCK_ID'], $path['ID']);
				$path['IPROPERTY_VALUES'] = $ipropValues->getValues();
				$this->arResult['PATH'][] = $path;
			}
		}

        //ЕСЛИ С ЧПУ
        if($componentPage=='items')
		{
			if($this->arResult['VARIABLES']["SECTION_ID"]){

				$arFilter = array('IBLOCK_ID' => $this->arParams['IBLOCK_ID'], "ID"=>$this->arResult['VARIABLES']["SECTION_ID"]);
				$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter, false, array("*", "UF_*"));

				if($arSection = $rsSections->GetNext())
				{

					 $this->arResult['SECTION']= $arSection;
					$ipropValues = new Iblock\InheritedProperty\SectionValues($this->arParams['IBLOCK_ID'], $arSection['ID']);
					$this->arResult['IPROP_VALUES'] = $ipropValues->getValues();

					$arSelect = Array("*");
					$arFilter = Array("IBLOCK_ID"=>$this->arParams['IBLOCK_ID'], "SECTION_ID"=>$this->arResult['SECTION']['ID']);
					$res =CIBlockSection::GetList(Array(), $arFilter);
					while ($sect = $res->GetNext())
						{

								$this->arResult['SECTIONS'][] = $sect;


						}

					$arSelect = Array("*");
					$arFilter = Array("IBLOCK_ID"=>$this->arParams['IBLOCK_ID'], "SECTION_ID"=>$this->arResult['VARIABLES']["SECTION_ID"]);
					$res = CIBlockElement::GetList(Array(), $arFilter, false, array(), $arSelect);
					while($ob = $res->GetNextElement())
					{
						$arFields = $ob->GetFields();
						$arProperties = $ob->GetProperties();
						$arItem = $arFields;
						$arItem['PROPERTIES'] = $arProperties;
						$this->arResult['ITEMS'][]=$arItem;
					}
				}else{
					\Bitrix\Iblock\Component\Tools::process404(
						""
						,($this->arParams["SET_STATUS_404"] === "Y")
						,($this->arParams["SET_STATUS_404"] === "Y")
						,($this->arParams["SHOW_404"] === "Y")
						,$this->arParams["FILE_404"]
					);
				}
			} else {
				\Bitrix\Iblock\Component\Tools::process404(
					""
					,($this->arParams["SET_STATUS_404"] === "Y")
					,($this->arParams["SET_STATUS_404"] === "Y")
					,($this->arParams["SHOW_404"] === "Y")
					,$this->arParams["FILE_404"]
				);
			}
        }else{
			$arFilter = array('IBLOCK_ID' => $this->arParams['IBLOCK_ID'], 'TOP_DEPTH'=>0);
			$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter);
			while ($arSection = $rsSections->GetNext())
			{
				if($arSection['DEPTH_LEVEL']==1)
					$this->arResult['SECTIONS'][] = $arSection;

			}
		}

		$this->IncludeComponentTemplate($componentPage);
    }
}
?>
