<?php

namespace Demo\Writer;

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

	public function save()
	{
		$rtn = $this->render();

		$this->prepSaveDirPath();

		file_put_contents($this->_FilePath, $rtn);

		return $rtn;
	}

	public function render()
	{
		return '';
	}

	protected $_Data = array();
	public function setData($val)
	{
		$this->_Data = $val;
		return $this;
	}

	protected $_FilePath = '';
	public function setFilePath($val)
	{
		$this->_FilePath = $val;
		return $this;
	}

	protected function prepSaveDirPath()
	{
		$dir = dirname($this->_FilePath);
		if (file_exists($dir)) {
			return;
		}
		mkdir($dir, 0777, true);
	}
} // End Class
