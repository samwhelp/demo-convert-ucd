<?php

namespace Ucd\Mapping;

class Unicode {

	public static function newInstance()
	{
		//http://php.net/manual/en/language.oop5.late-static-bindings.php
        return new static();
    }

	public function __construct()
	{
		//http://php.net/manual/en/language.oop5.decon.php
		$this->init();
	}

	protected function init()
	{
		return true;
	}

	protected function prep()
	{
		return true;
	}

	protected function fromCodePoint($dec)
	{
		//http://php.net/manual/en/function.utf8-encode.php#49336
		//http://php.net/manual/en/function.utf8-encode.php#58442
		if($dec<128)return chr($dec);
		if($dec<2048)return chr(($dec>>6)+192).chr(($dec&63)+128);
		if($dec<65536)return chr(($dec>>12)+224).chr((($dec>>6)&63)+128).chr(($dec&63)+128);
		if($dec<2097152)return chr(($dec>>18)+240).chr((($dec>>12)&63)+128).chr((($dec>>6)&63)+128) .chr(($dec&63)+128);
		return '';

	}

	protected function fromCharToDec($char)
	{
		//https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/toString
		//https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/charCodeAt
		//https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/codePointAt
		//https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/fromCharCode


		//https://www.google.com.tw/#q=php+charCodeAt
		//http://stackoverflow.com/questions/10333098/utf-8-safe-equivelant-of-ord-or-charcodeat-in-php
		//http://php.net/manual/en/function.unpack.php
		//http://php.net/manual/en/function.pack.php
		//http://php.net/manual/en/function.ord.php
		//http://php.net/manual/en/function.chr.php
		//http://php.net/manual/en/function.hexdec.php
		//http://php.net/manual/en/function.dechex.php

		//var dec = char.charCodeAt(0).toString(10);

		if ($char === '') {
			return 0;
		}

		list(, $dec) = unpack('N', mb_convert_encoding($char, 'UCS-4BE', 'UTF-8'));

		return intval($dec);
	}

	protected function fromCharToHex($char)
	{
		if ($char === '') {
			return '';
		}

		list(, $dec) = unpack('N', mb_convert_encoding($char, 'UCS-4BE', 'UTF-8'));
		return dechex(intval($dec));
	}

	public function findChar_ByDec($dec)
	{
		return $this->fromCodePoint($dec);
	}

	public function findChar_ByHex($hex)
	{
		$dec = hexdec($hex);

		return $this->findChar_ByDec($dec);
	}

	public function findDec_ByChar($char)
	{
		return $this->fromCharToDec($char);
	}

	public function findDec_ByHex($hex)
	{
		return hexdec($hex);
	}

	public function findHex_ByChar($char)
	{
		return $this->fromCharToHex($char);
	}

	public function findHex_ByDec($dec)
	{
		return dechex($dec);
	}

	public function findHtmlEntityDec_ByDec($dec)
	{
		return '&#' . intval($dec) . ';';
	}

	public function findHtmlEntityHex_ByHex($hex)
	{
		return '&#x' . $hex . ';';
	}

	public function findHtmlEntityHex_ByDec($dec)
	{
		$hex = $this->findHex_ByDec($dec);

		return $this->findHtmlEntityHex_ByHex($hex);
	}

	public function findHtmlEntityDec_ByHex($hex)
	{
		$dec = $this->findDec_ByHex($hex);

		return $this->findHtmlEntityDec_ByDec($dec);
	}

	public function uniformDec($dec)
	{
		$dec = intval($dec);

		if ($dec < 1000) {
			return sprintf('%04d', $dec);
		}

		return $dec;
	}

	public function uniformHex($hex)
	{
		$dec = $this->findDec_ByHex($hex);

		if ($dec <65536) {
			return strtoupper(sprintf('%04s', $hex));
		}

		return strtoupper($hex);
	}



} // End Class
