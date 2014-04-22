<?php

namespace Velocity;

/**
 * Class Parser
 *
 * @package Velocity
 */
class Parser
{
    const SINGLE_LINE_COMMENT_REGEXP = '/^##/';
    const MULTI_LINE_COMMENT_REGEXP = '/^#\*.*\*#$/s';

    /**
     * @param $string
     *
     * @return bool
     */
    public function isSingleLineComment($string)
    {
        return is_string($string) and preg_match(self::SINGLE_LINE_COMMENT_REGEXP, $string);
    }

    /**
     * @param $string
     *
     * @return bool
     */
    public function isMultiLineComment($string)
    {
        return is_string($string) and preg_match(self::MULTI_LINE_COMMENT_REGEXP, $string);
    }

    public function getCommentContent($string)
    {
        if ($this->isSingleLineComment($string)) {
            $string = str_replace('## ','', $string);
            return $string;
        }

        if ($this->isMultiLineComment($string)) {
            $string = preg_replace('/^(#\*)(.*)(\*#)$/s','$2', $string);
            return trim($string);
        }
    }
}
