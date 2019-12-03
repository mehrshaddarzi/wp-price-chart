<div class="wp-price-chart-form">
    <form action="" method="get">
        <div class="wp-price-chart-row">
            <div class="wp-price-chart-column">
				<?php _e( "From Date:", "wp-price-chart" ) ?> <input type="text" name="from-date" id="from-date" value="<?php
                if(isset($_GET['from-date'])) {
                    echo $_GET['from-date'];
                } else {
                    echo $from_input;
                }
                ?>">
            </div>
            <div class="wp-price-chart-column">
				<?php _e( "To Date:", "wp-price-chart" ) ?> <input type="text" name="to-date" id="to-date" value="<?php
	            if(isset($_GET['to-date'])) {
		            echo $_GET['to-date'];
	            } else {
		            echo $to_input;
	            }
	            ?>">
            </div>
            <div class="wp-price-chart-column">
                <input type="submit" value="<?php _e( "Go", "wp-price-chart" ); ?>">
            </div>
        </div>
    </form>
</div>
<style>
    .wp-price-chart-row {
        display: flex;
        flex-wrap: wrap;
        align-content: space-between;
    }

    .wp-price-chart-column {
        margin:5px;  /* and that, will result in a 10px gap */
    }
</style>