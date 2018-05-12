<?php


namespace BoardingCards;

class TripSorter
{
    private $cards = array();

    protected static $transportation = array(
        'train' => 'BoardingCards\TripSorter\Transportation\Train',
        'bus' => 'BoardingCards\TripSorter\Transportation\Bus',
        'plane' => 'BoardingCards\TripSorter\Transportation\Plane',
    );

    /**
     * TripSorter constructor.
     * @param array $cards
     */
    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    /**
     * @return array
     */
    private function extractStartStopTrip()
    {
        if (count($this->cards) <= 1) {
            return $this->cards;
        }

        for ($i = 0, $max = count($this->cards); $i < $max; $i++) {
            $hasPrevious = false;
            $isLast = true;

            foreach ($this->cards as $index => $trip) {
                if (strcasecmp($this->cards[$i]['Departure'], $trip['Arrival']) == 0) {
                    $hasPrevious = true;
                }
                elseif (strcasecmp($this->cards[$i]['Arrival'], $trip['Departure']) == 0) {
                    $isLast = false;
                }
            }

            if (!$hasPrevious) {
                array_unshift($this->cards, $this->cards[$i]);
                unset($this->cards[$i]);
            }
            elseif ($isLast) {
                array_push($this->cards, $this->cards[$i]);
                unset($this->cards[$i]);
            }
        }

        $this->cards = array_merge($this->cards);
    }

    /**
     * @return $this
     */
    public function sort()
    {
        $this->extractStartStopTrip();
        $this->paringTrips();

        return $this;
    }

    /**
     * Paring trips
     */
    private function paringTrips()
    {
        for ($i = 0 ; $i < (count($this->cards) - 1); $i++) {
            foreach ($this->cards as $index => $trip) {
                if (strcasecmp($this->cards[$i]['Arrival'], $trip['Departure']) == 0) {
                    $nextRow = $this->cards[$i + 1];
                    $this->cards[$i + 1] = $trip;
                    $this->cards[$index] = $nextRow;

                    break;
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getBoardingList()
    {
        $boardingList = array();
        if (empty($this->cards)) {
            return $boardingList;
        }

        foreach ($this->cards as $trip) {
            $type = strtolower($trip['Transportation']);
            if (!isset(static::$transportation[$type])) {
                throw new \RuntimeException(sprintf('Unsupported transportation : %s', $type));
            }

            $boardingList[] = new static::$transportation[$type]($trip);
        }

        return $boardingList;
    }

    /**
     * @return array
     */
    public function getTripCollection()
    {
        return $this->cards;
    }
}
