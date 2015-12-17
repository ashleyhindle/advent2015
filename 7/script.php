<?php
require_once __DIR__ . '/vendor/autoload.php';

$lines = file(__DIR__ . '/input', FILE_IGNORE_NEW_LINES);

$processedIndexes = [];
$circuit = new Circuit();
$loopCount = 0;

do {
    foreach ($lines as $key => $command) {
        if (in_array($key, $processedIndexes)) {
            continue; // Already processed - this will make it slow, but hey! :)
        }

        $result = false;
        $cmd = (new CommandParser($command))->getCommand();
        $assignee = new Wire($cmd['assignee']);

        switch ($cmd['type']) {
            case 'ASSIGN':
                if (is_numeric($cmd['value'])) {
                    $result = $cmd['value'];
                } else {
                    $wire1 = $circuit->getWire($cmd['value']);
                    if ($wire1 === false) {
                        break;
                    }

                    $result = $wire1->getSignal();
                }
                break;
            case 'AND':
                if (is_numeric($cmd['wires'][0])) {
                    $wire1 = new Wire('zz', $cmd['wires'][0]);
                    $wire2 = $circuit->getWire($cmd['wires'][1]);
                } else {
                    $wire1 = $circuit->getWire($cmd['wires'][0]);
                    $wire2 = $circuit->getWire($cmd['wires'][1]);
                }

                if ($wire1 === false || $wire2 === false) {
                    break;
                }

                $result = $wire1->getSignal() & $wire2->getSignal();
                break;
            case 'OR':
                if (is_numeric($cmd['wires'][0])) {
                    $wire1 = new Wire('zz', $cmd['wires'][0]);
                    $wire2 = $circuit->getWire($cmd['wires'][1]);
                } else {
                    $wire1 = $circuit->getWire($cmd['wires'][0]);
                    $wire2 = $circuit->getWire($cmd['wires'][1]);
                }

                if ($wire1 === false || $wire2 === false) {
                    break;
                }

                $result = $wire1->getSignal() | $wire2->getSignal();
                break;
            case 'LSHIFT':
                $wire1 = $circuit->getWire($cmd['wires'][0]);

                if ($wire1 === false) {
                    break;
                }

                $result = $wire1->getSignal() << (int)$cmd['value'];
                break;
            case 'RSHIFT':
                $wire1 = $circuit->getWire($cmd['wires'][0]);

                if ($wire1 === false) {
                    break;
                }

                $result = $wire1->getSignal() >> (int)$cmd['value'];
                break;
            case 'NOT':
                $wire1 = $circuit->getWire($cmd['wires'][0]);

                if ($wire1 === false) {
                    break;
                }

                $result = ~$wire1->getSignal();
                break;
        }

        if ($result !== false) {
            $assignee->setSignal($result);
            $circuit->addWire($assignee);
            $processedIndexes[] = $key;
        }
    }
} while (count($lines) > count($processedIndexes) && ++$loopCount < 1000);

echo 'Answer: A: ' . $circuit->getWire('a')->getSignal() . PHP_EOL;