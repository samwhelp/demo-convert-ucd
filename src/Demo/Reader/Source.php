<?php

namespace Demo\Reader;

class Source extends Base {

	public function parse()
	{
		$lines = file($this->_FilePath);

		$flag = 'start';
		$sub_flag = 'start'; //allow multiple empty lines

		$list = \Ucd\Data\BaseList::newInstance();

		foreach($lines as $num => $line_raw) {
			$line = trim($line_raw);
			//echo $line . PHP_EOL;

			if ($flag === 'start') {
				if ($sub_flag === 'start') {
					$item = \Ucd\Data\BaseMap::newInstance();
					$list->push($item);
					$sub_flag = 'running';
				}
			}

			$size = strlen($line);
			if ($size == 0) {
				$flag = 'start';
				continue;
			} else {
				$flag = 'item';
				$sub_flag = 'start';
			}

			$col = $this->parseLine($line, $line_raw);

			if ($col === false) {
				continue;
			}

			$item->put($col['key'], $col['val']);


		}

		//var_dump(count($list->toArray()));
		return $list;
	}

	protected function parseLine($line, $line_raw)
	{
		$rtn = array();
		//$rtn['key'] = '';
		//$rtn['val'] = '';

		$test = strpos($line, ':');

		if ($test === false) {
			return false;
		}

		$key = substr($line, 0, $test);

		if (strtolower($key) == 'char') {
			return $this->parseLine_Char($line_raw);
		}

		$val = substr($line, $test+2);

		$rtn['key'] = trim($key);
		$rtn['val'] = $val;

		return $rtn;
	}

	protected function parseLine_Char($line)
	{
		$rtn = array();
		//$rtn['key'] = '';
		//$rtn['val'] = '';

		$test = strpos($line, ':');

		if ($test === false) {
			return false;
		}

		$key = substr($line, 0, $test);

		$val = substr($line, $test+2);

		$rtn['key'] = trim($key);
		$rtn['val'] = '' . $val;

		return $rtn;
	}

} // End Class
