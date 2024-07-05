<?php

namespace mskarbek48\teamspeakframework\Adapter;

abstract class AbstractTeamSpeakAdapter
{
    protected function escapeText($text) {
        $text = str_replace("\t", '\t', $text);
        $text = str_replace("\v", '\v', $text);
        $text = str_replace("\r", '\r', $text);
        $text = str_replace("\n", '\n', $text);
        $text = str_replace("\f", '\f', $text);
        $text = str_replace(' ', '\s', $text);
        $text = str_replace('|', '\p', $text);
        $text = str_replace('/', '\/', $text);
        return $text;
    }

    protected function unEscapeText($text) {
        $escapedChars = array("\t", "\v", "\r", "\n", "\f", "\s", "\p", "\/");
        $unEscapedChars = array('', '', '', '', '', ' ', '|', '/');
        $text = str_replace($escapedChars, $unEscapedChars, $text);
        return $text;
    }
	
	protected function convertToArray(string $string): array
	{
		$returnArray = [];
		$matches = explode(" ", $string);
		foreach($matches as $match)
		{
			$elements = explode("=", $match, 2);
			if(strlen($this->unEscapeText($elements[0])))
			{
				if(isset($elements[1]))
				{
					$returnArray[$this->unEscapeText($elements[0])] = $this->unEscapeText($elements[1]);
				} else {
					$returnArray[$this->unEscapeText($elements[0])] = "";
				}
			}
		}
		return $returnArray;
	}
}