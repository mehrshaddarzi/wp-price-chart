<script>
	<?php
	global $wpdb;
	$label = array();
	$data = array();
	$query = $wpdb->get_results( "SELECT `LASTSALEPRICE`, `LASTSALETIME` FROM `{$wpdb->prefix}prices` WHERE `SYMBOL_ID` = {$default_symbol} AND `LASTSALETIME` BETWEEN {$current_time_x_ago}000 AND {$current_time}000 ORDER BY `LASTSALETIME` ASC", ARRAY_A );
	foreach ( $query as $row ) {
		$label[] = date( "d M H:i",  $row['LASTSALETIME'] / 1000 );
		$data[]  = $row['LASTSALEPRICE'];
	}

	?>
    window.wp_price_chart_data_label = ['<?php echo implode( "','", $label ); ?>'];
    window.wp_price_chart_data = ['<?php echo implode( "','", $data ); ?>'];
    window.window.wp_price_chart_data_label_name = '<?php echo $default_symbol_name; ?>';
</script>
<div class="wp_price_line_chart" style="width: 100%; margin: 10px 0px;">
    <canvas id="wp_stock_price_chart" height="<?php echo WP_PRICE_CHART::$option['wp_price_chart_opt']['chart_height']; ?>"></canvas>
</div>