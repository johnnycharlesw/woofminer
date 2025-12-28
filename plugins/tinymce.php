<?php

/** Edit all fields containing "_html" by HTML editor TinyMCE and display the HTML in select
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @uses TinyMCE, http://tinymce.moxiecode.com/
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerTinymce extends Woofminer\Plugin {
	protected $path;

	function __construct($path = "tiny_mce/tiny_mce.js") {
		$this->path = $path;
	}

	function head($dark = null) {
		$lang = Woofminer\LANG;
		$lang = ($lang == "zh" ? "zh-cn" : ($lang == "zh-tw" ? "zh" : $lang));
		if (!file_exists(dirname($this->path) . "/langs/$lang.js")) {
			$lang = "en";
		}
		echo Woofminer\script_src($this->path);
		?>
<script<?php echo Woofminer\nonce(); ?>>
tinyMCE.init({
	entity_encoding: 'raw',
	language: '<?php echo $lang; ?>'
}); // learn how to customize here: https://www.tinymce.com/docs/configure/
</script>
<?php
	}

	function selectVal(&$val, $link, $field, $original) {
		if (preg_match("~_html~", $field["field"]) && $val != '') {
			$ellipsis = "<i>…</i>";
			$length = strlen($ellipsis);
			$shortened = (substr($val, -$length) == $ellipsis);
			if ($shortened) {
				$val = substr($val, 0, -$length);
			}
			//! shorten with regard to HTML tags - http://php.vrana.cz/zkraceni-textu-s-xhtml-znackami.php
			$val = preg_replace('~<[^>]*$~', '', html_entity_decode($val, ENT_QUOTES)); // remove ending incomplete tag (text can be shortened)
			if ($shortened) {
				$val .= $ellipsis;
			}
			if (class_exists('DOMDocument')) { // close all opened tags
				$dom = new DOMDocument;
				if (@$dom->loadHTML("<meta http-equiv='Content-Type' content='text/html; charset=utf-8'></head>$val")) { // @ - $val can contain errors
					$val = preg_replace('~.*<body[^>]*>(.*)</body>.*~is', '\1', $dom->saveHTML());
				}
			}
		}
	}

	function editInput($table, $field, $attrs, $value) {
		if (preg_match("~text~", $field["type"]) && preg_match("~_html~", $field["field"])) {
			return "<textarea$attrs id='fields-" . Woofminer\h($field["field"]) . "' rows='12' cols='50'>" . Woofminer\h($value) . "</textarea>" . Woofminer\script("
tinyMCE.remove(tinyMCE.get('fields-" . Woofminer\js_escape($field["field"]) . "') || { });
tinyMCE.EditorManager.execCommand('mceAddControl', true, 'fields-" . Woofminer\js_escape($field["field"]) . "');
qs('#form').onsubmit = () => {
	tinyMCE.each(tinyMCE.editors, ed => {
		ed.remove();
	});
};
");
		}
	}

	protected $translations = array(
		'cs' => array('' => 'Upravuje všechna políčka obsahující "_html" pomocí HTML editoru TinyMCE a zobrazuje výsledné HTML ve výpisu'),
		'de' => array('' => 'Bearbeiten Sie alle Felder, die "_html" enthalten, mit dem HTML-Editor TinyMCE und zeigen Sie den HTML-Code in Select an'),
		'pl' => array('' => 'Edytuj wszystkie pola zawierające "_html" za pomocą edytora HTML TinyMCE i wyświetl kod HTML w wybranych'),
		'ro' => array('' => 'Editați toate câmpurile care conțin "_html" cu ajutorul editorului HTML TinyMCE și afișați HTML-ul în select'),
		'ja' => array('' => '列名が "_html" を含む列を TinyMCE の HTML エディタで編集し、編集結果の HTML コードを "選択" 画面に表示'),
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
