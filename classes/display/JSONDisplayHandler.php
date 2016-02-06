<?php
/* Copyright (C) NAVER <http://www.navercorp.com> */

class JSONDisplayHandler
{

	/**
	 * Produce JSON compliant content given a module object.\n
	 * @param ModuleObject $oModule the module object
	 * @return string
	 */
	public function toDoc($oModule)
	{
		$variables = $oModule->getVariables();
		$variables['error'] = $oModule->getError();
		$variables['message'] = $oModule->getMessage();
		
		if (Context::getRequestMethod() === 'XMLRPC')
		{
			$temp = array();
			foreach ($variables as $key => $value)
			{
				if (self::_isNumericArray($value))
				{
					$temp[$key] = array_values($value);
				}
				else
				{
					$temp[$key] = $value;
				}
			}
			$variables = $temp;
		}
		
		return json_encode($variables);
	}
	
	/**
	 * Check if an array only has numeric keys.
	 * 
	 * @param array $array
	 * @return bool
	 */
	protected static function _isNumericArray($array)
	{
		if (!is_array($array) || !count($array))
		{
			return false;
		}
		foreach ($array as $key => $value)
		{
			if (intval($key) != $key)
			{
				return false;
			}
		}
		return true;
	}
}
/* End of file JSONDisplayHandler.class.php */
/* Location: ./classes/display/JSONDisplayHandler.class.php */
