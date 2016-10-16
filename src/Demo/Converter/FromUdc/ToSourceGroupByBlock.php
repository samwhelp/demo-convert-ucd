<?php

namespace Demo\Converter\FromUdc;

class ToSourceGroupByBlock extends Base {

	protected $_Unicode = null;
	protected $_Block = null;
	protected $_UnicodeData = null;

	public function prep()
	{
		if ($this->_IsWithChar) {
			$this->_TargetDirPath = THE_VAR_DIR_PATH . '/source-with-char';
		} else {
			$this->_TargetDirPath = THE_VAR_DIR_PATH . '/source';
		}

		if ($this->_Unicode === null) {
			$this->_Unicode = \Ucd\Mapping\Unicode::newInstance();
		}

		if ($this->_Block === null) {
			$this->_Block = \Ucd\Raw\Blocks::newInstance();
		}

		if ($this->_UnicodeData === null) {
			$this->_UnicodeData = \Ucd\Raw\UnicodeData::newInstance();
		}

		if (file_exists($this->_TargetDirPath)) {
			echo 'Source Dir Exist: ' . $this->_TargetDirPath . PHP_EOL;
			echo 'Please remove or move it first.' . PHP_EOL;
			return false;
		}

		$this->prepSaveDirPath();

		return true;
	}

	public function run()
	{

		if ($this->prep() === false) {
			return false;
		}

		$this->_Block->load();
		$this->_UnicodeData->load();


		foreach ($this->_Block->toArray() as $idx => $item) {
			$file = $this->_TargetDirPath . '/' . $this->findSaveFileName($item, $idx+1);
			$text = $this->findSaveContent($item, $idx+1);
			file_put_contents($file, $text);
		}


		return $this;
	}



	protected function findSaveContent($item, $idx)
	{
		$start_hex = $item->ref('start');
		$end_hex = $item->ref('end');
		$start_dec = $this->_Unicode->findDec_ByHex($start_hex);
		$end_dec = $this->_Unicode->findDec_ByHex($end_hex);

		$rtn = '';

		foreach(range($start_dec, $end_dec) as $dec) {
			$hex = $this->_Unicode->findHex_ByDec($dec);


			$rtn .= $this->makeColumnLine('Hex', $this->_Unicode->uniformHex($hex));
			$rtn .= $this->makeColumnLine('Dec', $this->_Unicode->uniformDec($dec));

			if ($this->_IsWithChar) {
				$rtn .= $this->makeColumnLine('Char', $this->_Unicode->findChar_ByDec($dec) . '  ');
			}

			$rtn .= $this->makeColumnLine('Name', $this->findUnicodeItem_Name($hex));
			$rtn .= $this->makeColumnLine('Name-zh_TW', '');
			$rtn .= $this->makeColumnLine('Comment', '');

			$rtn .= PHP_EOL;
		}

		return $rtn;
	}

	protected function findSaveFileName($item, $idx)
	{
		$rtn = '';
		$rtn .= sprintf("%04d", $idx);
		$rtn .= '-';
		$rtn .= $item->ref('start');
		$rtn .= '-';
		$rtn .= $item->ref('end');
		$rtn .= '-';
		$rtn .= $item->ref('name');
		$rtn .= '.txt';
		return $rtn;
	}

	protected function prepSaveDirPath()
	{
		$dir = $this->_TargetDirPath;
		if (file_exists($dir)) {
			return true;
		}

		mkdir($dir, 0777, true);

		return true;
	}

	protected function makeColumnLine($key, $val)
	{
		$rtn = '';
		$rtn .= $key;
		$rtn .= ': ';
		$rtn .= $val;
		$rtn .= PHP_EOL;
		return $rtn;
	}

	protected function findUnicodeItem_Name($hex)
	{
		$item = $this->findUnicodeItem($hex);

		if (!$item) {
			return '';
		}

		return $item->ref(1);
	}

	protected function findUnicodeItem($hex)
	{
		$hex = $this->_Unicode->uniformHex($hex);
		$map = $this->_UnicodeData->getMap();
		$item = $map->ref(strtoupper($hex));
		return $item;
	}

	protected $_IsWithChar = false;
	public function setIsWithChar($val)
	{
		$this->_IsWithChar = $val;
		return $this;
	}

} // End Class
