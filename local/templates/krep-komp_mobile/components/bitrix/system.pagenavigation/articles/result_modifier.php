<?php

use \Bitrix\Main\Application;

$app = Application::getInstance();
$context = $app->getContext();
$request = $context->getRequest();

$arParams["NAV_RESULT"]->NavNum = 1;
$arResult["NavNum"]=1;

if($request->get('SIZEN_1') && $arResult["NavQueryString"])
	$arResult["NavQueryString"] = $arResult["NavQueryString"].'&SIZEN_1='.$request->get('SIZEN_1');
elseif($request->get('SIZEN_1'))
	$arResult["NavQueryString"] = $arResult["NavQueryString"].'SIZEN_1='.$request->get('SIZEN_1');
