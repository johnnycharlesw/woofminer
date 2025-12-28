<?php

/** Pretty print JSON values in edit
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Christopher Chen
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerPrettyJsonColumn extends Woofminer\Plugin {
	private function testJson($value) {
		if ((substr($value, 0, 1) == '{' || substr($value, 0, 1) == '[') && ($json = json_decode($value, true))) {
			return $json;
		}
		return $value;
	}

	function editInput($table, $field, $attrs, $value) {
		$json = $this->testJson($value);
		if ($json !== $value) {
			$jsonText = json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
			return "<textarea$attrs cols='50' rows='20' class='jush-js'>" . Woofminer\h($jsonText) . "</textarea>";
		}
	}

	function processInput($field, $value, $function = '') {
		if ($function === '') {
			$json = $this->testJson($value);
			if ($json !== $value) {
				return Woofminer\q(json_encode($json));
			}
		}
	}

	protected $translations = array(
		'cs' => array('' => 'V editaci zobrazí syntaxi u JSONu'),
		'de' => array('' => 'JSON-Werte in der Bearbeitung hübsch drucken'),
		'pl' => array('' => 'Ładnie drukuj wartości JSON w edycji'),
		'ro' => array('' => 'Afisare frumoasa a valorilor JSON în editare'),
		'ja' => array('' => '編集時に JSON 文字列を見易く表示'),
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
