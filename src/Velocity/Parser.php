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
     * @param $comment
     *
     * @return bool
     */
    public function isSingleLineComment($comment)
    {
        return is_string($comment) and preg_match(self::SINGLE_LINE_COMMENT_REGEXP, $comment);
    }

    /**
     * @param $comment
     *
     * @return bool
     */
    public function isMultiLineComment($comment)
    {
        return is_string($comment) and preg_match(self::MULTI_LINE_COMMENT_REGEXP, $comment);
    }

    /**
     * @param null $comment
     *
     * @return null|string
     */
    public function getCommentContent($comment)
    {
        $commentContent = null;

        if ($this->isSingleLineComment($comment)) {
            $regexp = '/(##)(.*)(?s:.*)/';
        } elseif ($this->isMultiLineComment($comment)) {
            $regexp = '/(#\*)(.*)(\*#)/s';
        }

        if (isset($regexp)) {
            $commentContent = trim(preg_replace($regexp,'$2', $comment));
        }

        return $commentContent;
    }
}
