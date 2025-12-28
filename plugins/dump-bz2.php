<?php

/** Dump to Bzip2 format
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @uses bzopen(), tempnam("")
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerDumpBz2 extends Woofminer\Plugin {
	protected $filename, $fp;

	function dumpOutput() {
		if (!function_exists('bzopen')) {
			return array();
		}
		return array('bz2' => 'bzip2');
	}

	function _bz2($string, $state) {
		bzwrite($this->fp, $string);
		if ($state & PHP_OUTPUT_HANDLER_END) {
			bzclose($this->fp);
			$return = file_get_contents($this->filename);
			unlink($this->filename);
			return $return;
		}
		return "";
	}

	function dumpHeaders($identifier, $multi_table = false) {
		if ($_POST["output"] == "bz2") {
			$this->filename = tempnam("", "bz2");
			$this->fp = bzopen($this->filename, 'w');
			header("Content-Type: application/x-bzip");
			ob_start(array($this, '_bz2'), 1e6);
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Export do formátu Bzip2'),
		'de' => array('' => 'Export im Bzip2-Format'),
		'pl' => array('' => 'Zrzuć do formatu Bzip2'),
		'ro' => array('' => 'Dump în format Bzip2'),
		'ja' => array('' => 'Bzip2 形式でエクスポート'),
		'ar' => array('' => null),
		'bg' => array('' => null),
		'bn' => array('' => null),
		'bs' => array('' => null),
		'ca' => array('' => null),
		'da' => array('' => null),
		'el' => array('' => null),
		'en' => array(
		),
		'es' => array('' => null),
		'et' => array('' => null),
		'fa' => array('' => null),
		'fi' => array('' => null),
		'fr' => array('' => null),
		'gl' => array('' => null),
		'he' => array('' => null),
		'hi' => array('' => null),
		'hu' => array('' => null),
		'id' => array('' => null),
		'it' => array('' => null),
		'ka' => array('' => null),
		'ko' => array('' => null),
		'lt' => array('' => null),
		'lv' => array('' => null),
		'ms' => array('' => null),
		'nl' => array('' => null),
		'no' => array('' => null),
		'pt-br' => array('' => null),
		'pt' => array('' => null),
		'ru' => array('' => null),
		'sk' => array('' => null),
		'sl' => array('' => null),
		'sr' => array('' => null),
		'sv' => array('' => null),
		'ta' => array('' => null),
		'th' => array('' => null),
		'tr' => array('' => null),
		'uk' => array('' => null),
		'uz' => array('' => null),
		'vi' => array('' => null),
		'zh-tw' => array('' => null),
		'zh' => array('' => null),
	);
}
