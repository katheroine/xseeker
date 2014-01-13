<?php

require_once dirname( __FILE__ ) . '/../application/View.php';

/**
 * Test class for View.
 */
class ViewTest extends PHPUnit_Framework_TestCase
{
	/**
	 * View clean instance.
	 * 
	 * @var View
	 */
	protected $view_object;
	
	/**
	 * Reflection object for View class.
	 * 
	 * @var ReflectionClass
	 */
	protected $view_reflection;
	
	/**
	 * Sets up data before each test.
	 */
	protected function setUp()
	{
		$this->view_object = new View;
		$this->view_reflection = new ReflectionClass('View');
	}
	
	/*
	 * Tests.
	 */
	
	// Test for the constructor.
	
	public function test_constructor_returnsInstanceOf_View()
	{
		$this->assertInstanceOf('View', $this->view_object);
	}
	
	// Tests for the initial values of EntryItem properties.
	
	public function test_view_parameters_isInitiallyArray()
	{
		$view_property = $this->view_reflection->getProperty('view_parameters');
		$view_property->setAccessible(true);
		
		$this->assertInternalType('array', $view_property->getValue($this->view_object));
	}
	
	public function test_view_parameters_isInitiallyEmpty()
	{
		$view_property = $this->view_reflection->getProperty('view_parameters');
		$view_property->setAccessible(true);
		
		$this->assertEmpty($view_property->getValue($this->view_object));
	}
	
	// Test for bulidViewPath method.
	
	public function test_bulidViewPath_returnsProperValue()
	{
		$view_method = $this->view_reflection->getMethod('bulidViewPath');
		$view_method->setAccessible(true);
		
		$expected_value = "/media/sun/localhost/xseeker/application/views/layout.php";
		$actual_value = $view_method->invoke($this->view_object);
		
		$this->assertEquals($expected_value, $actual_value);
	}
	
	// Test for magic setter method.
	
	public function test_magic__set_setsProperlyValuesOf_view_properties()
	{
		$view_property = $this->view_reflection->getProperty('view_parameters');
		$view_property->setAccessible(true);
		
		$expected_value = 1024;
		
		$this->view_object->number = $expected_value;
		
		$view_parameters = $view_property->getValue($this->view_object);
		
		$actual_value = $view_parameters['number'];
		
		$this->assertEquals($expected_value, $actual_value);
	}
}