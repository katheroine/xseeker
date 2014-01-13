<?php

/**
 * ViewHelper class implements view helper for the application view.
 * 
 * @package XSeeker
 * @author Katarzyna Krasińska <katarzyna.krasinska@onet.pl>
 */
class ViewHelper
{
	const EMPHASIZING_CSS_CLASS = 'keyword';
	
	/**
	 * Find keyword in content and emphasize by CSS class.
	 */
	public static function emphasizeKeywordInContent($keyword, $content)
	{
		$open_tag = '<span class="' . self::EMPHASIZING_CSS_CLASS . '">';
		$close_tag = '</span>';
		
		$keyword_beginning = strpos($content, $keyword);
		$keyword_end = $keyword_beginning + strlen($keyword) + strlen($open_tag);

		$content = substr_replace($content, $open_tag, $keyword_beginning, 0);
		$content = substr_replace($content, $close_tag, $keyword_end, 0);
		
		return $content;
	}
}