<?php

/** Display jQuery UI Timepicker for each date and datetime field
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @uses jQuery-Timepicker, http://trentrichardson.com/examples/timepicker/
* @uses jQuery UI: core, widget, mouse, slider, datepicker
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerEditCalendar extends Woofminer\Plugin {
	protected $prepend, $langPath;

	/**
	* @param string $prepend text to append before first calendar usage
	* @param string $langPath path to language file, %s stands for language code
	*/
	function __construct($prepend = null, $langPath = "jquery-ui/i18n/jquery.ui.datepicker-%s.js") {
		$this->prepend = $prepend;
		$this->langPath = $langPath;
	}

	function head($dark = null) {
		echo ($this->prepend !== null ? $this->prepend :
			"<link rel='stylesheet' type='text/css' href='jquery-ui/jquery-ui.css'>\n"
			. Woofminer\script_src("jquery-ui/jquery.js")
			. Woofminer\script_src("jquery-ui/jquery-ui.js")
			. Woofminer\script_src("jquery-ui/jquery-ui-timepicker-addon.js")
		);
		if ($this->langPath) {
			$lang = Woofminer\LANG;
			$lang = ($lang == "zh" ? "zh-CN" : ($lang == "zh-tw" ? "zh-TW" : $lang));
			if ($lang != "en" && file_exists(sprintf($this->langPath, $lang))) {
				echo Woofminer\script_src(sprintf($this->langPath, $lang));
				echo Woofminer\script("jQuery(() => { jQuery.timepicker.setDefaults(jQuery.datepicker.regional['$lang']); });");
			}
		}
	}

	function editInput($table, $field, $attrs, $value) {
		if (preg_match("~date|time~", $field["type"])) {
			$dateFormat = "changeYear: true, dateFormat: 'yy-mm-dd'"; //! yy-mm-dd regional
			$timeFormat = "showSecond: true, timeFormat: 'HH:mm:ss', timeInput: true";
			return "<input id='fields-" . Woofminer\h($field["field"]) . "' value='" . Woofminer\h($value) . "'" . (@+$field["length"] ? " data-maxlength='" . (+$field["length"]) . "'" : "") . "$attrs>" . Woofminer\script(
				"jQuery('#fields-" . Woofminer\js_escape($field["field"]) . "')."
				. ($field["type"] == "time" ? "timepicker({ $timeFormat })"
					: (preg_match("~time~", $field["type"]) ? "datetimepicker({ $dateFormat, $timeFormat })"
						: "datepicker({ $dateFormat })"
					)) . ";"
			);
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Zobrazí jQuery UI Timepicker pro každé datumové a časové políčko'),
		'de' => array('' => 'Zeigen Sie die jQuery-UI Timepicker für jedes Datums- und Datum/Uhrzeit-Feld an'),
		'pl' => array('' => 'Wyświetl interfejs jQuery Timepicker dla każdego pola daty i godziny'),
		'ro' => array('' => 'Afișați jQuery UI Timepicker pentru fiecare câmp de dată și dată-timp'),
		'ja' => array('' => '各日時列に jQuery UI の Timepicker を表示'),
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
