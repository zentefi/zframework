<?php 

class HTMLControlStaticLibrarySelect2 extends HTMLControlStaticLibrary {
	
	
	public function get_library_js_files() {

		$language_code = LanguageHelper::get_current_language_code();

		return array(
			URLHelper::get_zframework_static_url('thirdparty/select2/select2.custom.js'),
			URLHelper::get_zframework_static_url("thirdparty/select2/select2_locale_{$language_code}.js"),
		);
	}
	
	public function get_library_css_files() {

		return array(URLHelper::get_zframework_static_url('thirdparty/select2/select2.css'));
	}

	public function get_dependence_libraries() {
		return array(self::STATIC_LIBRARY_ZSCRIPT);
	}
}