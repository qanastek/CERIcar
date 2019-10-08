<?php

/**
* Controllers gérant les différentes routes
*/
class mainController
{

	public static function helloWorld($request,$context)
	{
		$context->mavariable = "hello world";
		return context::SUCCESS;
	}

	public static function index($request,$context)
	{		
		return context::SUCCESS;
	}

	public static function superTest($request,$context)
	{		
		$context->param1 = $_GET["param1"];
		$context->param2 = $_GET["param2"];

		$context->notification = "Tout c'est bien passé";
		$context->notification_status = "success";

		return context::SUCCESS;
	}

}
