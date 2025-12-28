<?php

/** Allow switching designs
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerDesigns extends Woofminer\Plugin {
	protected $designs;

	/**
	* @param list<string> $designs URL in key, name in value
	*/
	function __construct(array $designs) {
		$this->designs = $designs;
	}

	function headers() {
		if (isset($_POST["design"]) && Woofminer\verify_token()) {
			Woofminer\restart_session();
			$_SESSION["design"] = $_POST["design"];
			Woofminer\redirect($_SERVER["REQUEST_URI"]);
		}
	}

	function css() {
		$return = array();
		if (array_key_exists($_SESSION["design"], $this->designs)) {
			$return[$_SESSION["design"]] = (preg_match('~-dark~', $_SESSION["design"]) ? "dark" : "light");
		}
		return $return;
	}

	function navigation($missing) {
		echo "<form action='' method='post' style='position: fixed; bottom: .5em; right: .5em;'>";
		echo Woofminer\html_select("design", array("" => "(design)") + $this->designs, $_SESSION["design"], "this.form.submit();");
		echo Woofminer\input_token();
		echo "</form>\n";
	}

	function screenshot() {
		return "https://www.github.com/johnnycharlesw/woofminer/wiki/static/plugins/designs.png";
	}

	protected $translations = array(
		'cs' => array('' => 'Umožní změnit vzhled'),
		'de' => array('' => 'Designwechsel ermöglichen'),
		'pl' => array('' => 'Zezwalaj na przełączanie motywów'),
		'ro' => array('' => 'Permiteți comutarea designurilor'),
		'ja' => array('' => 'テーマ設定を有効化'),
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
