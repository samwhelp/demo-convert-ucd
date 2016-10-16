<?php

namespace Demo\Converter\FromBlockSource;

class ToXml extends BaseDirWalk {

	protected $_SourceDirPath = THE_VAR_DIR_PATH . '/source';
	protected $_TargetDirPath = THE_VAR_DIR_PATH . '/xml';

	protected function runFile($file_path, $file_name, $dir_path)
	{
		////echo $file_path . PHP_EOL;

		$reader = \Demo\Reader\Source::newInstance()
			->setFilePath($file_path)
		;

		if ($reader->load() === false) {
			return fasle;
		}

		$data = $reader->getData();

		$target_file_path = $this->_TargetDirPath . '/' . $file_name . '.xml';

		$writer = \Demo\Writer\XmlXslt::newInstance()
			->setFilePath($target_file_path)
			->setData($data)
		;


		$writer->save();


		return true;
	}


} // End Class
