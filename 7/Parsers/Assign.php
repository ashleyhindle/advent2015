<?php
namespace Parsers;

class Assign implements ParserInterface
{
    private $regex = '/^(?<value>[0-9a-z]{1,5}) -> (?<assignee>[a-z]{1,3})/';

    public function canParse($command)
    {
        return (preg_match($this->regex, $command) === 1);
    }

    public function parse($command)
    {
        preg_match($this->regex, $command, $matches);
        $matches = array_intersect_key($matches, array_flip(['value', 'assignee']));
        $matches['type'] = 'ASSIGN';

        return $matches;
    }
}