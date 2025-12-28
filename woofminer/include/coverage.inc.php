<?php
namespace Woofminer;

// coverage is used in tests and removed in compilation
if (extension_loaded("xdebug") && file_exists(sys_get_temp_dir() . "/woofminer.coverage")) {
	function save_coverage(): void {
		$coverage_filename = sys_get_temp_dir() . "/woofminer.coverage";
		$coverage = unserialize(file_get_contents($coverage_filename));
		foreach (xdebug_get_code_coverage() as $filename => $lines) {
			foreach ($lines as $l => $val) {
				if (!idx($coverage[$filename], $l) || $val > 0) {
					$coverage[$filename][$l] = $val;
				}
			}
			file_put_contents($coverage_filename, serialize($coverage));
		}
	}
	xdebug_start_code_coverage(XDEBUG_CC_UNUSED | XDEBUG_CC_DEAD_CODE);
	register_shutdown_function('Woofminer\save_coverage');
}
