<?php


namespace BoardingCards\TripSorter\Transportation;

class Bus extends AbstractTransportation
{
    const MESSAGE = 'Take the airport bus from %1$s to %2$s. No seat assignment.';

    /**
     * @return string
     */
    public function getMessage()
    {
        return sprintf(
            static::MESSAGE,
            $this->departure,
            $this->arrival
        );
    }
}
