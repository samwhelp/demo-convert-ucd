#!/usr/bin/env php
<?php
	require_once(__DIR__ . '/Boot.php');

	$raw = \Ucd\Raw\UnicodeData::newInstance();

	$raw->load();

	//var_dump($raw->toArray());
	var_dump($raw->getMap()->toArray());

	return;

	$raw = \Ucd\Raw\Blocks::newInstance();

	$raw->load();

	var_dump($raw->toArray());

	return;


	$file_path = THE_VAR_DIR_PATH . '/source/0001-0000-007F-Basic Latin.txt';
	$reader = \Demo\Reader\Source::newInstance()
		->setFilePath($file_path)
		->prep()
	;

	//var_dump($reader->load());
	//var_dump($reader->getData());

	$data = $reader->load();

	var_dump($data);


	return;

	\Demo\Converter\FromUdc\ToSourceGroupByBlock::newInstance()
		->prep()
		->run()
	;

	return;
