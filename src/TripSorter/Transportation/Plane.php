<?php


namespace BoardingCards\TripSorter\Transportation;

class Plane extends AbstractTransportation
{
    protected $transportationNumber;

    protected $seat;

    protected $gate;

    protected $baggage;

    const MESSAGE = 'From %1$s take flight %2$s to %3$s. Gate %4$s, seat %5$s. %6$s.';
    const _BAGGAGE_TICKET = 'Baggage drop at ticket counter %s';
    const _NO_BAGGAGE_TICKET = 'Baggage will we automatically transferred from your last leg';

    /**
     * @return string
     */
    public function getMessage()
    {
        return sprintf(
            static::MESSAGE,
            $this->departure,
            $this->transportationNumber,
            $this->arrival,
            $this->gate,
            $this->seat,
            sprintf(!empty($this->baggage) ? static::_BAGGAGE_TICKET : static::_NO_BAGGAGE_TICKET, $this->baggage)
        );
    }
}
