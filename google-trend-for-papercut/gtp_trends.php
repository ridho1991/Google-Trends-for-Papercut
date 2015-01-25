<?php
	libxml_use_internal_errors(true);
    class GoogleHotrends 
	{
	
    public function fetch_trends($country_code)
    {
		$trendsurl = "http://www.google.com/trends/hottrends/atom/hourly?pn=".$country_code."";
		$c = curl_init($trendsurl);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		$responsedata = curl_exec($c);
		curl_close($c);
		return $this->parse_trend_feed( $responsedata );
    }

    private function parse_trend_feed($data)
    {
		preg_match_all('/.+?<a href=".+?">(.+?)<\/a>.+?/',$data,$matches);
		return $matches[1];
    }
	
	public function fetch_keyword($domain,$lang,$trend)
	{
		$xml = simplexml_load_file( utf8_encode("http://www.".$domain."/complete/search?output=toolbar&hl=".$lang."&q=".$trend.""));
		if (@$xml)
			{
				foreach ($xml->children() as $child)
				{
					foreach ($child->suggestion->attributes() as $data)
					{
						$keywords[]=$data;
					}
				}
				return $keywords;
			}
	}		
    }
?>