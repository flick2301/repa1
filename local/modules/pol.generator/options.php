<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/pol.generator/prolog.php");
$moduleMode = \CModule::IncludeModuleEx(ADMIN_MODULE_NAME);
IncludeModuleLangFile(__FILE__);
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Pol\Generator\Rules\RulesTable;

if (!Loader::includeModule('iblock'))
    return;

if (!Loader::includeModule('pol.generator'))
    return;

if (!$moduleMode){
    echo GetMessage("MODULE_IS_NOT_INSTALL");
    return;
}

$TAGS_RIGHT = $APPLICATION->GetGroupRight(ADMIN_MODULE_NAME);
if ($TAGS_RIGHT == "D")
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

$aTabs = array(
    array("DIV" => "edit1", "TAB" => "Генерация мета-данных", "ICON"=>"", "TITLE"=>"Генерация мета-данных"),
);

$context = \Bitrix\Main\Application::getInstance()->getContext();
$request = $context->getRequest();

if($request->get('generation') == 'on')
    {
   
    	if($request->get('iblock') && $request->get('section') && $request->get('id_template') && $request->get('id_keys'))
        {
            ?>
            <script>alert('Генерация прошла успешно!');</script>
            
            <?
            
            $rsData = Pol\Generator\Generation::gen1($request->get('iblock'), $request->get('section'), $request->get('id_template'), $request->get('id_keys'), $request->get('rules'), $request->get('empty_rules'));
		
	}else{
            ?>
            <script>alert('Что-то пошло не так! Проверьте заполнено ли поле ID BLOCK!');</script>
            <?	
	}
    }
	
	

$tabControl = new CAdminTabControl("tabControl", $aTabs);
//-----------------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>
<?$tabControl->Begin();?>
<?$tabControl->BeginNextTab();?>
        
<?$deph_level=array('', '', ' . ',' . . ',' . . . ',' . . . . ',' . . . . . ');?>
            
<form method="POST" action="<?echo $APPLICATION->GetCurPage()?>?lang=ru&mid=pol.generator&mid_menu=1" ENCTYPE="multipart/form-data" name="post_form1">
    <?echo bitrix_sessid_post();?>
    <input type="hidden" name="lang" value="<?=LANG?>">
    <input type="hidden" name="generation" value="on">
    
    <p>IBLOCK ID:</p>
    <select multiple size="2" name="iblock">
    <?
    $res = CIBlock::GetList(Array(), Array('TYPE'=>'catalog'), true);
    while($ar_res = $res->Fetch())
    {?>
        <option value="<?=$ar_res['ID']?>"><?=$ar_res['NAME']?> [<?=$ar_res['ID']?>]</option>
    <?}?>
    </select>
    
    <br><br>
    <p>ID Секции для обработки:</p>
    <select multiple size="15" name="section">
    <?
    $dbIBlockType = CIBlockSection::GetList(array('left_margin' => 'ASC'), array('IBLOCK_ID'=>CATALOG_IBLOCK_ID));
    while ($arIBlockType = $dbIBlockType->GetNext())
    {?>
        <option value="<?=$arIBlockType['ID']?>"><?=$deph_level[$arIBlockType['DEPTH_LEVEL']]?><?=$arIBlockType['NAME']?> [<?=$arIBlockType['ID']?>]</option><?
    }?>
    </select>
                    
    <br><br>
    <p>Поля для абработки:</p>
    <select multiple="multiple" size="12" name="rules[]">
    <?
    
    
    
    $arResRules = RulesTable::getList();
    $arRule = $arResRules->fetch();
    foreach($arRule as $key=>$value)
    {
        if($key!='ID' && $key!='ID_SECTION' && $key!='NAME'){?>
            <option value="<?=$key?>"><?=GetMessage($key);?>[<?=$key?>]</option><?
        }
    }?>
    </select>       
    
    <br><br>
    <p>Заполнять только пустые поля</p>
    <input type="checkbox" name="empty_rules" value="Y" />
		
    <br><br>
    
    <p>ID Шаблона генерации:</p>
    <select multiple size="5" name="id_template">
        <?$rules = \Pol\Generator\Rules\RulesTable::getList(array(
            'select' => array('*'),
	));
	while ($rule_row = $rules->Fetch()){?>
            <option value="<?=$rule_row['ID_SECTION']?>"><?=$rule_row['NAME']?> [<?=$rule_row['ID_SECTION']?>]</option><?
        }?>
    </select>
		
		<br><br>
                <p>ID Шаблона ключей:</p>
                
		<input type="text" name="id_keys" value="" size="20">
		<br><br>
	
	<input type="submit"  value="Cгенерировать мета-данные">
	  
</form>
<br>
<br>
<form method="POST" action="<?echo $APPLICATION->GetCurPage()?>?lang=ru&mid=pol.generator&mid_menu=1" ENCTYPE="multipart/form-data" name="post_form2">
	<?echo bitrix_sessid_post();?>
	<input type="hidden" name="lang" value="<?=LANG?>">
	<input type="hidden" name="generation" value="off">
	<input type="submit"  value="Очистить мета-данные">
</form>
<?$tabControl->End();?>
<?$tabControl->ShowWarnings("post_form", $message);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>
