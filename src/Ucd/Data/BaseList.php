<?php

namespace Ucd\Data;

class BaseList {

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

	protected $_Raw = array();
	public function setRaw($val)
	{
		$this->_Raw = $val;
		return $this;
	}

	public function push($val)
	{
		array_push($this->_Raw, $val);
		return $this;
	}

	public function ref($key)
	{
		if (!array_key_exists($key, $this->_Raw)) {
			return '';
		}
		return $this->_Raw[$key];
	}

	public function toArray()
	{
		return $this->_Raw;
	}

} // End Class
