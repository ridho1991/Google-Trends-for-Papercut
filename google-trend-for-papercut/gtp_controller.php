<?php
ini_set('max_execution_time', 0);
ini_set('memory_limit', '999M');

class Gtp_Controller 
{
	var $gtp_data;
	var $gtrends;

	public function __construct() 
	{
		$this->gtp_data = new Gtp_Database();
		$this->gtrends= new GoogleHotrends();
	}

	public function gtp_table_trends_exist()
	{
		global $wpdb;
		$table_name = $this->gtp_data->gtp_trends_table();
		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name){
			return true;
		} else {
			return false;
		}
	}

	public function gtp_table_settings_exist()
	{
		global $wpdb;
		$table_name = $this->gtp_data->gtp_settings_table();
		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name){
			return true;
		} else {
			return false;
		}
	}
	
	public function gtp_table_domains_exist()
	{
		global $wpdb;
		$table_name = $this->gtp_data->gtp_domains_table();
		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name){
			return true;
		} else {
			return false;
		}
	}
	
	public function gtp_table_languages_exist()
	{
		global $wpdb;
		$table_name = $this->gtp_data->gtp_languages_table();
		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name){
			return true;
		} else {
			return false;
		}
	}
	
	public function gtp_table_trends_country_exist()
	{
		global $wpdb;
		$table_name = $this->gtp_data->gtp_trends_country_table();
		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name){
			return true;
		} else {
			return false;
		}
	}
	
	public function create_gtp_trends($data)
	{
		$this->gtp_data->create_gtp_trends($data);
    }

	public function scheduler($name) 
	{
		if($this->gtp_data->get_scheduled($name)!=null)
		{
			$this->run_gtp(); 
		}

	}
	
	public function run_gtp()
	{
		$gtp_settings=$this->get_gtp_settings();
		$trends_country=$gtp_settings->trends_country;
		$domain=$gtp_settings->keywords_domain;
		$lang_country=$gtp_settings->keywords_language;
		
		$campaign_size=$gtp_settings->campaign_size;
		$campaign_count=$gtp_settings->campaign_count;
		$campaign_schedule=$gtp_settings->campaign_schedule;
		$campaign_template=$gtp_settings->campaign_template;
		$campaign_active=$gtp_settings->campaign_active;
		
		$data = array();
		$data2=	array();
		
		$hottrends=$this->gtrends->fetch_trends($trends_country);
		if ($hottrends != '') 
		{
			foreach ($hottrends as $trend)
			{
				if ($this->get_category_exist($trend)==null)
					{
						$this->create_category($trend);
					}

				$category_id=$this->get_category($trend);
				$keywords=array();
				$keywords=$this->gtrends->fetch_keyword($domain,$lang_country,$trend);
				if ($keywords != '')
				{
						$key=implode(",",$keywords);
						$date=current_time('mysql');
						$data[]       = array(
							'trends'     => $trend,
							'keywords'   => $key,
							'dates'      => current_time('mysql')
						);
						
						foreach($keywords as $keyword)
						{
							$data2[]       = array(
							'keyword'     => $keyword,
							'template'    => $campaign_template,
							'width'       => 600,
							'height'      => 800,
							'size'        => $campaign_size,
							'count'       => $campaign_count,
							'counter'     => 0,
							'category_id' => $category_id,
							'schedule'    => $campaign_schedule,						
							'active'      => $campaign_active
							);
						}
				}
			}
			foreach ($data as $trends) 
			{
				if ($this->get_gtp_trends_exist($trends['trends'])==null)
				{
					$this->create_gtp_trends($trends);
					$message .= $this->get_alert( true ,"Trend '".$trends['trends']."' inserted successfully");
				}
			}
			foreach ($data2 as $keyword) 
			{
				if ($this->get_campaign_exist($keyword['keyword'])==null)
				{
					$this->create_papercut_campaign($keyword);
					$message .= $this->get_alert( true ,"Campaign '".$keyword['keyword']."' inserted successfully");
				}
			}
		}
		return $message;
    }

	public function get_category_exist($trend){
		return $this->gtp_data->get_category_exist($trend);
	}
	
	public function get_category($trend){
		return $this->gtp_data->get_category($trend);
	}
	
	public function create_category($trend){
		return $this->gtp_data->create_category($trend);
	}
	
	public function get_all_trends(){
		return $this->gtp_data->get_all_trends();
	}

	public function get_gtp_settings(){
		return $this->gtp_data->get_gtp_settings();
	}
	
	public function get_gtp_domains(){
		return $this->gtp_data->get_gtp_domains();
	}
	
	public function get_gtp_languages(){
		return $this->gtp_data->get_gtp_languages();
	}
	
	public function get_gtp_trends_country(){
		return $this->gtp_data->get_gtp_trends_country();
	}
	
	public function get_trends_count(){
		return $this->gtp_data->get_trends_count();
	}

	public function create_gtp_trends_table()
	{
		$this->gtp_data->create_gtp_trends_table();
	}

	public function create_gtp_settings_table()
	{
		$this->gtp_data->create_gtp_settings_table();
	}
	
	public function create_gtp_domains_table()
	{
		$this->gtp_data->create_gtp_domains_table();
	}
	
	public function create_gtp_trends_country_table()
	{
		$this->gtp_data->create_gtp_trends_country_table();
	}
	
	public function create_gtp_languages_table()
	{
		$this->gtp_data->create_gtp_languages_table();
	}
	
	public function create_gtp_languages()
	{
		$this->gtp_data->create_gtp_languages();
	}
	
	public function create_gtp_domains()
	{
		$this->gtp_data->create_gtp_domains();
	}
	
	public function create_gtp_trends_country()
	{
		$this->gtp_data->create_gtp_trends_country();
	}
		
	public function create_papercut_campaign($keyword)
	{
		$this->gtp_data->create_papercut_campaign($keyword);
	}
	
	public function create_gtp_settings()
	{
		global $wpdb;
		$data = array();
		$data[]       = array(
			'id'=>1,
			'trends_schedule' 		=> 'daily',
			'trends_country'		=> 'p1',
			'keywords_domain'		=> '.com',
			'keywords_language'		=> 'us',
			'campaign_template'    	=> "<a href=\"{{ post.ID | get_permalink }}\">{{ title }}</a>. {{ '{We|I}' | spin }} have many {{ campaign.keyword }} {{ '{images|pictures|photos}' | spin }} {{ '{like|such as}' | spin }}: {% for index, image in images %}{{ image.title }}, {% endfor %}. You {{ '{could|might}' | spin  }} also {{ '{found|got}' | spin }} {% for index, tag in tags %}{{ tag }}, {% endfor %} images here.\n\n[gallery]",
			'campaign_size'       	=> 'wallpaper',
			'campaign_count'       	=> 1,
			'campaign_schedule'    	=> 'daily',
			'campaign_active'      => 1
		);
		
		foreach ($data as $settings) 
		{
			$this->gtp_data->create_gtp_settings($settings);
		}
	}
		
	public function update_gtp_settings($settings){
		$updated = $this->gtp_data->update_gtp_settings($settings);
		if ( $updated ) {
			$message = $this->get_alert( true , "Setting updated" );
		} else {
			$message = $this->get_alert( false , "Failed to update setting" );
		}
		return $message;
    }
	
	public function get_alert($type, $message) {
		$alert = "";
		if ($type) {
			$alert .= "<div class=\"alert alert-success alert-dismissable\">\n";
		} else {
			$alert .= "<div class=\"alert alert-danger alert-dismissable\">\n";
		}
		$alert .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>\n";
		$alert .= $message."\n";
		$alert .= "</div>\n";
		return $alert;
	}
	
	public function get_gtp_settings_exist(){
		return $this->gtp_data->get_gtp_settings_exist();
	}
	
	public function get_gtp_domains_exist(){
		return $this->gtp_data->get_gtp_domains_exist();
	}
	
	public function get_gtp_languages_exist(){
		return $this->gtp_data->get_gtp_languages_exist();
	}
	
	public function get_gtp_trends_country_exist(){
		return $this->gtp_data->get_gtp_trends_country_exist();
	}
	
	public function get_gtp_trends_exist($trend){
		return $this->gtp_data->get_gtp_trends_exist($trend);
	}
	
	public function get_campaign_exist($keyword){
		return $this->gtp_data->get_campaign_exist($keyword);
	}
	
}
