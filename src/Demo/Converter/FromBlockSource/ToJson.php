<?php

namespace Demo\Converter\FromBlockSource;

class ToJson extends BaseDirWalk {

	public function init()
	{
		$this->_SourceDirPath = THE_VAR_DIR_PATH . '/source';
		$this->_TargetDirPath = THE_VAR_DIR_PATH . '/json';

		$this->_Unicode = \Ucd\Mapping\Unicode::newInstance()
			->prep()
		;

		return $this;
	}

	protected function runFile($file_path, $file_name, $dir_path)
	{
		////echo $file_path . PHP_EOL;

		$reader = \Demo\Reader\Source::newInstance()
			->setFilePath($file_path)
			->prep()
		;

		//var_dump($reader->load());
		//var_dump($reader->getData());

		$data = $reader->load();

		$list = array();

		foreach ($data->toArray() as $num => $row) {
			//var_dump($row);
			$item = $row->toArray();

			if (array_key_exists('Char', $item) && array_key_exists('Hex', $item)) {
				$item['Char'] = $this->_Unicode->findChar_ByHex($item['Hex']);
			}

			array_push($list, $item);
		}

		$text = json_encode($list);
		$file = $this->_TargetDirPath . '/' . $file_name . '.json';

		if (!file_exists($this->_TargetDirPath)) {
			mkdir($this->_TargetDirPath, 0777, true);
		}
		file_put_contents($file, $text);

	}


} // End Class
