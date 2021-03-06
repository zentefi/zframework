<?php 

class HTMLPageDevelopToolIconsWebIcons extends HTMLPageDevelopToolIcons  {

	const URL_SCRIPT_PATTERN = '/icons\/web\-?icons(?:\.php)?';
	const THEME = 'webicons';
	
	const DEFAULT_COLOR = 'color';
	const COLOR_GET_VARNAME = 'color';
	
	protected static $_colors = array('color', 'grey', 'black', 'green', 'blue', 'yellow', 'cyan', 'red');

	protected $_selected_color;

	/*----------------------------------------------*/
	
	protected static function _get_title()
	{
		return 'Icons Web Icons';
	}
	
	protected static function _get_show_index()
	{
		return false;
	}
	
	/*----------------------------------------------*/
		
	public function __construct() {
		parent::__construct(self::THEME);
		$this->add_css_files('/zframework/static/css/icons/webicons/style.css');
		
		$this->_selected_color = $_GET[self::COLOR_GET_VARNAME];
		
		if(!$this->_selected_color || !in_array($this->_selected_color, self::$_colors)) {
			$this->_selected_color = self::DEFAULT_COLOR;
		}
		
		$this->_right_title_html = '';
		
		foreach(self::$_colors as $color) {
			
			$this->_right_title_html.= "<span style='margin: 2px 0 0 20px; line-height: 25px'>";
			
			if($color == $this->_selected_color) {
				$this->_right_title_html.= "<span style='color: #777; font-weight: bold'>{$color}</span>";
			} else {
				$href = NavigationHelper::make_url_query(array(self::COLOR_GET_VARNAME => $color));
				$this->_right_title_html.= "<a href='{$href}' class='color-link'>{$color}</a>";
			}
			
			$this->_right_title_html.= "</span>";
		}
	}
	
	public function prepare_params() {
		
		parent::prepare_params();
		$this->set_param('colors', self::$_colors);
		$this->set_param('selected_color', $this->_selected_color);
		
	}
}
