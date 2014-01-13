<?php

require_once __DIR__ . '/Controller.php';

/**
 * The Router class implements simple routing for the application.
 * 
 * @package XSeeker
 * @author Katarzyna Krasińska <katarzyna.krasinska@onet.pl>
 */
class Router
{
	/**
	 * Current request application internal path.
	 * 
	 * @var string
	 */
	private $path;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->setUpPath();
	}
	
	/**
	 * Set up path.
	 */
	private function setUpPath()
	{
		$request_uri = $_SERVER['REQUEST_URI'];
		$uri_components = parse_url($request_uri);
		
		$this->path = $uri_components['path'];
	}
	
	/**
	 * Run routing according to path.
	 */
	public function run()
	{
		switch ($this->path)
		{
			case '/':
				$controller = new Controller;
				$controller->index();
				break;
			case '/search':
				$controller = new Controller;
				$controller->search();
				break;
			default:
				require_once __DIR__ . '/views/404.html';
				header("HTTP/1.0 404 Not Found");
				break;
		}
	}
}