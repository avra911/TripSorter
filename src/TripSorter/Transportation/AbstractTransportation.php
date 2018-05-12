<?php


namespace BoardingCards\TripSorter\Transportation;

abstract class AbstractTransportation implements TransportationInterface
{
    protected $departure;

    protected $arrival;

    const MESSAGE_FINAL_DESTINATION = 'You have arrived at your final destination.';

    /**
     * AbstractTransportation constructor.
     * @param array $trip
     */
    public function __construct(array $trip)
    {
        foreach ($trip as $key => $value) {
            $property = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));

            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}
