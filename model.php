<?php
require_once(dirname(__FILE__)."/config.php");

class model
{
	public function getJsonFile (string $filename, string $type = 'json')
	{
		return empty($filename) ? NULL : json_decode(file_get_contents($type.'/'.$filename.'.json'), true);
	}

	public function setLogFile (array $addLog = array())
	{
		$LogFileName = 'PTT_Steam_Log_'.date('Ymd');
		$LogFilePath = 'log/'.$LogFileName.'.json';
		$serverLog = array(
			'user_agent' => $_SERVER['HTTP_USER_AGENT'],
			'remote_addr' => $_SERVER['REMOTE_ADDR'],
			'remote_port' => $_SERVER['REMOTE_PORT'],
			'request_time_local' => date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']),
			'request_time_utc' => gmdate('Y-m-d H:i:s', $_SERVER['REQUEST_TIME'])
		);

		$newLog = array_merge($serverLog, $addLog);
		$oldLog = model::getJsonFile($LogFileName, 'log');
		if (empty($oldLog))
		{
			rename($LogFilePath, $LogFilePath.'.'.date('His').'.bad');
			$allLog = array();
		}

		$allLog = file_exists($LogFilePath) ? $oldLog : array();
		array_push($allLog, $newLog);

		$fp = fopen($LogFilePath, 'w');
		fwrite($fp, json_encode($allLog));
		fclose($fp);
	}
}
?>