<?php

namespace Demo\Reader;

class Base {

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
		if (!file_exists($this->_FilePath)) {
			echo('Source File Not Exists: ' . $this->_FilePath . PHP_EOL);
			return;
		}

		return true;
	}

	public function load()
	{
		if ($this->prep() === false) {
			return false;
		}

		$this->_Data = $this->parse();

		return true;
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
