<?php

require_once dirname( __FILE__ ) . '/../application/EntryCollectionIterator.php';

/**
 * Test class for EntryCollectionIterator.
 */
class EntryCollectionIteratorTest extends PHPUnit_Framework_TestCase
{
	/**
	 * EntryCollectionIterator instance.
	 * 
	 * @var EntryCollectionIterator
	 */
	protected $entry_collection_iterator_object;
	
	/**
	 * Reflection object for EntryCollectionIterator class.
	 * 
	 * @var ReflectionClass
	 */
	protected $entry_collection_iterator_reflection;
	
	/**
	 * Sets up data before each test.
	 */
	protected function setUp()
	{
		$entry_items_dummy = self::provideEntryItemsDummy();
		
		$this->entry_collection_iterator_object = new EntryCollectionIterator($entry_items_dummy);
		$this->entry_collection_iterator_reflection = new ReflectionClass('EntryCollectionIterator');
	}
	
	/**
	 * Provide dummy of the entry_items EntryCollectionIterator property.
	 * 
	 * @return array
	 */
	private static function provideEntryItemsDummy()
	{
		$dummy = array (
			'one',
			'two',
			'three'
		);
		
		return $dummy;
	}
	
	/*
	 * Tests.
	 */
	
	// Test for the constructor.
	
	public function test_constructor_returnsInstanceOf_EntryCollectionIterator()
	{
		$this->assertInstanceOf('EntryCollectionIterator', $this->entry_collection_iterator_object);
	}
	
	// Tests for the initial values of EntryCollectionIterator properties.
	
	public function test_entry_items_isInitiallyArray()
	{
		$entry_collection_iterator_property = $this->entry_collection_iterator_reflection->getProperty('entry_items');
		$entry_collection_iterator_property->setAccessible(true);
		
		$this->assertInternalType('array', $entry_collection_iterator_property->getValue($this->entry_collection_iterator_object));
	}
	
	public function test_entry_items_haveInitiallyProperValue()
	{
		$entry_collection_iterator_property = $this->entry_collection_iterator_reflection->getProperty('entry_items');
		$entry_collection_iterator_property->setAccessible(true);
		
		$expected_entry_items = self::provideEntryItemsDummy();
		$actual_entry_items = $entry_collection_iterator_property->getValue($this->entry_collection_iterator_object);
		
		$this->assertEquals($expected_entry_items, $actual_entry_items);
	}
	
	// Tests for the methods.
	
	public function test_current_returnsProperValue()
	{
		$entry_items_dummy = self::provideEntryItemsDummy();
		
		$expected_value = $entry_items_dummy[0];
		$actual_value = $this->entry_collection_iterator_object->current();
		
		$this->assertEquals($expected_value, $actual_value);
	}
	
	public function test_move_actsProperly()
	{
		$entry_collection_iterator_property = $this->entry_collection_iterator_reflection->getProperty('entry_items');
		$entry_collection_iterator_property->setAccessible(true);
		
		$entry_items_dummy = self::provideEntryItemsDummy();
		
		$this->entry_collection_iterator_object->next();
		
		$expected_value = $entry_items_dummy[1];
		$actual_value = current($entry_collection_iterator_property->getValue($this->entry_collection_iterator_object));
		
		$this->assertEquals($expected_value, $actual_value);
	}
	
	public function test_key_returnsProperValue()
	{
		$entry_items_dummy = self::provideEntryItemsDummy();
		
		$expected_value = key($entry_items_dummy);
		$actual_value = $this->entry_collection_iterator_object->key();
		
		$this->assertEquals($expected_value, $actual_value);
	}
	
	public function test_valid_returnsTrue_whenPositionIsValid()
	{
		$this->assertTrue($this->entry_collection_iterator_object->valid());	
	}
	
	public function test_rewind_actsProperly()
	{
		$entry_items_dummy = self::provideEntryItemsDummy();
		
		next($entry_items_dummy);
		
		$entry_collection_iterator_property = $this->entry_collection_iterator_reflection->getProperty('entry_items');
		$entry_collection_iterator_property->setAccessible(true);
		$entry_collection_iterator_property->setValue($this->entry_collection_iterator_object, $entry_items_dummy);
		
		$this->entry_collection_iterator_object->rewind();
		
		$expected_value = $entry_items_dummy[0];
		$actual_value = current($entry_collection_iterator_property->getValue($this->entry_collection_iterator_object));
		
		$this->assertEquals($expected_value, $actual_value);
	}
}