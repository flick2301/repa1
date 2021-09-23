<?php

namespace Exchange1C;

abstract class ImportDiscount
{
	const DISCOUNT_GROUP = [5=>11, 10=>12, 15=>13];
	
	abstract protected function getUserGroups();
	
	abstract protected function setGroup();
	
	abstract public function update();
	
	public static function getIdGroupFromDiscount($discount)
	{
		return self::DISCOUNT_GROUP[$discount];
	}
}