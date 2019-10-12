<?php
namespace Pol\Generator\Logs;

class Base{
	protected static $keys = array();

	public static function add($fields){}
	public static function update($code,$fields){}
	public static function delete($codes = array()){}
	public static function getList($codes = array()){}
	public static function addGroup($keys){}
	protected function validateFields($key){}
}