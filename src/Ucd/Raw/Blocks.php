<?php

namespace Ucd\Raw;

class Blocks extends Base {

	protected $_SourceFilePath = THE_ASSET_DIR_PATH . '/unicode/ucd/all/UCD/Blocks.txt';

	protected function prep()
	{

		if (!file_exists($this->_SourceFilePath)) {
			echo('Source File Not Exists: ' . $this->_SourceFilePath . PHP_EOL);
			return false;
		}

		return true;
	}

	public function load()
	{
		if ($this->prep() === false) {
			return false;
		}

		$lines = file($this->_SourceFilePath);

		$this->_List = \Ucd\Data\BaseList::newInstance();

		foreach ($lines as $num => $line) {
			$line = trim($line);

			if (!strlen($line)) {
				continue;
			}

			$first_char = substr($line, 0, 1);

			if ($first_char === '#') {
				continue;
			}

			$item = $this->parseLine($line);

			$this->_List->push($item);
		}

		return true;
	}

	protected function parseLine($line)
	{
		$rtn = \Ucd\Data\Raw\BlocksItem::newInstance();

		$test = strpos($line, ';');

		if ($test === false) {
			return $rtn;
		}

		$range_str = substr($line, 0, $test);
		$range = explode('..', $range_str, 2);

		$size = count($range);

		if ($size <2) {
			return $rtn;
		}

		$rtn->put('start', $range[0]);
		$rtn->put('end', $range[1]);

		$name = substr($line, $test+2);

		$rtn->put('name', $name);

		return $rtn;
	}
} // End Class
