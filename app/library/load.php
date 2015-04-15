<?php

class Load {

	/**
	* Load a library from app/library
	*
	* @param		string	- the path / name of the file
	* @return	bool	- true if included, false otherwise (from include_once)
	* @access	public
	*/
	public static function library($path) {
		return include_once(app_path() . '/library/Helper/' . $path . '.php');
	}

	/**
	* Loads Markdown into a controller
	*
	* @param		bool	— false if assets shouldn't be loaded
	* @access	public
	*/
	public static function markdown($assets = true) {
		self::library('markdown/markdown');

		if ($assets === true) {
                    HTML::script('js/markdown/Markdown.Converter.js');
                    HTML::script('js/markdown/Markdown.Sanitizer.js');
                    HTML::script('js/markdown/Markdown.Editor.js');
			
		}
	}
}