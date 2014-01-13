<?php

/**
 * EntryItem class representing part of data of the single RSS feed entry.
 * 
 * @package XSeeker
 * @author Katarzyna Krasińska <katarzyna.krasinska@onet.pl>
 */
class EntryItem
{	
	/**
	 * URL of the entry on source page.
	 * 
	 * @var string
	 */
	public $link;
	
	/**
	 * Date the entry has been created at.
	 * 
	 * @var string
	 */
	public $date;
	
	/**
	 * The entry title.
	 *
	 * @var string
	 */
	public $title;
	
	/**
	 * The entry description.
	 *
	 * @var string
	 */
	public $description;
	
	/**
	 * Constructor.
	 * 
	 * @param SimpleXMLElement $rss_content_item
	 */
	private function __construct(SimpleXMLElement $rss_content_item)
	{
		$this->setUpFromRssContentItem($rss_content_item);
	}
	
	/**
	 * Set up instance parameters by RSS content item parameters.
	 * 
	 * @param SimpleXMLElement $rss_content_item
	 */
	private function setUpFromRssContentItem(SimpleXMLElement $rss_content_item)
	{
		$this->link = (string) $rss_content_item->link;
		$this->date = (string) $rss_content_item->date;
		$this->title = (string) $rss_content_item->title;
		$this->description = (string) $rss_content_item->description;
	}
	
	/**
	 * Build entry from RSS content item.
	 * 
	 * @param SimpleXMLElement $rss_content_item
	 * @return EntryItem
	 */
	public static function buildFromRSSContentItem(SimpleXMLElement $rss_content_item)
	{
		return new EntryItem($rss_content_item);
	}
	
	/**
	 * Indicate keyword has been found in the description.
	 * 
	 * @param string $keyword
	 * @return boolean
	 */
	public function keywordFound($keyword)
	{
		return (bool) strpos($this->description, $keyword);
	}
}