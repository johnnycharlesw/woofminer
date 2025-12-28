<?php

/** Allow switching light and dark mode
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerDarkSwitcher extends Woofminer\Plugin {

	function head($dark = null) {
		?>
<script <?php echo Woofminer\nonce(); ?>>
let adminerDark;

function adminerDarkSwitch() {
	adminerDark = !adminerDark;
	adminerDarkSet();
}

function adminerDarkSet() {
	qsa('link[href*="dark.css"]').forEach(link => link.media = (adminerDark ? '' : 'never'));
	qs('meta[name="color-scheme"]').content = (adminerDark ? 'dark' : 'light');
	cookie('adminer_dark=' + (adminerDark ? 1 : 0), 30);
}

const saved = document.cookie.match(/adminer_dark=(\d)/);
if (saved) {
	adminerDark = +saved[1];
	adminerDarkSet();
} else {
	adminerDark = +matchMedia('(prefers-color-scheme: dark)').matches;
}
</script>
<?php
	}

	function navigation($missing) {
		echo "<big style='position: fixed; bottom: .5em; right: .5em; cursor: pointer;'>☀</big>"
			. Woofminer\script("adminerDarkSet(); qsl('big').onclick = adminerDarkSwitch;") . "\n"
		;
	}

	function screenshot() {
		return "https://www.github.com/johnnycharlesw/woofminer/wiki/static/plugins/dark-switcher.gif";
	}

	protected $translations = array(
		'cs' => array('' => 'Dovoluje přepínání světlého a tmavého vzhledu'),
		'de' => array('' => 'Umschalten zwischen hellem und dunklem Design erlauben'),
		'ja' => array('' => 'ダークモードへの切替え'),
		'pl' => array('' => 'Zezwalaj na przełączanie trybu jasnego i ciemnego'),
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
		'ro' => array('' => null),
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
