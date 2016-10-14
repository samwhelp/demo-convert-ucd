<?php

namespace Demo\Converter\FromBlockSource;

class Base {

	protected $_Reader = null;
	protected $_Writer = null;

	protected $_Sheet = null;

	protected $_SourceFilePath = 'source.txt';
	protected $_TargetFilePath = 'target.txt';
	protected $_SourceDirPath = __DIR__;
	protected $_TargetDirPath = __DIR__;

	public static function newInstance()
	{
		return new static(); //http://php.net/manual/en/language.oop5.late-static-bindings.php
	}

	public function __construct()
	{
		$this->init();
	}

	public function init()
	{

		return $this;
	}

	public function prep()
	{

		return $this;
	}

	public function run()
	{
		//var_dump(__METHOD__);

		return $this;
	}


} // End Class
