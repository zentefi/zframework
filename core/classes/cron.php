<?php

abstract class Cron {
	
	/* @return Cron */
	public static function load_cron($cron_name, $args=array()) {

		$cron_name = preg_replace('#(?i)\.php$#', '', $cron_name);
		$cron_name = preg_replace('#[^A-Za-z0-9\_\-]+#', '', $cron_name);

		$classname = preg_replace('#(?i)cron$#', '', $cron_name);

		$search_classnames = array();
		$search_classnames[] = $classname;
		$search_classnames[] = $classname.'cron';

		$search_filenames = array($classname);

		if($classname != strtolower($classname)) $search_filenames[] = strtolower($classname);

		$search_sufixs = array('.cron.php', '.php', 'cron.php', 'cron.cron.php');

		$search_dirs = array();
		$search_dirs[] = ZPHP::get_config('crons_dir');

		$test_files = array();

		foreach($search_dirs as $search_dir) {

			if($search_dir && is_dir($search_dir)) {

				if(strlen($search_dir) > 1) {
					$search_dir = rtrim($search_dir, '/');
				}

				foreach($search_filenames as $search_filename) {

					foreach($search_sufixs as $search_sufix) {

						$test_files[] = "{$search_dir}/{$search_filename}{$search_sufix}";
					}

				}

			}
		}

		foreach($test_files as $filename) {

			if(file_exists($filename)) {

				@ include_once($filename);

				foreach($search_classnames as $classname) {

					if(ClassHelper::class_is_defined($classname)) {

						return ClassHelper::create_instance_array($classname, $args);
					}

				}

			}
		}

	}
	
	/*------------------------------------------------------------------------------*/
	
	private $_name;
	
	public function __construct($name=null) {
		$name = get_class($this);
		$this->_set_name($name);
	}
	
	/*-------------------------------------------*/
	
	protected function _set_name($name) {
		$this->_name = $name;
	}
	
	protected function _get_name() {
		return $this->_name;
	}
	
	/*-------------------------------------------*/
	
	protected function _start_cron() {
		CLIHelper::write_line_stderr();
		CLIHelper::write_line_stderr("Running cron: ".$this->_get_name());
		CLIHelper::write_line_stderr();
	}
	
	protected function _end_cron() {
		CLIHelper::write_line_stderr();
	}
	
	
	abstract protected function _run_cron();
	
	
	/*-------------------------------------------*/

	protected function _echo($str) {
		echo $str;
	}
	
	protected function _echo_line($str='') {
		return $this->_echo("{$str}\n");
	}
	
	/*-------------------------------------------*/
	
	public function run_cron() {
		
		NavigationHelper::header_content_text_plain('UTF-8');
		
		$this->_start_cron();
		$this->_run_cron();
		$this->_end_cron();
		
	}
}