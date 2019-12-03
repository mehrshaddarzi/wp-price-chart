<script>
	<?php
	global $wpdb;

	//Label
	$label = array();
	$data = array();
	$first_start = $current_time_5_ago - ( 60 * WP_PRICE_CHART::$option['wp_price_chart_opt']['update_time'] );
	$i = 1;
	while ( true ) {
		if ( $first_start + ( 60 * WP_PRICE_CHART::$option['wp_price_chart_opt']['update_time'] * $i ) >= $current_time ) {
			break;
		}

		// Create Label
		$label[] = date( "H:i", $first_start + ( 60 * WP_PRICE_CHART::$option['wp_price_chart_opt']['update_time'] * $i ) );

		// Get Price Data
		$d        = 0;
		$from_sql = ( $first_start + ( 60 * WP_PRICE_CHART::$option['wp_price_chart_opt']['update_time'] * ( $i - 1 ) ) - 1 ) * 1000;
		$to_sql   = ( $first_start + ( 60 * WP_PRICE_CHART::$option['wp_price_chart_opt']['update_time'] * $i ) ) * 1000;
		$get      = $wpdb->get_var( "SELECT `LASTSALEPRICE` FROM `{$wpdb->prefix}prices` WHERE `LASTSALETIME` BETWEEN {$from_sql} AND {$to_sql}" );
		//echo "SELECT `LASTSALEPRICE` FROM `{$wpdb->prefix}prices` WHERE `LASTSALETIME` BETWEEN {$from_sql} AND {$to_sql}";

        if ( ! empty( $get ) ) {
			$d = $get;
		}
		$data[] = $d;
		$i ++;
	}

	?>
    window.wp_price_chart_data_label = ['<?php echo implode( "','", $label ); ?>'];
    window.wp_price_chart_data = ['<?php echo implode( "','", $data ); ?>'];
    window.window.wp_price_chart_data_label_name = '<?php echo WP_PRICE_CHART::$option['wp_price_chart_opt']['chart_label_name']; ?>';
</script>
<div class="wp_price_line_chart" style="width: 100%; margin: 10px 0px;">
    <canvas id="wp_stock_price_chart" height="<?php echo WP_PRICE_CHART::$option['wp_price_chart_opt']['chart_height']; ?>"></canvas>
</div>