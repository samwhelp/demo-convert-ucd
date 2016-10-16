<?php

namespace Demo\Writer;

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
		return true;
	}

	public function save()
	{
		if ($this->prep() === false) {
			return false;
		}

		$rtn = $this->render();

		$this->prepSaveDirPath();

		file_put_contents($this->_FilePath, $rtn);

		return true;
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
