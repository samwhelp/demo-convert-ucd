#!/usr/bin/env php
<?php
	require_once(__DIR__ . '/Boot.php');

	\Demo\Converter\FromBlockSource\ToJson::newInstance()
		->prep()
		->run()
	;

	return;
