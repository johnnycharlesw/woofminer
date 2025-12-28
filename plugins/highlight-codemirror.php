<?php

/** Use CodeMirror 5 for syntax highlighting and <textarea> including type-ahead of keywords and tables
* @link https://codemirror.net/5/
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerHighlightCodemirror extends Woofminer\Plugin {
	private $root;
	private $minified;

	function __construct($root = "https://cdn.jsdelivr.net/npm/codemirror@5", $minified = ".min") {
		$this->root = $root;
		$this->minified = $minified;
	}

	function syntaxHighlighting($tableStatuses) {
		?>
<style>
@import url(<?php echo $this->root; ?>/lib/codemirror<?php echo $this->minified; ?>.css);
@import url(<?php echo $this->root; ?>/addon/hint/show-hint<?php echo $this->minified; ?>.css);
.CodeMirror { border: 1px inset #ccc; resize: both; }
</style>
<?php
		echo Woofminer\script_src("$this->root/lib/codemirror$this->minified.js", true);
		echo Woofminer\script_src("$this->root/addon/runmode/runmode$this->minified.js", true);
		echo Woofminer\script_src("$this->root/addon/hint/show-hint$this->minified.js", true);
		echo Woofminer\script_src("$this->root/mode/javascript/javascript$this->minified.js", true);
		$tables = array_fill_keys(array_keys($tableStatuses), array());
		if (Woofminer\support("sql")) {
			echo Woofminer\script_src("$this->root/mode/sql/sql$this->minified.js", true);
			echo Woofminer\script_src("$this->root/addon/hint/sql-hint$this->minified.js", true);
			if (isset($_GET["sql"]) || isset($_GET["trigger"]) || isset($_GET["check"])) {
				foreach (Woofminer\driver()->allFields() as $table => $fields) {
					foreach ($fields as $field) {
						$tables[$table][] = $field["field"];
					}
				}
			}
		}
		?>
<script <?php echo Woofminer\nonce(); ?>>
addEventListener('DOMContentLoaded', () => {
	function getCmMode(el) {
		const match = el.className.match(/(^|\s)jush-([^ ]+)/);
		if (match) {
			const modes = {
				js: 'application/json',
				sql: 'text/x-<?php echo (Woofminer\connection()->flavor == "maria" ? "mariadb" : "mysql"); ?>',
				oracle: 'text/x-sql',
				clickhouse: 'text/x-sql',
				firebird: 'text/x-sql'
			};
			return modes[match[2]] || 'text/x-' + match[2];
		}
	}

	adminerHighlighter = els => els.forEach(el => {
		const mode = getCmMode(el);
		if (mode) {
			el.classList.add('cm-s-default');
			CodeMirror.runMode(el.textContent, mode, el);
		}
	});

	adminerHighlighter(qsa('code'));

	for (const el of qsa('textarea')) {
		const mode = getCmMode(el);
		if (mode) {
			const width = el.clientWidth;
			const height = el.clientHeight;
			const cm = CodeMirror.fromTextArea(el, {
				mode: mode,
				extraKeys: { 'Ctrl-Space': 'autocomplete' },
				hintOptions: {
					completeSingle: false,
					tables: <?php echo json_encode($tables); ?>,
					defaultTable: <?php echo json_encode($_GET["trigger"] ?: ($_GET["check"] ?: null)); ?>
				}
			});
			cm.setSize(width, height);
			cm.on('inputRead', () => {
				const token = cm.getTokenAt(cm.getCursor());
				if (/^[.`"\w]\w*$/.test(token.string)) {
					CodeMirror.commands.autocomplete(cm);
				}
			});
			setupSubmitHighlightInput(cm.getWrapperElement());
			el.onchange = () => cm.setValue(el.value);
		}
	}
});
</script>
<?php
		return true;
	}

	function screenshot() {
		return "https://www.github.com/johnnycharlesw/woofminer/wiki/static/plugins/codemirror.gif";
	}

	protected $translations = array(
		'cs' => array('' => 'Použít CodeMirror 5 pro zvýrazňování syntaxe a <textarea> včetně našeptávání klíčových slov a tabulek'),
		'de' => array('' => 'CodeMirror 5 verwenden für die Syntaxhervorhebung und <textarea> einschließlich der Überschrift von Schlüsselwörtern und Tabellen'),
		'ja' => array('' => 'CodeMirror 5 を用い、キーワードやテーブルを含む構文や <textarea> を強調表示'),
		'pl' => array('' => 'Użyj CodeMirror 5 do podświetlania składni i <textarea>, uwzględniając wcześniejsze wpisywanie słów kluczowych i tabel'),
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
