<?php

namespace Exchange1C;

use Bitrix\Main\UserTable;
use Bitrix\Main\UserGroupTable;

class ImportDiscount
{
	const DISCOUNT_GROUP = [5=>11, 10=>12, 15=>13, 20=>14];
	
	public $user;
	public $discount;
	public $userGroups;
	
	public function __construct($xml_id, $discount=0)
	{
		$this->discount = $discount;
		
		if($this->user = UserTable::getList([
			'select'=>['*'],
			'filter'=>['XML_ID'=>$xml_id]
		])->fetch())
		{
			$this->getUserGroups();
			
			$this->deleteGroups();
			if($this->discount > 0)
			{
				
				$this->setGroup();
			}
		}else
		{
			throw new \Exception('Пользователь '.$email.' не найден!');
		}
		
		
	}
	
	public static function isUserExist($xml_id)
	{
		if(UserTable::getList([
			'select'=>['*'],
			'filter'=>['XML_ID'=>$xml_id]
		])->fetch())
		{
			return true;
		}else
		{
			return false;
		}
		
	}
	
	public function changePhone($phone)
	{
		if($this->user)
		{	
			$user = new \CUser;
			$user->Update($this->user['ID'], array('WORK_PHONE' => $phone));
			$strError .= $user->LAST_ERROR;
		}
	}
	
	protected function getUserGroups()
	{
		$this->userGroups = UserGroupTable::getList([
			'select'=>['*'],
			'filter'=>['USER_ID'=>$this->user['ID']]
		])->fetchCollection();
	}
	
	protected function setGroup()
	{
		$result = UserGroupTable::add([
			"USER_ID"=>$this->user["ID"],
			"GROUP_ID"=>self::DISCOUNT_GROUP[$this->discount]
		]);
	}
	
	protected function deleteGroups()
	{
		foreach($this->userGroups as $group)
		{
			$id_group = $group->get('GROUP_ID');
			if(in_array($id_group, self::DISCOUNT_GROUP))
			{
				$group->delete();
				
			}
		}
	}
	
		
}