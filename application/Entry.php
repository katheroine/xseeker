<?php

require_once __DIR__ . '/EntryItem.php';
require_once __DIR__ . '/EntryCollection.php';

/**
 * Entry model class for the XLab RSS feed entries.
 * 
 * @package XSeeker
 * @author Katarzyna Krasińska <katarzyna.krasinska@onet.pl>
 */
class Entry
{
	/**
	 * XLab RSS channel URL.
	 */
	const RSS_FEED_URL = 'http://xlab.pl/feed/';
	
	/**
	 * Load RSS feed entries and return its collection.
	 * 
	 * @return EntryCollection
	 */
	private static function loadEntryCollection()
	{
		$rss_content = simplexml_load_file(self::RSS_FEED_URL);
		$entry_collection = EntryCollection::buildFromRSSContent($rss_content);
		
		return $entry_collection;
	}

	/**
	 * Return all the RSS feed entries.
	 * 
	 * @return EntryCollection
	 */
	public static function all()
	{
		return self::loadEntryCollection();
	}
	
	/**
	 * Return only RSS feed entries with the keyword found in their description.
	 * 
	 * @param string $keyword
	 * @return EntryCollection
	 */
	public static function withKeyword($keyword)
	{
		$entry_collection = self::loadEntryCollection();
		return $entry_collection->filterByKeyword($keyword);
	}
}