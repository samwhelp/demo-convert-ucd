#!/usr/bin/env php
<?php
	require_once(__DIR__ . '/Boot.php');

	\Demo\Converter\FromBlockSource\ToHtml::newInstance()
		->prep()
		->run()
	;

	return;
