<?php
namespace Parsers;

interface ParserInterface
{
    public function canParse($command);
    public function parse($command);
}