<?php

namespace Ucd\Raw;

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
		//var_dump(__METHOD__);

		return $this;
	}

	public function toArray()
	{
		return $this->_List->toArray();
	}

	protected $_List = null;
	public function getList()
	{
		return $this->_List;
	}

	protected $_Map = null;
	public function getMap()
	{
		return $this->_Map;
	}

	protected $_SourceFilePath = 'Source.txt';
	public function setSourceFilePath($val)
	{
		$this->_SourceFilePath = $val;
		return $this;
	}
	public function getSourceFilePath()
	{
		return $this->_SourceFilePath;
	}

} // End Class
