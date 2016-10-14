#!/usr/bin/env php
<?php
	require_once(__DIR__ . '/Boot.php');

	\Demo\Converter\FromBlockSource\ToXml::newInstance()
		->prep()
		->run()
	;

	return;
