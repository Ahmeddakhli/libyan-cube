<?php

/**
 * Google Maps Helpers
 *
 * @author Mohamed Alansary
 */
namespace App\Http\Helpers;

use Exception;

class GoogleMaps
{
	public static function distanceBetweenTwoPoints($point1, $point2)
	{
	    // Prepare data
	    $lat1 = $point1->latitude;
	    $lng1 = $point1->longitude;
	    $lat2 = $point2->latitude;
	    $lng2 = $point2->longitude;

	    // Calculating the distance between the two points
	    $R = 6378137; // Earth’s mean radius in meter
	    $rad_lat1 = $lat1 * pi() / 180;
	    $rad_lat2 = $lat2 * pi() / 180;
	    $rad_lat2_minus_lat1 = ($lat2 - $lat1) * pi() / 180;
	    $rad_lng2_minus_lng1 = ($lng2 - $lng1) * pi() / 180;
	    $lat = $rad_lat2_minus_lat1;
	    $lng = $rad_lng2_minus_lng1;
	    $a = sin($lat / 2) * sin($lat / 2) +
	        cos($rad_lat1) * cos($rad_lat2) *
	        sin($lng / 2) * sin($lng / 2);
	    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
	    $d = $R * $c;
	    return $d; // returns the distance in meter
	}
}