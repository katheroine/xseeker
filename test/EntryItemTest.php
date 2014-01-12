<?php

require_once dirname( __FILE__ ) . '/../application/EntryItem.php';

/**
 * Test class for EntryItem.
 */
class EntryItemTest extends PHPUnit_Framework_TestCase
{
	/**
	 * RSS feed item tag content.
	 */
	const RSS_FEED_ITEM_DATA = "<item><title>Hello world!</title><link>http://null.com/</link><date>Thu, 05 Dec 2013 12:50:45 +0000</date><description><![CDATA[Programmers' greeting.]]></description></item>";
	
	/**
	 * Values of RSS feed item parameters.
	 */
	const RSS_FEED_ITEM_LINK = "http://null.com/";
	const RSS_FEED_ITEM_DATE = "Thu, 05 Dec 2013 12:50:45 +0000";
	const RSS_FEED_ITEM_TITLE = "Hello world!";
	const RSS_FEED_ITEM_DESCRIPTION = "Programmers' greeting.";
	
	/**
	 * EntryItem clean instance.
	 * 
	 * @var EntryItem
	 */
	protected $entry_item_object;
	
	/**
	 * Sets up data before each test.
	 */
	protected function setUp()
	{
		$rss_content_item = self::provideRSSContentItem();
		
		$this->entry_item_object = EntryItem::buildFromRSSContentItem($rss_content_item);
	}
	
	/**
	 * Return SimpleXMLElement instance with proper data.
	 * 
	 * @return SimpleXMLElement
	 */
	private static function provideRSSContentItem()
	{
		return new SimpleXMLElement(self::RSS_FEED_ITEM_DATA);
	}
	
	/*
	 * Tests.
	 */
	
	// Test for the builder.
	
	public function test_builder_returnsInstanceOf_EntryItem()
	{
		$this->assertInstanceOf('EntryItem', $this->entry_item_object);
	}
	
	// Tests for the initial values of EntryItem properties.
	
	public function test_link_isInitiallyString()
	{
		$this->assertInternalType('string', $this->entry_item_object->link);
	}
	
	public function test_link_hasInitiallyProperValue()
	{
		$expected_value = self::RSS_FEED_ITEM_LINK;
		$actual_value = $this->entry_item_object->link;
		
		$this->assertEquals($expected_value, $actual_value);
	}
	
	public function test_date_isInitiallyString()
	{
		$this->assertInternalType('string', $this->entry_item_object->date);
	}
	
	public function test_date_hasInitiallyProperValue()
	{
		$expected_value = self::RSS_FEED_ITEM_DATE;
		$actual_value = $this->entry_item_object->date;
		
		$this->assertEquals($expected_value, $actual_value);
	}
	
	public function test_title_isInitiallyString()
	{
		$this->assertInternalType('string', $this->entry_item_object->title);
	}
	
	public function test_title_hasInitiallyProperValue()
	{
		$expected_value = self::RSS_FEED_ITEM_TITLE;
		$actual_value = $this->entry_item_object->title;
		
		$this->assertEquals($expected_value, $actual_value);
	}
	
	public function test_description_isInitiallyString()
	{
		$this->assertInternalType('string', $this->entry_item_object->description);
	}
	
	public function test_description_hasInitiallyProperValue()
	{
		$expected_value = self::RSS_FEED_ITEM_DESCRIPTION;
		$actual_value = $this->entry_item_object->description;
		
		$this->assertEquals($expected_value, $actual_value);
	}
	
	// Tests for the keywordFound method.
	
	public function test_keywordFound_findsExistentKeywordInDescription()
	{
		$keyword = 'greeting';
		
		$this->assertTrue($this->entry_item_object->keywordFound($keyword));
	}
	
	public function test_keywordFound_findsNonexistentKeywordInDescription()
	{
		$keyword = 'developers';
		
		$this->assertFalse($this->entry_item_object->keywordFound($keyword));
	}
}