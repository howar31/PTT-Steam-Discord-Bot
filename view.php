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

	/**
	 * Get role avatar url and index
	 * @param  string   $roleName  role name
	 * @param  int|null $avatarNum different usage accroding to $isRandom
	 *                             if $isRandom is true, then $avatarNum means current avatar variation, get random but index is not $avatarNum
	 *                             if $isRandom is false, then $avatarNum means get that specific avatar which index is $avatarNum
	 * @param  bool     $isRandom  get random avatar or specific avatar
	 * @return array               return avatar url and index
	 */
	public function getAvatar(string $roleName, int $avatarNum = NULL, bool $isRandom = true)
	{
		$roles = view::getRoles();
		$avatar = array();
		if ($isRandom)
		{
			// get random
			$randomAvatar = model::getRandomValue($roles[$roleName][0]['avatar_url'], $avatarNum);
			$avatar['index'] = $randomAvatar['key'];
			$avatar['url'] = $randomAvatar['value'];
		} else {
			//get specific
			$avatar['index'] = $avatarNum;
			$avatar['url'] = $roles[$roleName][0]['avatar_url'][$avatarNum];
		}
		return $avatar;
	}
}
?>