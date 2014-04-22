<?php

namespace spec\Velocity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ParserSpec
 *
 * @package spec\Velocity
 */
class ParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Velocity\Parser');
    }

    function it_detects_single_line_comments_correctly()
    {
        $this->isSingleLineComment('##')->shouldReturn(true);
        $this->isSingleLineComment('## string')->shouldReturn(true);

        $this->isSingleLineComment('# string')->shouldReturn(false);
        $this->isSingleLineComment(false)->shouldReturn(false);
        $this->isSingleLineComment(true)->shouldReturn(false);
        $this->isSingleLineComment(new \stdClass())->shouldReturn(false);
        $this->isSingleLineComment(0)->shouldReturn(false);
        $this->isSingleLineComment(0.0)->shouldReturn(false);
    }

    function it_detects_multi_line_comments_correctly()
    {
        $string = "#*
        foo
        *#";
        $this->isMultiLineComment($string)->shouldReturn(true);

        $string = "#**#";
        $this->isMultiLineComment($string)->shouldReturn(true);

        $string = "#*
        *#";
        $this->isMultiLineComment($string)->shouldReturn(true);

        $this->isMultiLineComment('##')->shouldReturn(false);
        $this->isMultiLineComment(111)->shouldReturn(false);
        $this->isMultiLineComment('# string')->shouldReturn(false);
        $this->isMultiLineComment(false)->shouldReturn(false);
        $this->isMultiLineComment(true)->shouldReturn(false);
        $this->isMultiLineComment(new \stdClass())->shouldReturn(false);
        $this->isMultiLineComment(0)->shouldReturn(false);
        $this->isMultiLineComment(0.0)->shouldReturn(false);
    }

    function it_extracts_single_line_comments_content_correctly()
    {
        //TODO: more tests for single line comment extraction
        $this->getCommentContent('## foo')->shouldReturn('foo');
        $this->getCommentContent('## foo bar')->shouldReturn('foo bar');
        $this->getCommentContent("#**#")->shouldReturn('');
        $string = "#*
        a
        *#";
        $this->getCommentContent($string)->shouldReturn('a');
    }
}
