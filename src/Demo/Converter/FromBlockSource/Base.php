<?php

namespace Demo\Converter\FromBlockSource;

abstract class Base {

	public static function newInstance()
	{
		//http://php.net/manual/en/language.oop5.late-static-bindings.php
        return new static();
	}

	public function __construct()
	{
		//http://php.net/manual/en/language.oop5.decon.php
		$this->init();
	}

	protected function init()
	{
		return true;
	}

	protected function prep()
	{
		return true;
	}

	public function run()
	{
		//var_dump(__METHOD__);

		if ($this->prep() === false) {
			return false;
		}

		return true;
	}

	protected $_Reader = null;
	protected $_Writer = null;

	protected $_SourceFilePath = 'source.txt';
	protected $_TargetFilePath = 'target.txt';

	protected $_SourceDirPath = __DIR__;
	protected $_TargetDirPath = __DIR__;


} // End Class
