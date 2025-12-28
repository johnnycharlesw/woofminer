<?php

/** Use <select><option> for enum edit instead of <input type="radio">
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerEnumOption extends Woofminer\Plugin {

	function editInput($table, $field, $attrs, $value) {
		if ($field["type"] == "enum") {
			$options = array();
			$selected = "val-$value";
			if (isset($_GET["select"])) {
				$options["orig"] = Woofminer\lang('original');
				if ($value === null) {
					$selected = "orig";
				}
			}
			if ($field["null"]) {
				$options["null"] = "NULL";
				if ($value === null) {
					$selected = "null";
				}
			}
			preg_match_all("~'((?:[^']|'')*)'~", $field["length"], $matches);
			foreach ($matches[1] as $val) {
				$val = stripcslashes(str_replace("''", "'", $val));
				$options["val-$val"] = $val;
			}
			return "<select$attrs>" . Woofminer\optionlist($options, $selected, 1) . "</select>"; // 1 - use keys
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Editace políčka enum pomocí <select><option> místo <input type="radio">'),
		'de' => array('' => 'Verwenden Sie <select><option> für die enum-Bearbeitung anstelle von <input type="radio">'),
		'pl' => array('' => 'Użyj <select><option> do edycji enum zamiast <input type="radio">'),
		'ro' => array('' => 'Utilizați <select><option> pentru editarea enum în loc de <input type="radio">'),
		'ja' => array('' => '列挙型の編集に <input type="radio"> ではなく <select><option> を使用'),
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
