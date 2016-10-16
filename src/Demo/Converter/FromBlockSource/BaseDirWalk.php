<?php

namespace Demo\Converter\FromBlockSource;

abstract class BaseDirWalk extends Base {

	public function run()
	{
		$this->runDir($this->_SourceDirPath);
	}

	protected function runDir($dir_path)
	{
		//http://php.net/manual/en/function.opendir.php
		if (!is_dir($dir_path)) {
			return;
		}

		if ($dh = opendir($dir_path)) {
			while (($file_name = readdir($dh)) !== false) {
				if ($file_name == '.' || $file_name == '..' ) {
					continue;
				}
				$file_path = $dir_path . '/' . $file_name;

				////echo $file_path . PHP_EOL;

				if (is_dir($file_path)) {
					$this->runDir($file_path);
				} else {
					$this->runFile($file_path, $file_name, $dir_path);
				}
			}
			closedir($dh);
		}

		return;

	}

	protected function runFile($file_path, $file_name, $dir_path)
	{
		////echo $file_path . PHP_EOL;
	}


} // End Class
