<?php

/** Dump to PHP format
* @author Martin Zeman (Zemistr), http://www.zemistr.eu/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerDumpPhp extends Woofminer\Plugin {
	protected $output = array();

	function dumpFormat() {
		return array('php' => 'PHP');
	}

	function dumpHeaders() {
		if ($_POST['format'] == 'php') {
			header('Content-Type: text/plain; charset=utf-8');
			return 'php';
		}
	}

	function dumpTable($table, $style, $is_view = 0) {
		if ($_POST['format'] == 'php') {
			$this->output[$table] = array();
			return true;
		}
	}

	function dumpData($table, $style, $query) {
		if ($_POST['format'] == 'php') {
			$result = Woofminer\connection()->query($query, 1);
			if ($result) {
				while ($row = $result->fetch_assoc()) {
					$this->output[$table][] = $row;
				}
			}
			return true;
		}
	}

	function dumpFooter() {
		if ($_POST['format'] == 'php') {
			echo "<?php\n";
			var_export($this->output);
			echo ";\n";
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Export do formátu PHP'),
		'de' => array('' => 'Export im PHP-Format'),
		'pl' => array('' => 'Zrzucaj do formatu PHP'),
		'ro' => array('' => 'Dump în format PHP'),
		'ja' => array('' => 'PHP 形式でエクスポート'),
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
