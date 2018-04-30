<?php

class RSS
{
	public function RSS()
	{
//		require_once ('pathto.../mysql_connect.php');
		include ("config.inc.php");
		DEFINE ('DB_USER', $dbusuario);
		DEFINE ('DB_PASSWORD', $dbpassword);
		DEFINE ('DB_HOST', $dbhost);
		DEFINE ('DB_NAME', $db);
	}
	
	public function GetFeed()
	{
		return $this->getDetails() . $this->getItems();
	}
	
	private function getDetails()
	{
		// Make the connnection and then select the database.
		$dbc = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die ('Could not connect to MySQL: ' . mysql_error() );
		mysql_select_db(DB_NAME, $dbc) OR die ('Could not select the database: ' . mysql_error() );

		$query = "SELECT * 
				  FROM npc_rss_details";
		$result = mysql_query($query, $dbc);
		$details = '';
		while($row = mysql_fetch_array($result))
		{
			$details = '<?xml version="1.0" encoding="ISO-8859-1" ?>
					<rss version="2.0">
						<channel>
							<title>'. $row['rssdet_title'] .'</title>
							<link>'. $row['rssdet_link'] .'</link>
							<description>'. $row['rssdet_description'] .'</description>
							<language>'. $row['rssdet_language'] .'</language>
							<pubDate>'. $row['rssdet_pubDate'] .'</pubDate>
							<lastBuildDate>'. $row['rssdet_lastBuildDate'] .'</lastBuildDate>
							<image>
								<title>'. $row['rssdet_image_title'] .'</title>
								<url>'. $row['rssdet_image_url'] .'</url>
								<link>'. $row['rssdet_image_link'] .'</link>
								<width>'. $row['rssdet_image_width'] .'</width>
								<height>'. $row['rssdet_image_height'] .'</height>
							</image>';
		}
		
		mysql_free_result($result);
		mysql_close($dbc);
		
		return $details;
	}
	
	private function getItems()
	{
		// Make the connnection and then select the database.
		$dbc = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) OR die ('Could not connect to MySQL: ' . mysql_error() );
		mysql_select_db(DB_NAME, $dbc) OR die ('Could not select the database: ' . mysql_error() );

		$query = "SELECT rssitem_title,
						 rssitem_link,
						 rssitem_description,
						 DATE_FORMAT(rssitem_pubDate,'%a, %d %b %Y %T GMT') rssitem_pubDate						
				  FROM npc_rss_items
				  WHERE rssitem_enable = '1' 
				  ORDER BY rssitem_pubDate DESC";
		$result = mysql_query($query, $dbc);
		$items = '';
		while($row = mysql_fetch_array($result))
		{
			$items .= '<item>
						<title>'. $row['rssitem_title'] .'</title>
						<link>'. $row['rssitem_link'] .'</link>
						<description><![CDATA['. $row['rssitem_description'] .']]></description>
 						<pubDate>'. $row['rssitem_pubDate'] .'</pubDate>
					 </item>';
		}
		
		$items .= '</channel>
				 </rss>';

		mysql_free_result($result);
		mysql_close($dbc);
		
		return $items;
	}

}

?>