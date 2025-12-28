<?php

/** Filter names in tables list
* @link https://www.github.com/johnnycharlesw/woofminer/wiki/plugins/#use
* @author Jakub Vrana, https://www.vrana.cz/
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerTablesFilter extends Woofminer\Plugin {
	function tablesPrint($tables) {
		?>
<script<?php echo Woofminer\nonce(); ?>>
let tablesFilterTimeout = null;
let tablesFilterValue = '';

function tablesFilter() {
	const value = qs('#filter-field').value.toLowerCase();
	if (value == tablesFilterValue) {
		return;
	}
	tablesFilterValue = value;
	let reg;
	if (value != '') {
		reg = (value + '').replace(/([\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:])/g, '\\$1');
		reg = new RegExp('('+ reg + ')', 'gi');
	}
	if (sessionStorage) {
		sessionStorage.setItem('adminer_tables_filter', value);
	}
	for (const table of qsa('li', qs('#tables'))) {
		let a = null;
		let text = table.getAttribute('data-table-name');
		if (text == null) {
			a = qsa('a', table)[1];
			text = a.innerHTML.trim();

			table.setAttribute('data-table-name', text);
			a.setAttribute('data-link', 'main');
		} else {
			a = qs('a[data-link="main"]', table);
		}
		if (value == '') {
			table.className = '';
			a.innerHTML = text;
		} else {
			table.className = (text.toLowerCase().indexOf(value) == -1 ? 'hidden' : '');
			a.innerHTML = text.replace(reg, '<strong>$1</strong>');
		}
	}
}

function tablesFilterInput() {
	window.clearTimeout(tablesFilterTimeout);
	tablesFilterTimeout = window.setTimeout(tablesFilter, 200);
}

sessionStorage && document.addEventListener('DOMContentLoaded', () => {
	let db = qs('#dbs').querySelector('select');
	db = db.options[db.selectedIndex].text;
	if (db == sessionStorage.getItem('adminer_tables_filter_db') && sessionStorage.getItem('adminer_tables_filter')){
		qs('#filter-field').value = sessionStorage.getItem('adminer_tables_filter');
		tablesFilter();
	}
	sessionStorage.setItem('adminer_tables_filter_db', db);
});
</script>
<p class="jsonly"><?php echo $this->lang('Filter'); ?>: <input id="filter-field" autocomplete="off" type="search"><?php echo Woofminer\script("qs('#filter-field').oninput = tablesFilterInput;"); ?>
<?php
	}

	protected $translations = array(
		'cs' => array(
			'' => 'Filtruje názvy v seznamu tabulek',
			'Filter' => 'Filtr',
		),
		'de' => array(
			'' => 'Filtern Sie Namen in der Tabellenliste',
			'Filter' => null,
		),
		'pl' => array(
			'' => 'Filtruj nazwy na liście tabel',
			'Filter' => null,
		),
		'ro' => array(
			'' => 'Nume de filtre în lista de tabele',
			'Filter' => null,
		),
		'ja' => array(
			'' => 'テーブル一覧をテーブル名でフィルタリング',
			'Filter' => null,
		),
		'ar' => array(
			'' => null,
			'Filter' => null,
		),
		'bg' => array(
			'' => null,
			'Filter' => null,
		),
		'bn' => array(
			'' => null,
			'Filter' => null,
		),
		'bs' => array(
			'' => null,
			'Filter' => null,
		),
		'ca' => array(
			'' => null,
			'Filter' => null,
		),
		'da' => array(
			'' => null,
			'Filter' => null,
		),
		'el' => array(
			'' => null,
			'Filter' => null,
		),
		'en' => array(
		),
		'es' => array(
			'' => null,
			'Filter' => null,
		),
		'et' => array(
			'' => null,
			'Filter' => null,
		),
		'fa' => array(
			'' => null,
			'Filter' => null,
		),
		'fi' => array(
			'' => null,
			'Filter' => null,
		),
		'fr' => array(
			'' => null,
			'Filter' => null,
		),
		'gl' => array(
			'' => null,
			'Filter' => null,
		),
		'he' => array(
			'' => null,
			'Filter' => null,
		),
		'hi' => array(
			'' => null,
			'Filter' => null,
		),
		'hu' => array(
			'' => null,
			'Filter' => null,
		),
		'id' => array(
			'' => null,
			'Filter' => null,
		),
		'it' => array(
			'' => null,
			'Filter' => null,
		),
		'ka' => array(
			'' => null,
			'Filter' => null,
		),
		'ko' => array(
			'' => null,
			'Filter' => null,
		),
		'lt' => array(
			'' => null,
			'Filter' => null,
		),
		'lv' => array(
			'' => null,
			'Filter' => null,
		),
		'ms' => array(
			'' => null,
			'Filter' => null,
		),
		'nl' => array(
			'' => null,
			'Filter' => null,
		),
		'no' => array(
			'' => null,
			'Filter' => null,
		),
		'pt-br' => array(
			'' => null,
			'Filter' => null,
		),
		'pt' => array(
			'' => null,
			'Filter' => null,
		),
		'ru' => array(
			'' => null,
			'Filter' => null,
		),
		'sk' => array(
			'' => null,
			'Filter' => null,
		),
		'sl' => array(
			'' => null,
			'Filter' => null,
		),
		'sr' => array(
			'' => null,
			'Filter' => null,
		),
		'sv' => array(
			'' => null,
			'Filter' => null,
		),
		'ta' => array(
			'' => null,
			'Filter' => null,
		),
		'th' => array(
			'' => null,
			'Filter' => null,
		),
		'tr' => array(
			'' => null,
			'Filter' => null,
		),
		'uk' => array(
			'' => null,
			'Filter' => null,
		),
		'uz' => array(
			'' => null,
			'Filter' => null,
		),
		'vi' => array(
			'' => null,
			'Filter' => null,
		),
		'zh-tw' => array(
			'' => null,
			'Filter' => null,
		),
		'zh' => array(
			'' => null,
			'Filter' => null,
		),
	);
}
