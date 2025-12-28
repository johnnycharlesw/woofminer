<?php

/** Expanded table indexes structure output
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Matthew Gamble, https://www.matthewgamble.net/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerTableIndexesStructure extends Woofminer\Plugin {

	function tableIndexesPrint($indexes, $tableStatus): bool {
		echo "<table>\n";
		echo "<thead><tr><th>" . Woofminer\lang('Name') . "<th>" . Woofminer\lang('Type') . "<th>" . Woofminer\lang('Algorithm') . "<th>" . Woofminer\lang('Columns') . "</thead>\n";
		foreach ($indexes as $name => $index) {
			echo "<tr><th>" . Woofminer\h($name) . "<td>$index[type]<td>$index[algorithm]";
			ksort($index["columns"]); // enforce correct columns order
			$print = array();
			foreach ($index["columns"] as $key => $val) {
				$print[] = "<i>" . Woofminer\h($val) . "</i>"
					. ($index["lengths"][$key] ? "(" . $index["lengths"][$key] . ")" : "")
					. ($index["descs"][$key] ? " DESC" : "")
				;
			}
			echo "<td>" . implode(", ", $print) . "\n";
		}
		echo "</table>\n";
		return true;
	}

	protected $translations = array(
		'cs' => array('' => 'Rozšířené informace o indexech'),
		'de' => array('' => 'Erweiterte Ausgabe der Tabellenindize'),
		'pl' => array('' => 'Rozszerzona tabela wyników struktury indeksów'),
		'ro' => array('' => 'Ieșirea expandată a structurii indecsilor tabelului'),
		'ja' => array('' => 'テーブルのインデックス構造を拡張表示'),
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
