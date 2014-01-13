<?php

require_once dirname( __FILE__ ) . '/../application/Entry.php';

/**
 * Test class for Entry.
 */
class EntryTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Entry clean instance.
	 * 
	 * @var mixed
	 */
	protected $entry_object;
		
	/**
	 * Reflection for Entry class.
	 * 
	 * @var ReflectionClass
	 */
	protected $entry_reflection;
	
	/**
	 * Sets up data before each test.
	 */
	protected function setUp()
	{
		$this->entry_object = new Entry;
		$this->entry_reflection = new ReflectionClass( 'Entry' );
	}
	
	/**
	 * Indicates the keyword has been found in every EntryItem instance of the EntryCollection object.
	 * 
	 * @param type $keyword
	 * @param EntryCollection $entry_collection
	 * @return boolean
	 */
	private static function keywordFoundInAllItemsOfEntryCollection($keyword, EntryCollection $entry_collection)
	{
		foreach ($entry_collection as $entry_item)
		{
			$keyword_found = (bool) strpos($entry_item->description, $keyword);
			
			if (!$keyword_found)
			{
				return false;
			}
			
			return true;
		}
	}
	
	/*
	 * Tests.
	 */
	
	// Tests for loadEntryCollection method.
	
	public function test_loadEntryCollection_returnsEntryCollection()
	{
		$entry_method_name = 'loadEntryCollection';
				
		$entry_method = $this->entry_reflection->getMethod( $entry_method_name );
		$entry_method->setAccessible( true );
		
		$this->assertInstanceOf('EntryCollection', $entry_method->invoke( $this->entry_object ));
	}
	
	// Tests for all method.
	
	public function test_all_returnsEntryCollection()
	{
		$this->assertInstanceOf('EntryCollection', Entry::all());
	}
	
	public function test_all_returnsNotEmptyEntryCollection()
	{
		$this->assertGreaterThan(0, count(Entry::all()));
	}
	
	// Tests for withKeyword method.
	
	public function test_withKeyword_returnsEntryCollection()
	{
		$keyword = 'PHP';
		
		$this->assertInstanceOf('EntryCollection', Entry::withKeyword($keyword));
	}
	
	public function test_withKeyword_returnsNotEmptyEntryCollection_whenKeywordExists()
	{
		$keyword = 'PHP';
		
		$this->assertGreaterThan(0, count(Entry::withKeyword($keyword)));
	}
	
	public function test_withKeyword_returnsEmptyEntryCollection_whenKeywordDoesNotExists()
	{
		$keyword = 'unexistingkeyword';
		
		$this->assertEquals(0, count(Entry::withKeyword($keyword)));
	}
	
	public function test_withKeyword_returnsEntryCollection_withEntriesContainingKeyword()
	{
		$keyword = 'PHP';
		
		$this->assertTrue(self::keywordFoundInAllItemsOfEntryCollection($keyword, Entry::withKeyword($keyword)));
	}
}