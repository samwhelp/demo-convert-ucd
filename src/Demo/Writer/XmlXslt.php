<?php

namespace Demo\Writer;

class XmlXslt extends Base {

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

		$rtn .= '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="demo.xsl"?>' . PHP_EOL;


		$rtn .= '<list>' . PHP_EOL;

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

			$rtn .= '	<item>' . PHP_EOL;

			$rtn .= '		<hex>' . PHP_EOL;
			$rtn .= '			' . $hex . PHP_EOL;
			$rtn .= '		</hex>' . PHP_EOL;

			$rtn .= '		<dec>' . PHP_EOL;
			$rtn .= '			' . $dec . PHP_EOL;
			$rtn .= '		</dec>' . PHP_EOL;

			$rtn .= '		<char>' . PHP_EOL;
			$rtn .= '			' . $char . PHP_EOL;
			$rtn .= '		</char>' . PHP_EOL;

			$rtn .= '		<en_us>' . PHP_EOL;
			$rtn .= '			' . $en_us . PHP_EOL;
			$rtn .= '		</en_us>' . PHP_EOL;

			$rtn .= '		<zh_tw>' . PHP_EOL;
			$rtn .= '			' . $zh_tw . PHP_EOL;
			$rtn .= '		</zh_tw>' . PHP_EOL;

			$rtn .= '		<comment>' . PHP_EOL;
			$rtn .= '			' . $comment . PHP_EOL;
			$rtn .= '		</comment>' . PHP_EOL;

			$rtn .= '	</item>' . PHP_EOL;

		}

		$rtn .= '</list>' . PHP_EOL;


		return $rtn;
	}



} // End Class
