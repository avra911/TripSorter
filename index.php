<?php


require_once __DIR__ . '/vendor/autoload.php';

use BoardingCards\TripSorter;

$tripCollection = array (
    array (
        'Departure' => 'Stockholm',
        'Arrival' => 'New York',
        'Transportation' => 'Plane',
        'Transportation_number' => 'SK22',
        'Seat' => '7B',
        'Gate' => '22',
    ),
    array (
        'Departure' => 'Madrid',
        'Arrival' => 'Barcelona',
        'Transportation' => 'Train',
        'Transportation_number' => '78A',
        'Seat' => '45B',
    ),
    array (
        'Departure' => 'Gerona Airport',
        'Arrival' => 'Stockholm',
        'Transportation' => 'Plane',
        'Transportation_number' => 'SK455',
        'Seat' => '3A',
        'Gate' => '45B',
        'Baggage' => '334',
    ),
    array (
        'Departure' => 'Barcelona',
        'Arrival' => 'Gerona Airport',
        'Transportation' => 'Bus',
    ),
);
$tripSorter = new TripSorter($tripCollection);
$boardingList = $tripSorter->sort()->getBoardingList();

echo 'Itinerary: ' . PHP_EOL;
foreach ($boardingList as $index => $type) {
    echo ($index + 1) . ". " . $type->getMessage() . PHP_EOL;

    if($index == count($boardingList) - 1){
        echo ($index + 2) . ". ". $type::MESSAGE_FINAL_DESTINATION . PHP_EOL;
    }
}
