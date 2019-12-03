<?php

namespace WP_PRICE_CHART;

/**
 * Class Helper Used in Custom Helper Method For This Plugin
 */
class Helper {

	public static function validateDate( $date, $format = 'Y-m-d H:i:s' ) {
		$d = \DateTime::createFromFormat( $format, $date );
		return $d && $d->format( $format ) == $date;
	}


}