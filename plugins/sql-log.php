<?php

/** Log all queries to SQL file
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerSqlLog extends Woofminer\Plugin {
	protected $filename;

	/**
	* @param string $filename defaults to "$database.sql"
	*/
	function __construct($filename = "") {
		$this->filename = $filename;
	}

	function messageQuery($query, $time, $failed = false) {
		$this->log($query);
	}

	function sqlCommandQuery($query) {
		$this->log($query);
	}

	private function log($query) {
		if ($this->filename == "") {
			$this->filename = Woofminer\woofminer()->database() . ($_GET["ns"] != "" ? ".$_GET[ns]" : "") . ".sql"; // no database goes to ".sql" to avoid collisions
		}
		$fp = fopen($this->filename, "a");
		flock($fp, LOCK_EX);
		fwrite($fp, $query);
		fwrite($fp, "\n\n");
		flock($fp, LOCK_UN);
		fclose($fp);
	}

	protected $translations = array(
		'cs' => array('' => 'Zaznamenává všechny příkazy do souboru SQL'),
		'de' => array('' => 'Protokollieren Sie alle Abfragen in einer SQL-Datei'),
		'pl' => array('' => 'Rejestruj wszystkie zapytania do pliku SQL'),
		'ro' => array('' => 'Logați toate interogările în fișierul SQL'),
		'ja' => array('' => '全クエリを SQL ファイルに記録'),
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
