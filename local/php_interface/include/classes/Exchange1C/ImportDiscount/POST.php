<?php
namespace Exchange1C\ImportDiscount;

use Bitrix\Main\UserTable;
use Bitrix\Main\UserGroupTable;


class POST extends \Exchange1C\ImportDiscount
{
	public $user;
	public $discount;
	public $userGroups;
	
	public function __construct($email, $discount=0)
	{
		if($this->user = UserTable::getList([
			'select'=>['*'],
			'filter'=>['EMAIL'=>$email]
		])->fetch())
		{
			$this->getUserGroups();
		}
		
		$this->discount = self::DISCOUNT_GROUP;
		
	}
	
	protected function getUserGroups()
	{
		$this->userGroups = UserGroupTable::getList([
			'select'=>['*'],
			'filter'=>['USER_ID'=>$this->user['ID']]
		])->fetchAll();
	}
	
	protected function setGroup()
	{
		
	}
	
	public function update()
	{
		
	}
}