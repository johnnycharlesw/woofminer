<?php

/** Display confirmation before unloading page if a form field was changed
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerBeforeUnload extends Woofminer\Plugin {

	function head($dark = null) {
		?>
<script <?php echo Woofminer\nonce(); ?>>
// editChange is declared in functions.js
// ajaxForm sets editChange to null on success

addEvent(document, 'change', event => {
	const el = event.target;
	if (el.form && /post/i.test(el.form.method)) {
		editChanged = true;
	}
});

addEvent(document, 'submit', () => {
	editChanged = null;
});

// all modern browsers ignore string returned from here
onbeforeunload = () => editChanged;
</script>
<?php
	}

	protected $translations = array(
		'cs' => array('' => 'Zobrazí potvrzení před odnahráním stránky, pokud bylo změněno formulářové políčko'),
		'de' => array('' => 'Zeigt eine Bestätigung an bevor die Seite neu geladen wird, wenn ein Formularfeld geändert wurde'),
		'ja' => array('' => 'フォームの列が変更された時、ページを再読込みする前に確認を表示'),
		'pl' => array('' => 'Wyświetlaj potwierdzenie przed rozładowaniem strony, jeśli pole formularza zostało zmienione'),
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
