#!/usr/bin/env php
<?php
	require_once(__DIR__ . '/Boot.php');

	\Demo\Converter\FromUdc\ToSourceGroupByBlock::newInstance()
		->prep()
		->run()
	;

	return;
