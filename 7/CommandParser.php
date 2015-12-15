<?php
// I'm not this clever - http://stackoverflow.com/questions/4260086/php-how-to-use-array-filter-to-filter-array-keys

class CommandParser
{
    private $command = [];
    private $parsers = [
        'Assign',
        'AndOrNot',
        'Shift',
    ];

    public function __construct($command)
    {
        foreach ($this->parsers as $name) {
            $parserName = 'Parsers\\' . $name;
            $parser = new $parserName();
            if ($parser->canParse($command)) {
                $this->command = $parser->parse($command);
                break;
            }
        }

        if (empty($this->command)) {
            throw new InvalidArgumentException('Command not parseable by available parsers: ' . implode(', ', $this->parsers));
        }
    }

    /**
     * @return array
     */
    public function getCommand()
    {
        return $this->command;
    }
}