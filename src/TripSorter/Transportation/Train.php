<?php


namespace BoardingCards\TripSorter\Transportation;

class Train extends AbstractTransportation
{
    protected $transportationNumber;

    protected $seat;

    const MESSAGE = 'Take train %1$s from %2$s to %3$s. Sit in seat %4$s.';

    /**
     * @return string
     */
    public function getMessage()
    {
        return sprintf(
            static::MESSAGE,
            $this->transportationNumber,
            $this->departure,
            $this->arrival,
            $this->seat
        );
    }
}
