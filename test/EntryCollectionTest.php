<?php

require_once dirname( __FILE__ ) . '/../application/EntryCollection.php';

/**
 * Test class for EntryCollection.
 */
class EntryCollectionTest extends PHPUnit_Framework_TestCase
{
	/**
	 * RSS channel URL.
	 */
	const RSS_FEED_URL = 'http://xlab.pl/feed/';
	
	/**
	 * EntryCollection instance.
	 * 
	 * @var EntryCollection
	 */
	protected $entry_collection_object;
	
	/**
	 * Reflection object for EntryCollection class.
	 * 
	 * @var ReflectionClass
	 */
	protected $entry_collection_reflection;
	
	/**
	 * Sets up data before each test.
	 */
	protected function setUp()
	{
		$rss_content = self::provideRSSContent();
		
		$this->entry_collection_object = EntryCollection::buildFromRSSContent($rss_content);
		$this->entry_collection_reflection = new ReflectionClass('EntryCollection');
	}
	
	/**
	 * Return SimpleXMLElement instance with proper data.
	 * 
	 * @return SimpleXMLElement
	 */
	private static function provideRSSContent()
	{
		return simplexml_load_file(self::RSS_FEED_URL);
	}
	
	/**
	 * Indicate keyword has been found in every item of the array.
	 * 
	 * @param type $entry_collection
	 * @param type $keyword
	 * @return bool
	 */
	private function entryCollectionContainsOnlyEntriesWithKeyword($entry_collection, $keyword)
	{
		$entry_collection_property = $this->entry_collection_reflection->getProperty('entry_items');
		$entry_collection_property->setAccessible( true );
		
		$entry_items = $entry_collection_property->getValue( $entry_collection );
		
		foreach($entry_items as $entry_item)
		{
			$keyword_found = self::keywordFoundInContent($keyword, $entry_item->description);
			
			if (!$keyword_found)
			{
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Indicate keyword has been found in content.
	 * 
	 * @param string $keyword
	 * @param string $content
	 * @return bool
	 */
	public static function keywordFoundInContent($keyword, $content)
	{
		return (bool) strpos($content, $keyword);
	}
	
	/*
	 * Tests.
	 */
	
	// Test for the builder.
	
	public function test_builder_returnsInstanceOf_EntryItem()
	{
		$this->assertInstanceOf('EntryCollection', $this->entry_collection_object);
	}
	
	// Tests for the initial values of EntryCollection properties.
	
	public function test_entry_items_isInitiallyArray()
	{
		$entry_collection_property = $this->entry_collection_reflection->getProperty('entry_items');
		$entry_collection_property->setAccessible(true);
		
		$this->assertInternalType('array', $entry_collection_property->getValue($this->entry_collection_object));
	}
	
	public function test_entry_items_hasProperNumberOfItems()
	{
		$rss_content = self::provideRSSContent();
		
		$entry_collection_property = $this->entry_collection_reflection->getProperty('entry_items');
		$entry_collection_property->setAccessible( true );
		
		$expected_number_of_items = count($rss_content->channel->item);
		$actual_number_of_items = count($entry_collection_property->getValue($this->entry_collection_object));
		
		$this->assertEquals($expected_number_of_items, $actual_number_of_items);
	}
	
	public function test_entry_items_containsOnlyInstancesOf_EntryItem()
	{
		$entry_collection_property = $this->entry_collection_reflection->getProperty('entry_items');
		$entry_collection_property->setAccessible(true);
		
		$this->assertContainsOnly('EntryItem', $entry_collection_property->getValue($this->entry_collection_object));
	}
	
	// Test for the methods of the implemented interfaces.
	
	public function test_getIteretor_returnsInstanceOf_EntryCollectionIterator()
	{
		$this->assertInstanceOf('EntryCollectionIterator', $this->entry_collection_object->getIterator());
	}
	
	public function test_classProperlyImplements_count_method()
	{
		$entry_collection_property = $this->entry_collection_reflection->getProperty('entry_items');
		$entry_collection_property->setAccessible(true);
		
		$expected_number_of_items = count($entry_collection_property->getValue($this->entry_collection_object));
		$actual_number_of_items = count($this->entry_collection_object);
		
		$this->assertEquals($expected_number_of_items, $actual_number_of_items);
	}
	
	// Tests for the methods.
	
	public function test_filterByKeyword_returnsInstanceOf_EntryCollection()
	{		
		$this->assertInstanceOf('EntryCollection', $this->entry_collection_object->filterByKeyword('PHP'));
	}
	
	public function test_filterByKeyword_returnsObject_withProperEntries()
	{
		$keyword = 'PHP';
		
		$filtered_entry_collection = $this->entry_collection_object->filterByKeyword($keyword);
		
		$this->assertTrue($this->entryCollectionContainsOnlyEntriesWithKeyword($filtered_entry_collection, $keyword));
	}
	
	public function test_limit_returnsInstanceOf_EntryCollection()
	{
		$this->assertInstanceOf('EntryCollection', $this->entry_collection_object->limit(3));
	}
	
	public function test_limit_returnsCollection_withProperNumberOfItems()
	{
		$limit = 3;
		
		$limited_entry_collection = $this->entry_collection_object->limit($limit);
		
		$entry_collection_property = $this->entry_collection_reflection->getProperty('entry_items');
		$entry_collection_property->setAccessible(true);
		
		$this->assertEquals($limit, count($entry_collection_property->getValue($limited_entry_collection)));
	}
}