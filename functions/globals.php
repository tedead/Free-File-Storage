<?php

	if (!defined("BASE_PATH"))
	{
		define('BASE_PATH', isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : substr($_SERVER['PATH_TRANSLATED'],0, -1 * strlen($_SERVER['SCRIPT_NAME'])));
	}
?>