<?php

require_once __DIR__ . '/EntryItem.php';
require_once __DIR__ . '/EntryCollectionIterator.php';

/**
 * EntryItemCollection class representing collection of EntryItem instances.
 * 
 * @package XSeeker
 * @author Katarzyna Krasińska <katarzyna.krasinska@onet.pl>
 */
class EntryCollection implements IteratorAggregate, Countable
{
	/**
	 * Stored EntryItem instances.
	 *
	 * @var array
	 */
	private $entry_items = array();
	
	/**
	 * Constructor.
	 * 
	 * @param SimpleXMLElement $rss_content
	 */
	private function __construct(SimpleXMLElement $rss_content)
	{
		$rss_content_items = $rss_content->channel->item;
		
		foreach ($rss_content_items as $rss_content_item)
		{
			$this->addFromRssContentItem($rss_content_item);
		}
	}
	
	/**
	 * Return instance of EntryCollection
	 * 
	 * @param SimpleXMLObject $rss_content
	 * @return EntryCollection
	 */
	public static function buildFromRSSContent(SimpleXMLElement $rss_content)
	{
		return new EntryCollection($rss_content);
	}
	
	/**
	 * Returns iterator.
	 * 
	 * @return EntryCollectionIterator
	 */
	public function getIterator()
	{
		return new EntryCollectionIterator($this->entry_items);
	}
	
	/**
	 * Return number of stored EntryItem instances.
	 * 
	 * @return int
	 */
	public function count()
	{
		return count($this->entry_items);
	}
	
	/**
	 * Add entry to the collection if the keyword has been found.
	 * 
	 * @param SimpleXMLObject $rss_content_item
	 */
	private function addFromRssContentItem(SimpleXMLElement $rss_content_item)
	{
		$entry_item = EntryItem::buildFromRSSContentItem($rss_content_item);
		array_push($this->entry_items, $entry_item);
	}
	
	/**
	 * Return new EntryCollection instance with entry items descriptions filtered by the keyword. 
	 * 
	 * @param string $keyword
	 * @return EntryCollection
	 */
	public function filterByKeyword($keyword)
	{
		$filtered_entry_collection = clone $this;

		$filtered_entries = array();
		
		foreach ($this->entry_items as $entry_item)
		{
			if ($entry_item->keywordFound($keyword))
			{
				array_push($filtered_entries, $entry_item);
			}
		}
		
		$filtered_entry_collection->entry_items = $filtered_entries;
		
		return $filtered_entry_collection;
	}
	
	/**
	 * Returns new EntryCollection instance with limited number of entry items.
	 * 
	 * @param int $limit
	 * @return EntryCollection
	 */
	public function limit($limit)
	{
		$limited_entry_collection = clone $this;
		
		$entry_items_parts = array_chunk($this->entry_items, $limit);
		$limited_entry_collection->entry_items = $entry_items_parts[0];
		
		return $limited_entry_collection;
	}
}