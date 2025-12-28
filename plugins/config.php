<?php

/** Configure options by end-users and store them to a cookie
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerConfig extends Woofminer\Plugin {

	function headers() {
		static $called; // this function is called from page_header() and it also calls page_header()
		if (isset($_GET["config"]) && !$called && Woofminer\connection()) {
			$called = true;
			if ($_GET["config"]) { // using $_GET allows sharing links between devices but doesn't protect against same-site RF; CSRF is protected by SameSite cookies
				Woofminer\save_settings($_GET["config"], "adminer_config");
				Woofminer\redirect(null, $this->lang('Configuration saved.'));
			}
			Woofminer\page_header($this->lang('Configuration'));
			$config = Woofminer\woofminer()->config();
			if (!$config) {
				// this plugin itself defines config() so this branch is not currently used
				echo "<p>" . $this->lang('Only some plugins support configuration, e.g. %s.', '<a href="https://github.com/johnnycharlesw/woofminer/blob/master/plugins/menu-links.php"' . Woofminer\target_blank() . '>menu-links</a>') . "\n";
			} else {
				echo "<form action=''>\n";
				Woofminer\hidden_fields_get();
				echo "<table>\n";
				foreach (array_reverse($config) as $title => $html) { // Plugins::$append actually prepends
					echo "<tr><th>$title<td>$html\n";
				}
				echo "</table>\n";
				echo "<p><input type='submit' value='" . Woofminer\lang('Save') . "'>\n";
				echo "</form>\n";
			}
			Woofminer\page_footer('db');
			exit;
		}
	}

	function config() {
		$options = array(
			'' => $this->lang('Use %s if exists', "woofminer.css"),
			'builtin' => $this->lang('Use builtin design'),
		);
		return array($this->lang('Design') => Woofminer\html_radios('config[design]', $options, Woofminer\get_setting("design", "adminer_config"), "<br>"));
	}

	function css() {
		if (Woofminer\get_setting("design", "adminer_config") == "builtin") {
			return array();
		}
	}

	function pluginsLinks() {
		$link = preg_replace('~\b(db|ns)=[^&]*&~', '', Woofminer\ME);
		echo "<p><a href='" . Woofminer\h($link) . "config='>" . $this->lang('Configuration') . "</a>\n";
	}

	function screenshot() {
		return "https://www.github.com/johnnycharlesw/woofminer/wiki/static/plugins/config.png";
	}

	protected $translations = array(
		'cs' => array(
			'' => 'Konfigurace možností uživateli a jejich uložení do cookie',
			'Configuration' => 'Konfigurace',
			'Configuration saved.' => 'Konfigurace uložena.',
			'Only some plugins support configuration, e.g. %s.' => 'Konfiguraci podporují jen některé pluginy, např. %s.',
			'Design' => 'Vzhled',
			'Use %s if exists' => 'Použít %s, pokud existuje',
			'Use builtin design' => 'Použít vestavěný vzhled',
		),
		'pl' => array(
			'Configuration' => 'Konfiguracja',
			'Configuration saved.' => 'Konfiguracja zapisana.',
			'Only some plugins support configuration, e.g. %s.' => 'Tylko niektóre wtyczki obsługują konfigurację, np. %s.',
			'Design' => 'Wygląd',
			'Use %s if exists' => 'Użyj %s, jeśli istnieje',
			'Use builtin design' => 'Użyj wbudowanego wyglądu',
			'' => null,
		),
		'de' => array(
			'' => 'Optionen durch den Endbenutzer konfigurieren und dies in einem Cookie speichern',
			'Configuration' => 'Konfiguration',
			'Configuration saved.' => 'Konfiguration gespeichert.',
			'Only some plugins support configuration, e.g. %s.' => 'Nur einige Plugins unterstützen die Konfiguration, z.B. %s.',
			'Design' => 'Design',
			'Use %s if exists' => '%s verwenden, falls vorhanden',
			'Use builtin design' => 'Standard Design verwenden',
		),
		'ja' => array(
			'' => 'ユーザオプションを設定し cookie に保存',
			'Configuration' => '設定',
			'Configuration saved.' => '設定を保存しました。',
			'Only some plugins support configuration, e.g. %s.' => '設定変更に対応しているのは一部のプラグインのみです。例: %s。',
			'Design' => 'デザイン',
			'Use %s if exists' => 'あれば %s を使う',
			'Use builtin design' => '組込みのデザインを使う',
		),
		'ar' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'bg' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'bn' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'bs' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'ca' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'da' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'el' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'en' => array(
		),
		'es' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'et' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'fa' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'fi' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'fr' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'gl' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'he' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'hi' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'hu' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'id' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'it' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'ka' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'ko' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'lt' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'lv' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'ms' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'nl' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'no' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'pt-br' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'pt' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'ro' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'ru' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'sk' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'sl' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'sr' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'sv' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'ta' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'th' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'tr' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'uk' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'uz' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'vi' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'zh-tw' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
		'zh' => array(
			'' => null,
			'Configuration saved.' => null,
			'Configuration' => null,
			'Only some plugins support configuration, e.g. %s.' => null,
			'Use %s if exists' => null,
			'Use builtin design' => null,
			'Design' => null,
		),
	);
}
