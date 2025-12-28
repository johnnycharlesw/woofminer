<?php

/** AI prompt in SQL command generating the queries with Google Gemini
* Beware that this sends your whole database structure (not data) to Google Gemini.
* @link https://gemini.google.com/
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerSqlGemini extends Woofminer\Plugin {
	private $apiKey;
	private $model;

	/**
	* @param string $apiKey The default key is shared with all users and may run out of quota; get your own API key at: https://aistudio.google.com/apikey
	* @param string $model Available models: https://ai.google.dev/gemini-api/docs/models#available-models
	*/
	function __construct($apiKey = 'AIzaSyDWDbPjmvH9_hphsnY_yJGdue42qRMG3do', $model = "gemini-2.0-flash") {
		$this->apiKey = $apiKey;
		$this->model = $model;
	}

	function headers() {
		if (isset($_POST["gemini"]) && !isset($_POST["query"])) {
			$prompt = "I have a " . Woofminer\get_driver(Woofminer\DRIVER) . " database with this structure:\n\n";
			foreach (Woofminer\tables_list() as $table => $type) {
				$prompt .= Woofminer\create_sql($table, false, "CREATE") . ";\n\n";
			}
			$prompt .= "Prefer returning relevant columns including primary key.\n\n";
			$prompt .= "Give me this SQL query and nothing else:\n\n$_POST[gemini]\n\n";
			//~ echo $prompt; exit;
			$context = stream_context_create(array("http" => array(
				"method" => "POST",
				"header" => array("User-Agent: AdminerSqlGemini/" . Woofminer\VERSION, "Content-Type: application/json"),
				"content" => '{"contents": [{"parts":[{"text": ' . json_encode($prompt) . '}]}]}',
				"ignore_errors" => true,
			)));
			$response = json_decode(file_get_contents("https://generativelanguage.googleapis.com/v1beta/models/$this->model:generateContent?key=$this->apiKey", false, $context));
			if (isset($response->error)) {
				echo "-- " . $response->error->message;
			} else {
				$text = $response->candidates[0]->content->parts[0]->text;
				$text2 = preg_replace('~(\n|^)```sql\n(.+)\n```(\n|$)~sU', "*/\n\n\\2\n\n/*", "/*\n$text\n*/", -1, $count);
				echo ($count ? preg_replace('~/\*\s*\*/\n*~', '', $text2) : $text);
			}
			exit;
		}
	}

	function sqlPrintAfter() {
		echo "<p><textarea name='gemini' rows='5' cols='50' placeholder='" . $this->lang('Ask Gemini') . "'>" . Woofminer\h($_POST["gemini"]) . "</textarea>\n";
		?>
<p><input type='button' value='Gemini'>
<script <?php echo Woofminer\nonce(); ?>>
const geminiText = qsl('textarea');
const geminiButton = qsl('input');

function setSqlareaValue(value) {
	const sqlarea = qs('textarea.sqlarea');
	sqlarea.value = value;
	sqlarea.onchange && sqlarea.onchange();
}

geminiButton.onclick = () => {
	setSqlareaValue('-- <?php echo $this->lang('Just a sec...'); ?>');
	ajax(
		'',
		req => setSqlareaValue(req.responseText),
		'gemini=' + encodeURIComponent(geminiText.value)
	);
};

geminiText.onfocus = event => {
	alterClass(findDefaultSubmit(geminiText), 'default');
	alterClass(geminiButton, 'default', true);
	event.stopImmediatePropagation();
};

geminiText.onblur = () => {
	alterClass(geminiButton, 'default');
};

geminiText.onkeydown = event => {
	if (isCtrl(event) && (event.keyCode == 13 || event.keyCode == 10)) {
		geminiButton.onclick();
		event.stopPropagation();
	}
};
</script>
<?php
	}

	function screenshot() {
		return "https://www.github.com/johnnycharlesw/woofminer/wiki/static/plugins/sql-gemini.gif";
	}

	// use the phrases from https://gemini.google.com/
	protected $translations = array(
		'cs' => array(
			'' => 'Generování SQL příkazů pomocí umělé inteligence Google Gemini',
			'Ask Gemini' => 'Zeptat se Gemini',
			'Just a sec...' => 'Chviličku...',
		),
		'pl' => array(
			'Ask Gemini' => 'Zapytaj Gemini',
			'Just a sec...' => 'Chwileczkę...',
			'' => null,
		),
		'de' => array(
			'' => 'KI-Eingabeaufforderung im SQL-Befehl zur Erstellung der Abfragen mit Google Gemini',
			'Ask Gemini' => 'Gemini fragen',
			'Just a sec...' => 'Einen Moment...',
		),
		'ja' => array(
			'' => 'Google Gemini AI を用いて SQL 文を生成',
			'Ask Gemini' => 'Gemini に聞く',
			'Just a sec...' => 'しばらくお待ち下さい...',
		),
		'ar' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'bg' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'bn' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'bs' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'ca' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'da' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'el' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'en' => array(
		),
		'es' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'et' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'fa' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'fi' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'fr' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'gl' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'he' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'hi' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'hu' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'id' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'it' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'ka' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'ko' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'lt' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'lv' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'ms' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'nl' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'no' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'pt-br' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'pt' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'ro' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'ru' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'sk' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'sl' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'sr' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'sv' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'ta' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'th' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'tr' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'uk' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'uz' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'vi' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'zh-tw' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
		'zh' => array(
			'' => null,
			'Ask Gemini' => null,
			'Just a sec...' => null,
		),
	);
}
