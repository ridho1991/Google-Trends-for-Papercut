<?php
	wp_register_sidebar_widget
	(
	'gtpwidget',         
	'Google Hot Trends',  
	'gtpwidget_display',  
	array(                     
	'description' => 'Display google hot trends of the day'
	)
	);
	
	wp_register_widget_control
	(
	'gtpwidget',    
	'gtpwidget',     
	'gtpwidget_control'  
	);
	
	
			
	function gtpwidget_control($args=array(), $params=array()) 
	{
		if (isset($_POST['submitted'])) 
		{
			update_option('gtpwidget_title', $_POST['gtptitle']);
			update_option('gtpwidget_number', $_POST['number']);
		}
		
		$gtptitle = get_option('gtpwidget_title');
		$number = get_option('gtpwidget_number');
		?>
		Widget Title:<br />
		<input type="text" class="widefat" name="gtptitle" value="<?php echo stripslashes($gtptitle); ?>" />
		<br /><br />
		Number to show:<br />
		<input type="text" class="widefat" name="number" value="<?php echo stripslashes($number); ?>" />
		<br /><br />
		<input type="hidden" name="submitted" value="1" />
		<?php
	}
	
	function gtpwidget_display($args=array(), $params=array()) 
	{
		$gtptitle = get_option('gtpwidget_title');
		$number = get_option('gtpwidget_number');

		if($gtptitle==''){
			$title = 'Hot Trends';
		} else {
		   $title = $gtptitle;
		}
		if($number==''){
			$num = '20';
		} else {
		   $num = $number;
		}

		echo stripslashes($args['before_widget']);
		echo stripslashes($args['before_title']);
		echo stripslashes($title);
		echo stripslashes($args['after_title']); ?>
		<?php
		$hottrends=get_hot_trends($num);
		if($hottrends !=null)
		{
			echo '<ul>';
			foreach($hottrends as $trend){
			echo '<li><a href="'.get_category_link($trend->term_id).'">'.$trend->trends.'</a></li>';
			}
			echo '</ul>';
		}
	?>
	<?php wp_reset_query(); ?>
	<?php echo stripslashes($args['after_widget']);
	}
	
	function get_hot_trends($limit)
	{
		global $wpdb;
		$datas = $wpdb->get_results( "SELECT ".$wpdb->prefix.'gtp_trends'.".trends,".$wpdb->prefix.'terms'.".term_id FROM ".$wpdb->prefix.'gtp_trends'.",".$wpdb->prefix.'terms'." WHERE ".$wpdb->prefix.'gtp_trends'.".trends=".$wpdb->prefix.'terms'.".name order by ".$wpdb->prefix.'gtp_trends'.".dates desc limit ".$limit."");
		return $datas;
	}
	
?>