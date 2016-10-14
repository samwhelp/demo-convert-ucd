<?php

namespace Demo\Converter\FromBlockSource;

class ToXml extends BaseDirWalk {

	public function init()
	{
		$this->_SourceDirPath = THE_VAR_DIR_PATH . '/source';
		$this->_TargetDirPath = THE_VAR_DIR_PATH . '/xml';

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

		$target_file_path = $this->_TargetDirPath . '/' . $file_name . '.xml';

		$writer = \Demo\Writer\XmlXslt::newInstance()
			->setFilePath($target_file_path)
			->setData($data)
			->prep()
		;


		$writer->save();

	}


} // End Class
