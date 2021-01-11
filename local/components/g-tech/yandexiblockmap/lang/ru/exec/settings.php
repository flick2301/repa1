<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_js.php");

//if(!$USER->IsAdmin())
//	$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

$obJSPopup = new CJSPopup('',
	array(
		'TITLE' => GetMessage('MYMV_SET_POPUP_TITLE'),
		'SUFFIX' => 'yandex_map',
		'ARGS' => ''
	)
);

$arData = array();
if ($_REQUEST['MAP_DATA'])
{
	CUtil::JSPostUnescape();

	if (CheckSerializedData($_REQUEST['MAP_DATA']))
	{
		$arData = unserialize($_REQUEST['MAP_DATA']);

		if (is_array($arData) && is_array($arData['PLACEMARKS']) && ($cnt = count($arData['PLACEMARKS'])))
		{
			for ($i = 0; $i < $cnt; $i++)
			{
				$arData['PLACEMARKS'][$i]['TEXT'] = str_replace('###RN###', "\r\n", $arData['PLACEMARKS'][$i]['TEXT']);
			}
		}
	}
}

$arTemplateName = Array(
    "plain#lightbluePoint" => "lightblue",
    "plain#bluePoint" => "blue",
    "plain#darkbluePoint" => "darkblue",
    "plain#nightPoint" => "night",
    "plain#whitePoint" => "white",
    "plain#yellowPoint" => "yellow",
    "plain#orangePoint" => "orange",
    "plain#darkorangePoint" => "darkorange",
    "plain#redPoint" => "red",
    "plain#brownPoint" => "brown",
    "plain#greenPoint" => "green",
    "plain#darkgreenPoint" => "darkgreen",
    "plain#pinkPoint" => "pink",
    "plain#violetPoint" => "violet",
    "plain#greyPoint" => "grey",
    "plain#blackPoint" => "black",
);

?>
<script type="text/javascript">
BX.loadCSS('/bitrix/components/g-tech/yandexiblockmap/settings/settings.css');
</script>

<h2>Список стилей</h2>

<table xmlns="http://www.w3.org/1999/xhtml" class="table" cellpadding="5" cellspacing="0" border="1" width="100%">

            <tr valign="top">
              <th colname="col1" align="center">&nbsp;</th>
              <th colname="col2" align="center">Вид значка без содержимого</th>
              <th colname="col3" align="center">Вид значка с содержимым</th>
            </tr>
          <tbody>
            <tr>
              <td align="center"><input type="radio" name="template" value=""></td>
              <td colspan="2" align="center">Стиль по умолчанию</td>
            </tr>
          <?foreach($arTemplateName as $key => $template):?>
            <tr valign="top">
              <td align="center" valign="middle">
                <input type="radio" name="template" value="<?=$key?>">
              </td>
              <td align="center" width="" colname="col1">
                <img xmlns:lego="https://lego.yandex-team.ru" xmlns:dev="http://dev.yandex.ru/xmlns" alt="" src="http://api-maps.yandex.ru/i/0.4/plainstyle/placemarks/<?=$template?>.png"></img>
              </td>
              <td align="center" width="" colname="col3">
                <img src="/bitrix/components/g-tech/yandexiblockmap/settings/images/<?=$template?>.png">
              </td>
            </tr>
          <?endforeach;?>
          </tbody>
</table>

<h3>Внешний вид балуна и всплывающей подсказки будет также изменён при применении данных стилей:</h3>

      <table xmlns="http://www.w3.org/1999/xhtml" class="table" cellpadding="5" cellspacing="0" border="1" width="100%">
            <tr valign="top">
              <th colname="col1" align="center">Название объекта</th>
              <th colname="col2" align="center">Внешний вид</th>
            </tr>
          <tbody><tr valign="middle">

              <td width="" align="center" colname="col1">Балун</td>
              <td width="" align="center" colname="col2">
                <img xmlns:lego="https://lego.yandex-team.ru" xmlns:dev="http://dev.yandex.ru/xmlns" alt="" src="/bitrix/components/g-tech/yandexiblockmap/settings/images/balloon.png"></img>
              </td>
            </tr><tr valign="top">
              <td width="" align="center" colname="col1">Всплывающая подсказка</td>

              <td width="" align="center" colname="col2">
                <img xmlns:lego="https://lego.yandex-team.ru" xmlns:dev="http://dev.yandex.ru/xmlns" alt="" src="/bitrix/components/g-tech/yandexiblockmap/settings/images/hint.png"></img>
              </td>
            </tr></tbody>
      </table>


<script type="text/javascript">
function getTemplate(){
  var radioButtons = document.getElementsByName("template");
  //alert(radioButtons.length);
  for (var x = 0; x < radioButtons.length; x ++) {
    //
    if(radioButtons[x].checked){
        //alert(x+" value = "+radioButtons[x].value);
        window.jsYandexCEOpener.saveData(radioButtons[x].value);
        return false;
    }
  }
  //alert(temp[0].value);
  return false;
}
</script>
          <?
$obJSPopup->StartButtons();
?>
<input type="submit" value="Save" onclick="getTemplate();"/>
<?
$obJSPopup->ShowStandardButtons(array('cancel'));
$obJSPopup->EndButtons();
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin_js.php");?>