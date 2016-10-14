#!/usr/bin/env php
<?php
	require_once(__DIR__ . '/Boot.php');

	\Demo\Converter\FromUdc\ToSourceGroupByBlock::newInstance()
		->setIsWithChar(true)
		->prep()
		->run()
	;

	return;
