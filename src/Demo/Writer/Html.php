<?php

namespace Demo\Writer;

class Html extends Base {

	public function init()
	{
		$this->_Unicode = \Ucd\Mapping\Unicode::newInstance()
			->prep()
		;

		return $this;
	}

	public function render()
	{
		$rtn = '';

		$rtn .= '<!DOCTYPE html>' . PHP_EOL;
		$rtn .= '<html>' . PHP_EOL;
		$rtn .= '<head>' . PHP_EOL;
		$rtn .= '<meta charset="utf-8">' . PHP_EOL;
		$rtn .= '<title>' . '中英文對照表' . '</title>' . PHP_EOL;
		$rtn .= '<meta http-equiv="X-UA-Compatible" content="IE=edge" />' . PHP_EOL;
		$rtn .= '<meta name="viewport" content="width=device-width, initial-scale=1" />' . PHP_EOL;
		$rtn .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />' . PHP_EOL;
		$rtn .= '<link rel="stylesheet" href="demo.css" />' . PHP_EOL;

		$rtn .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>' . PHP_EOL;
	    $rtn .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>' . PHP_EOL;

		$rtn .= '<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->' . PHP_EOL;
		$rtn .= '<!--[if lt IE 9]>' . PHP_EOL;
		$rtn .= '<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>' . PHP_EOL;
		$rtn .= '<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>' . PHP_EOL;
		$rtn .= '<![endif]-->' . PHP_EOL;

		$rtn .= '</head>' . PHP_EOL;
		$rtn .= '<body>' . PHP_EOL;

		$rtn .= '<div class="container">' . PHP_EOL;

		$rtn .= '<table class="table table-striped table-hover table-responsive">' . PHP_EOL;

		$rtn .= '<thead>' . PHP_EOL;
		$rtn .= '	<tr>' . PHP_EOL;
		$rtn .= '		<th>' . PHP_EOL;
		$rtn .= '			16進位' . PHP_EOL;
		$rtn .= '		</th>' . PHP_EOL;
		$rtn .= '		<th>' . PHP_EOL;
		$rtn .= '			10進位' . PHP_EOL;
		$rtn .= '		</th>' . PHP_EOL;
		$rtn .= '		<th>' . PHP_EOL;
		$rtn .= '			字元' . PHP_EOL;
		$rtn .= '		</th>' . PHP_EOL;
		$rtn .= '		<th>' . PHP_EOL;
		$rtn .= '			英文名稱' . PHP_EOL;
		$rtn .= '		</th>' . PHP_EOL;
		$rtn .= '		<th>' . PHP_EOL;
		$rtn .= '			中文名稱' . PHP_EOL;
		$rtn .= '		</th>' . PHP_EOL;
		$rtn .= '		<th>' . PHP_EOL;
		$rtn .= '			備註' . PHP_EOL;
		$rtn .= '		</th>' . PHP_EOL;
		$rtn .= '	</tr>' . PHP_EOL;
		$rtn .= '</thead>' . PHP_EOL;

		$rtn .= '<tbody>' . PHP_EOL;

		foreach ($this->_Data->toArray() as $idx => $item) {

			// http://php.net/manual/en/function.htmlspecialchars.php
			$hex = htmlspecialchars($item->ref('Hex'), ENT_QUOTES | ENT_HTML5, 'UTF-8');
			$dec = htmlspecialchars($item->ref('Dec'), ENT_QUOTES | ENT_HTML5, 'UTF-8');
			$en_us = htmlspecialchars($item->ref('Name'), ENT_QUOTES | ENT_HTML5, 'UTF-8');
			$zh_tw = htmlspecialchars($item->ref('Name-zh_TW'), ENT_QUOTES | ENT_HTML5, 'UTF-8');
			$comment = htmlspecialchars($item->ref('Comment'), ENT_QUOTES | ENT_HTML5, 'UTF-8');

			if ($item->has('Dec')) {
				//https://en.wikipedia.org/wiki/List_of_XML_and_HTML_character_entity_references
				$char = '&#' . intval($item->ref('Dec')) . ';';
			} else {
				$char = $item->ref('Char');
			}

			if ($item->ref('Name') == '<control>') {
				$char = '';
			}


			$rtn .= '	<tr>' . PHP_EOL;

			$rtn .= '		<td>' . PHP_EOL;
			$rtn .= '			' . $hex . PHP_EOL;
			$rtn .= '		</td>' . PHP_EOL;

			$rtn .= '		<td>' . PHP_EOL;
			$rtn .= '			' . $dec . PHP_EOL;
			$rtn .= '		</td>' . PHP_EOL;

			$rtn .= '		<td>' . PHP_EOL;
			$rtn .= '			' . $char . PHP_EOL;
			$rtn .= '		</td>' . PHP_EOL;

			$rtn .= '		<td>' . PHP_EOL;
			$rtn .= '			' . $en_us . PHP_EOL;
			$rtn .= '		</td>' . PHP_EOL;

			$rtn .= '		<td>' . PHP_EOL;
			$rtn .= '			' . $zh_tw . PHP_EOL;
			$rtn .= '		</td>' . PHP_EOL;

			$rtn .= '		<td>' . PHP_EOL;
			$rtn .= '			' . $comment . PHP_EOL;
			$rtn .= '		</td>' . PHP_EOL;

			$rtn .= '	</tr>' . PHP_EOL;
		}

		$rtn .= '</tbody>' . PHP_EOL;

		$rtn .= '</table>' . PHP_EOL;

		$rtn .= '</div>' . PHP_EOL;

		$rtn .= '</body>' . PHP_EOL;
		$rtn .= '</html>' . PHP_EOL;

		return $rtn;
	}


} // End Class
