<?php

namespace Demo\Reader;

class Base {

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

	public function load()
	{
		if (!file_exists($this->_FilePath)) {
			echo('Source File Not Exists: ' . $this->_FilePath . PHP_EOL);
			return;
		}

		$this->_Data = $this->parse();

		return $this->_Data;
	}

	public function parse()
	{
		return '';
	}

	protected $_Data = array();
	public function setData($val)
	{
		$this->_Data = $val;
		return $this;
	}
	public function getData()
	{
		return $this->_Data;
	}

	protected $_FilePath = '';
	public function setFilePath($val)
	{
		$this->_FilePath = $val;
		return $this;
	}


} // End Class
