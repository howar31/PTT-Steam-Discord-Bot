<?php
require_once(dirname(__FILE__)."/model.php");

class view
{
	public function getRoles()
	{
		return model::getJsonFile('roles');
	}

	public function getLogFileList()
	{
		$logFileList = array();
		if ($handle = opendir(dirname(__FILE__).'/log/')) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					preg_match('/PTT_Steam_Log_(.*).json/', $entry, $matches);
					array_push($logFileList, $matches[1]);
				}
			}
			closedir($handle);
		}
		$logFileList = array_reverse($logFileList);
		return $logFileList;
	}
}
?>