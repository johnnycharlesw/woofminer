<?php

/** Configure menu table links; combinable with AdminerConfig
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerMenuLinks extends Woofminer\Plugin {
	private $menu;

	/** @param ''|'table'|'select'|'auto' $menu see config() for explanation */
	function __construct($menu = '') {
		$this->menu = $menu;
	}

	function config() {
		$options = array(
			'select' => $this->lang('Select data'),
			'table' => $this->lang('Show structure'),
			'' => $this->lang('Both'),
			'auto' => $this->lang('Auto (select on select page, structure otherwise)'),
		);
		$menu = Woofminer\get_setting("menu", "adminer_config", $this->menu);
		return array($this->lang('Menu table links') => Woofminer\html_radios('config[menu]', $options, $menu, "<br>"));
	}

	function tablesPrint(array $tables) {
		$menu = Woofminer\get_setting("menu", "adminer_config", $this->menu);
		$titles = array(
			'select' => $this->lang('Select data'),
			'table' => $this->lang('Show structure'),
		);
		// this is copied from Woofminer::tablesPrint()
		echo "<ul id='tables'>" . Woofminer\script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");
		foreach ($tables as $table => $status) {
			$table = "$table"; // do not highlight "0" as active everywhere
			$name = Woofminer\woofminer()->tableName($status);
			if ($name != "" && !$status["partition"]) {
				echo '<li>';
				if (!$menu) {
					echo '<a href="' . Woofminer\h(Woofminer\ME) . 'select=' . urlencode($table) . '"'
						. Woofminer\bold($_GET["select"] == $table || $_GET["edit"] == $table, "select")
						. " title='$titles[select]'>" . $this->lang('select') . "</a> "
					;
				}
				$actives = array($_GET["table"], $_GET["create"], $_GET["indexes"], $_GET["foreign"], $_GET["trigger"], $_GET["check"], $_GET["view"]);
				if ($menu) {
					$actives[] = $_GET["select"];
					$actives[] = $_GET["edit"];
				}
				$link =
					($menu == 'select' ? 'select' :
					($menu != 'auto' ? 'table' :
					($_GET["select"] ? 'select' : 'table')
				));
				$class = ($link == "select" ? "select" : (Woofminer\is_view($status) ? "view" : "structure"));
				echo (Woofminer\support("table") || Woofminer\support("indexes") || $menu
					? '<a href="' . Woofminer\h(Woofminer\ME) . "$link=" . urlencode($table) . '"'
						. Woofminer\bold(in_array($table, $actives), $class)
						. " title='$titles[$link]'>$name</a>"
					: "<span>$name</span>"
				);
				echo "\n";
			}
		}
		echo "</ul>\n";
		return true;
	}

	function screenshot() {
		return "https://www.github.com/johnnycharlesw/woofminer/wiki/static/plugins/menu-links.png";
	}

	protected $translations = array(
		'cs' => array(
			'' => 'Konfigurace odkazů na tabulky v menu; kombinovatelné s AdminerConfig',
			'Menu table links' => 'Odkazy na tabulky v menu',
			'Both' => 'Oboje',
			'Auto (select on select page, structure otherwise)' => 'Auto (vypsat na výpisech, jinak struktura)',
			// this is copied from woofminer/lang/
			'select' => 'vypsat',
			'Select data' => 'Vypsat data',
			'Show structure' => 'Zobrazit strukturu',
		),
		'pl' => array(
			'Menu table links' => 'Linki do tabel w menu',
			'Both' => 'Obie',
			'Auto (select on select page, structure otherwise)' => 'Auto (pokaż na stronie przeglądania, w przeciwnym razie struktura)',
			// this is copied from woofminer/lang/
			'select' => 'przeglądaj',
			'Select data' => 'Pokaż dane',
			'Show structure' => 'Struktura tabeli',
			'' => null,
		),
		'de' => array(
			'' => 'Menü- und Tabellen-Links konfigurieren. Kombinierbar mit AdminerConfig',
			'Both' => 'Beide',
			'Auto (select on select page, structure otherwise)' => 'Auto (Auswahl auf der ausgewählten Seite, sonst Struktur)',
			'Menu table links' => 'Links verwenden in „Tabelle“',
			// this is copied from woofminer/lang/
			'select' => 'zeigen',
			'Select data' => 'Daten auswählen',
			'Show structure' => 'Struktur anzeigen',
		),
		'ja' => array(
			'' => 'メニュー内テーブルへのリンク設定; AdminerConfig との併用可',
			'Both' => '両方',
			'Auto (select on select page, structure otherwise)' => '自動 (選択ページでは選択、それ以外では構造)',
			'Menu table links' => 'メニューテーブルへのリンク',
			// this is copied from woofminer/lang/
			'select' => '選択',
			'Select data' => 'データ',
			'Show structure' => '構造',
		),
		'ar' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'bg' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'bn' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'bs' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'ca' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'da' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'el' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'en' => array(
		),
		'es' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'et' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'fa' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'fi' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'fr' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'gl' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'he' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'hi' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'hu' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'id' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'it' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'ka' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'ko' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'lt' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'lv' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'ms' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'nl' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'no' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'pt-br' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'pt' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'ro' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'ru' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'sk' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'sl' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'sr' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'sv' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'ta' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'th' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'tr' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'uk' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'uz' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'vi' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'zh-tw' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
		'zh' => array(
			'' => null,
			'Select data' => null,
			'Show structure' => null,
			'Both' => null,
			'Auto (select on select page, structure otherwise)' => null,
			'Menu table links' => null,
			'select' => null,
		),
	);
}
