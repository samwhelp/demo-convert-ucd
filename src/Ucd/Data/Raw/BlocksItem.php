<?php

namespace Ucd\Data\Raw;

class BlocksItem extends \Ucd\Data\BaseMap {

	public function init()
	{

		$this->_Raw['name'] = '';
		$this->_Raw['start'] = '';
		$this->_Raw['end'] = '';

		return $this;
	}

} // End Class
