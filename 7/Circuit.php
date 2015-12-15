<?php

class Circuit
{
    /**
     * @var array
     */
    private $wires = [];

    public function addWire(Wire $wire)
    {
        $this->wires[$wire->getIdentifier()] = $wire;

        return true;
    }

    public function getWires($wires=false)
    {
        if (is_array($wires)) {
            return array_values(array_intersect_key($this->getWires(), array_flip($wires)));
        } else {
            return $this->wires;
        }
    }

    public function getWire($identifier)
    {
        if (!array_key_exists($identifier, $this->getWires())) {
            return false;
        }

        return $this->wires[$identifier];
    }
}