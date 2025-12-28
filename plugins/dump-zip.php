<?php

/** Dump to ZIP format
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @uses ZipArchive, tempnam("")
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerDumpZip extends Woofminer\Plugin {
	protected $filename, $data;

	function dumpOutput() {
		if (!class_exists('ZipArchive')) {
			return array();
		}
		return array('zip' => 'ZIP');
	}

	function _zip($string, $state) {
		// ZIP can be created without temporary file by gzcompress - see PEAR File_Archive
		$this->data .= $string;
		if ($state & PHP_OUTPUT_HANDLER_END) {
			$zip = new ZipArchive;
			$zipFile = tempnam("", "zip");
			$zip->open($zipFile, ZipArchive::OVERWRITE); // php://output is not supported
			$zip->addFromString($this->filename, $this->data);
			$zip->close();
			$return = file_get_contents($zipFile);
			unlink($zipFile);
			return $return;
		}
		return "";
	}

	function dumpHeaders($identifier, $multi_table = false) {
		if ($_POST["output"] == "zip") {
			$this->filename = "$identifier." . ($multi_table && preg_match("~[ct]sv~", $_POST["format"]) ? "tar" : $_POST["format"]);
			header("Content-Type: application/zip");
			ob_start(array($this, '_zip'));
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Export do formátu ZIP'),
		'de' => array('' => 'Export Im ZIP-Format'),
		'pl' => array('' => 'Zrzuć do formatu ZIP'),
		'ro' => array('' => 'Dump în format ZIP'),
		'ja' => array('' => 'ZIP 形式でエクスポート'),
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
