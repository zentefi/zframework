<?php

abstract class Cron {

	private static $_ARGS_OFFSET = 3;

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
		$search_dirs[] = ZPHP::get_zframework_dir().'/core/crons';

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

	public static function get_args($offset=0, $length=null)
	{
		$args = CLIHelper::get_args(self::$_ARGS_OFFSET);
		return array_slice($args, $offset, $length);
	}

	public static function get_arg($index=0, $default=null)
	{
		return CLIHelper::get_arg(self::$_ARGS_OFFSET+$index, $default);
	}

	public static function get_args_count() {
		$args = self::get_args();
		return count($args);
	}

	public static function running_crons($class=null)
	{
		$files = FilesHelper::dir_list(ZPHP::get_config('crons_locks_dir'));
		$crons = array();

		foreach($files as $filename)
		{
			if(preg_match('#(?i)^(?P<cron>.+?)\.cron-lock\-.+?$#', $filename, $match))
			{
				$crons[] = $match['cron'];
			}
		}

		if($class)
		{
			$count = 0;

			foreach($crons as $cron)
			{
				if($cron == $class)
				{
					$count++;
				}
			}

			return $count;
		}
		else
		{
			return array_unique($crons);
		}
	}

	/*------------------------------------------------------------------------------*/
	
	private $_name;
	private $_lock_file;
	
	public function __construct($name=null) {
		$name = get_class($this);
		$this->_set_name($name);
		$this->_lock_file = ZPHP::get_config('crons_locks_dir').'/'.get_class($this).'.cron-lock-'.uniqid();

		$lock_file = $this->_lock_file;
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

	protected function _touch_lock_file()
	{
		if(ZPHP::get_config('crons.create_locks_files'))
		{
			touch($this->_lock_file);
		}

	}

	protected function _unlink_lock_file()
	{
		if(ZPHP::get_config('crons.create_locks_files'))
		{
			@ unlink($this->_lock_file);
		}

	}
	
	/*-------------------------------------------*/

	public function run_cron() {

		$this->_touch_lock_file();

		NavigationHelper::header_content_text_plain('UTF-8');
		
		$this->_start_cron();
		$this->_run_cron();
		$this->_end_cron();

		$this->_unlink_lock_file();
	}
}
