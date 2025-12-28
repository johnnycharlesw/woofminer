<?php

/** Expanded table structure output
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Matthew Gamble, https://www.matthewgamble.net/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerTableStructure extends Woofminer\Plugin {

	/** Print table structure in tabular format
	* @param Field[] $fields data about individual fields
	*/
	function tableStructurePrint(array $fields, $tableStatus = null): bool {
		echo "<div class='scrollable'>\n";
		echo "<table class='nowrap odds'>\n";
		echo "<thead><tr>"
			. "<th>" . Woofminer\lang('Column')
			. "<th>" . Woofminer\lang('Type')
			. "<th>" . Woofminer\lang('Collation')
			. "<th>" . Woofminer\lang('Nullable')
			. "<th>" . Woofminer\lang('Default')
			. (Woofminer\support("comment") ? "<th>" . Woofminer\lang('Comment') : "")
			. "</thead>\n"
		;
		foreach ($fields as $field) {
			echo "<tr><th>" . Woofminer\h($field["field"]) . ($field["primary"] ? " (PRIMARY)" : "");
			echo "<td><span>" . Woofminer\h($field["full_type"]) . "</span>";
			echo ($field["auto_increment"] ? " <i>" . Woofminer\lang('Auto Increment') . "</i>" : "");
			echo "<td>" . ($field["collation"] ? " <i>" . Woofminer\h($field["collation"]) . "</i>" : "");
			echo "<td>" . ($field["null"] ? Woofminer\lang('Yes') : Woofminer\lang('No'));
			echo "<td>" . Woofminer\h($field["default"]);
			echo (Woofminer\support("comment") ? "<td>" . Woofminer\h($field["comment"]) : "");
			echo "\n";
		}
		echo "</table>\n";
		echo "</div>\n";
		return true;
	}

	protected $translations = array(
		'cs' => array('' => 'Rozšířené informace o tabulkách'),
		'de' => array('' => 'Erweiterte Ausgabe der Tabellenstruktur'),
		'pl' => array('' => 'Rozszerzone wyjście struktury tabeli'),
		'ro' => array('' => 'Ieșirea expandată a structurii tabelei'),
		'ja' => array('' => 'テーブル構造を拡張表示'),
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
