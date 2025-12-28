<?php

/** Select foreign key in edit form
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerEditForeign extends Woofminer\Plugin {
	protected $limit;

	function __construct($limit = 0) {
		$this->limit = $limit;
	}

	function editInput($table, $field, $attrs, $value) {
		static $foreignTables = array();
		static $values = array();
		$foreignKeys = &$foreignTables[$table];
		if ($foreignKeys === null) {
			$foreignKeys = Woofminer\column_foreign_keys($table);
		}
		foreach ((array) $foreignKeys[$field["field"]] as $foreignKey) {
			if (count($foreignKey["source"]) == 1) {
				$target = $foreignKey["table"];
				$id = $foreignKey["target"][0];
				$options = &$values[$target][$id];
				if (!$options) {
					$column = Woofminer\idf_escape($id);
					if (preg_match('~binary~', $field["type"])) {
						$column = "HEX($column)";
					}
					$options = array("" => "") + Woofminer\get_vals("SELECT $column FROM " . Woofminer\table($target) . " ORDER BY 1" . ($this->limit ? " LIMIT " . ($this->limit + 1) : ""));
					if ($this->limit && count($options) - 1 > $this->limit) {
						return;
					}
				}
				return "<select$attrs>" . Woofminer\optionlist($options, $value) . "</select>";
			}
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Výběr cizího klíče v editačním formuláři'),
		'de' => array('' => 'Wählen Sie im Bearbeitungsformular den Fremdschlüssel aus'),
		'pl' => array('' => 'Wybierz klucz obcy w formularzu edycji'),
		'ro' => array('' => 'Selectați cheia străină în formularul de editare'),
		'ja' => array('' => '外部キーを編集フォームで選択'),
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
