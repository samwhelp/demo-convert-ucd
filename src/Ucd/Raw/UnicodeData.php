<?php

namespace Ucd\Raw;

class UnicodeData extends Base {

	protected $_SourceFilePath = THE_ASSET_DIR_PATH . '/unicode/ucd/all/UCD/UnicodeData.txt';

	public function load()
	{
		if (!file_exists($this->_SourceFilePath)) {
			echo('Source File Not Exists: ' . $this->_SourceFilePath . PHP_EOL);
			return;
		}

		$this->_Unicode = \Ucd\Mapping\Unicode::newInstance();

		$lines = file($this->_SourceFilePath);

		$this->_List = \Ucd\Data\BaseList::newInstance();
		$this->_Map = \Ucd\Data\BaseMap::newInstance();

		foreach ($lines as $num => $line) {
			$line = trim($line);

			if (!strlen($line)) {
				continue;
			}

			$item = $this->parseLine($line);

			$this->_List->push($item);

			$this->_Map->put($item->ref(0), $item);
		}

		return $this;
	}

	protected function parseLine($line)
	{
		$rtn = \Ucd\Data\Raw\UnicodeDataItem::newInstance();
		$list = explode(';', $line);
		$rtn->setRaw($list);
		return $rtn;
	}
} // End Class
