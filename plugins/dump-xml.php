<?php

/** Dump to XML format in structure <database name=""><table name=""><column name="">value
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerDumpXml extends Woofminer\Plugin {
	protected $database = false;

	function dumpFormat() {
		return array('xml' => 'XML');
	}

	function dumpTable($table, $style, $is_view = 0) {
		if ($_POST["format"] == "xml") {
			return true;
		}
	}

	function dumpData($table, $style, $query) {
		if ($_POST["format"] == "xml") {
			if (!$this->database) {
				$this->database = true;
				echo "<database name='" . Woofminer\h(Woofminer\DB) . "'>\n";
			}
			$result = Woofminer\connection()->query($query, 1);
			if ($result) {
				while ($row = $result->fetch_assoc()) {
					echo "\t<table name='" . Woofminer\h($table) . "'>\n";
					foreach ($row as $key => $val) {
						echo "\t\t<column name='" . Woofminer\h($key) . "'" . (isset($val) ? "" : " null='null'") . ">" . Woofminer\h($val) . "</column>\n";
					}
					echo "\t</table>\n";
				}
			}
			return true;
		}
	}

	function dumpHeaders($identifier, $multi_table = false) {
		if ($_POST["format"] == "xml") {
			header("Content-Type: text/xml; charset=utf-8");
			return "xml";
		}
	}

	function dumpFooter() {
		if ($_POST["format"] == "xml" && $this->database) {
			echo "</database>\n";
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Export do formátu XML ve struktuře <database name=""><table name=""><column name="">value'),
		'de' => array('' => 'Export im XML-Format in der Struktur <database name="><table name=""><column name="">value'),
		'pl' => array('' => 'Zrzut do formatu XML w strukturze <database name=""><table name=""><column name="">value'),
		'ro' => array('' => 'Dump în format XML în structura <database name=""><table name=""><column name="">value'),
		'ja' => array('' => '構造化 XML 形式でエクスポート <database name=""><table name=""><column name="">value'),
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
