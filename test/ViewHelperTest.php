<?php

require_once dirname( __FILE__ ) . '/../application/ViewHelper.php';

/**
 * Test class for ViewHelper.
 */
class ViewHelperTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Text for tests before keyword emphasizing.
	 */
	const TEST_CONTENT_BEFORE = 'Za nami czwarta już edycja PHPCon Poland – na konferencję zespół XSolve przybył tłumnie, warto więc podsumować to wydarzenie krótkim komentarzem.';
	
	/**
	 * Text for tests after keyword emphasizing.
	 */
	const TEST_CONTENT_AFTER = 'Za nami czwarta już edycja <span class="keyword">PHP</span>Con Poland – na konferencję zespół XSolve przybył tłumnie, warto więc podsumować to wydarzenie krótkim komentarzem.';

	/*
	 * Tests.
	 */
	
	// Test for the emphasizeKeywordInContent method.
	
	public function test_emphasizeKeywordInContent_actsProperly()
	{
		$content = self::TEST_CONTENT_BEFORE;
		
		$expected_value = self::TEST_CONTENT_AFTER;
		$actual_value = ViewHelper::emphasizeKeywordInContent('PHP', $content);
		
		$this->assertEquals($expected_value, $actual_value);
	}
}