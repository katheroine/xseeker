<?php

require_once __DIR__ . '/Entry.php';
require_once __DIR__ . '/View.php';

/**
 * The Controller class implements simple controller for the application.
 * 
 * @package XSeeker
 * @author Katarzyna Krasińska <katarzyna.krasinska@onet.pl>
 */
class Controller
{
	/**
	 * Limit of the displayed entries.
	 */
	const ENTRY_LIMIT = 5;
	
	/**
	 * Index action.
	 * Renders view with search input and the welcome message.
	 */
	public function index()
	{
		$view = new View;
		$view->render('index');
	}
	
	/**
	 * Search action.
	 * Renders view with search input and results of current search.
	 */
	public function search()
	{
		$keyword = $_GET['keyword'];
		
		$entry_items = Entry::withKeyword($keyword)->limit(self::ENTRY_LIMIT);
				
		$view = new View;
		$view->keyword = $keyword;
		$view->entry_items = $entry_items;
		$view->render('search');
	}
}