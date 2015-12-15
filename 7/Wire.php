<?php

class Wire
{

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var int
     */
    private $signal;

    public function __construct($identifier=false, $signal=0)
    {
        $this->identifier = $identifier;
        $this->signal = $signal;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return int
     */
    public function getSignal()
    {
        return (int) $this->signal;
    }

    /**
     * @param int $signal
     */
    public function setSignal($signal)
    {
        if ($signal < 0) {
            $this->signal = $signal + 65536;
        } elseif($signal > 65535) {
            $this->signal = $signal - 65536;
        } else {
            $this->signal = $signal;
        }
    }

}