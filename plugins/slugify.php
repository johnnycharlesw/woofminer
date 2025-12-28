<?php

/** Prefill field containing "_slug" with slugified value of a previous field (JavaScript)
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerSlugify extends Woofminer\Plugin {
	protected $from, $to;

	/**
	* @param string $from find these characters ...
	* @param string $to ... and replace them by these
	*/
	function __construct($from = 'áčďéěíňóřšťúůýž', $to = 'acdeeinorstuuyz') {
		$this->from = $from;
		$this->to = $to;
	}

	function editInput($table, $field, $attrs, $value) {
		static $slugify;
		if (!$_GET["select"] && !$_GET["where"] && $table) {
			if ($slugify === null) {
				$slugify = array();
				$prev = null;
				foreach (Woofminer\fields($table) as $name => $val) {
					if ($prev && preg_match('~(^|_)slug(_|$)~', $name)) {
						$slugify[$prev] = $name;
					}
					$prev = $name;
				}
			}
			$slug = $slugify[$field["field"]];
			if ($slug !== null) {
				return "<input value='" . Woofminer\h($value) . "' data-maxlength='$field[length]' size='40'$attrs>"
					. Woofminer\script("qsl('input').onchange = function () {
	const find = '$this->from';
	const repl = '$this->to';
	this.form['fields[$slug]'].value = this.value.toLowerCase()
		.replace(new RegExp('[' + find + ']', 'g'), function (str) { return repl[find.indexOf(str)]; })
		.replace(/[^a-z0-9_]+/g, '-')
		.replace(/^-|-\$/g, '')
		.substr(0, $field[length]);
};");
			}
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Předvyplní políčko obsahující "_slug" URLizovanou hodnotou předchozího políčka (JavaScript)'),
		'de' => array('' => 'Feld, das "_slug" enthält, mit dem Slugified-Wert eines vorherigen Felds vorab füllen (JavaScript)'),
		'pl' => array('' => 'Wstępnie wypełnij pole zawierające "_slug" osłabioną wartością poprzedniego pola (JavaScript)'),
		'ro' => array('' => 'Precompletați câmpul care conține "_slug" cu valoarea slugificată a unui câmp anterior (JavaScript)'),
		'ja' => array('' => '列名に "_slug" を含む列を、前列の URL 化された値でプレフィル (JavaScript)'),
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
