<?php

require_once __DIR__ . '/ViewHelper.php';

/**
 * The View class manages view files.
 * 
 * @package XSeeker
 * @author Katarzyna Krasińska <katarzyna.krasinska@onet.pl>
 */
class View
{
	/**
	 * Layout file name.
	 */
	const LAYOUT_FILE = 'layout.php';
	
	/**
	 * Views directory.
	 */
	const VIEWS_DIRECTORY = 'views';
	
	/**
	 * Data passed to the view.
	 * 
	 * @var array
	 */
	private $view_parameters = array();
	
	public function __set($name, $value)
	{
		$this->view_parameters[$name] = $value;
	}
	
	/**
	 * Render view file specified by the argument.
	 * 
	 * @param string $view
	 */
	public function render($view)
	{
		foreach( $this->view_parameters as $parameter_key => $parameter_value )
		{
			$$parameter_key = $parameter_value;
		}
		
		$view_path = self::bulidViewPath();
		require_once $view_path;
	}
	
	/**
	 * Bulid view file path.
	 * 
	 * @return string
	 */
	private static function bulidViewPath()
	{
		return __DIR__ . '/' . self::VIEWS_DIRECTORY . '/' . self::LAYOUT_FILE;
	}
}
