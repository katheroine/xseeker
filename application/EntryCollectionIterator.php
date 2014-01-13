<?php

/**
 * EntryCollectionIterator class is iterator for EntryCollection.
 * 
 * @package XSeeker
 * @author Katarzyna Krasińska <katarzyna.krasinska@onet.pl>
 */
class EntryCollectionIterator implements Iterator
{
	/**
	 * Stored EntryItem instances.
	 *
	 * @var array
	 */
	private $entry_items;
	
	/**
	 * Constructor.
	 * 
	 * @param array $entry_items
	 */
	public function __construct($entry_items)
	{
		if (is_array($entry_items))
		{
			$this->entry_items = $entry_items;
		}
	}
	
	/**
	 * Return the current element.
	 * 
	 * @return mixed
	 */
	public function current()
	{
		return current($this->entry_items);
	}
	
	/**
	 * Move forward to next element.
	 */
	public function next() 
	{
		next($this->entry_items);
	}
	
	/**
	 * Return the key of the current element.
	 * 
	 * @return scalar
	 */
	public function key() 
	{
		return key($this->entry_items);
	}
	
	/**
	 * Checks if current position is valid.
	 * 
	 * @return boolean
	 */
	public function valid()
	{
		$key = key($this->entry_items);
		return ($key !== NULL && $key !== FALSE);
	}

	/**
	 * Rewind the Iterator to the first element.
	 */
	public function rewind()
	{
		reset($this->entry_items);
	}
}