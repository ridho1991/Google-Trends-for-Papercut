<?php

class Gtp_Database {

	public function gtp_trends_table(){
		global $wpdb;
		$table_name = $wpdb->prefix.'gtp_trends';
		return $table_name;
	}
	
	public function gtp_settings_table()
	{
		global $wpdb;
		$table_name = $wpdb->prefix.'gtp_settings';
		return $table_name;
	}
	
	public function gtp_domains_table()
	{
		global $wpdb;
		$table_name = $wpdb->prefix.'gtp_domains';
		return $table_name;
	}
	
	public function gtp_languages_table()
	{
		global $wpdb;
		$table_name = $wpdb->prefix.'gtp_languages';
		return $table_name;
	}
	
	public function gtp_trends_country_table()
	{
		global $wpdb;
		$table_name = $wpdb->prefix.'gtp_trends_country';
		return $table_name;
	}
	
	public function papercut_table()
	{
		global $wpdb;
		$table_name = $wpdb->prefix.'papercut_campaigns';
		return $table_name;
	}
	
	public function create_gtp_trends_table()
	{
		global $wpdb;
		$table_name = $this->gtp_trends_table();
		$sql = '
			CREATE TABLE '.$table_name.' (
				id int(11) NOT NULL auto_increment,
				trends varchar(255) NOT NULL,
				keywords text NOT NULL,
				dates datetime NOT NULL,
				PRIMARY KEY  (id)
			)
			DEFAULT CHARACTER SET utf8
			DEFAULT COLLATE utf8_general_ci;
		';
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		$sql1 = 'ALTER TABLE '.$table_name.' CHARACTER SET utf8;';
		$sql2 = 'ALTER TABLE '.$table_name.' CHANGE trends trends VARCHAR(255) CHARACTER SET utf8 NOT NULL;';
		$sql3 = 'ALTER TABLE '.$table_name.' CHANGE keywords keywords text CHARACTER SET utf8 NOT NULL;';

		$wpdb->query($sql1);
		$wpdb->query($sql2);
		$wpdb->query($sql3);
	}

	public function create_gtp_settings_table()
	{
		global $wpdb;
		$table_name = $this->gtp_settings_table();
		$sql = '
			CREATE TABLE '.$table_name.' (
				id int(11) NOT NULL,
				trends_schedule varchar(255) NOT NULL,
				trends_country varchar(255) NOT NULL,
				keywords_domain varchar(255) NOT NULL,
				keywords_language varchar(255) NOT NULL,
				campaign_template text NOT NULL,
				campaign_size varchar(255) NOT NULL,
				campaign_count int(9) NOT NULL,
				campaign_schedule varchar(255) NOT NULL,
				campaign_active int(11) NOT NULL,
				PRIMARY KEY  (id)
			)
			DEFAULT CHARACTER SET utf8
			DEFAULT COLLATE utf8_general_ci;
		';
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		$sql1 = 'ALTER TABLE '.$table_name.' CHARACTER SET utf8;';
		$sql2 = 'ALTER TABLE '.$table_name.' CHANGE trends_schedule trends_schedule VARCHAR(255) CHARACTER SET utf8 NOT NULL;';
		$sql3 = 'ALTER TABLE '.$table_name.' CHANGE trends_country trends_country VARCHAR(255) CHARACTER SET utf8 NOT NULL;';
		$sql4 = 'ALTER TABLE '.$table_name.' CHANGE keywords_domain keywords_domain VARCHAR(255) CHARACTER SET utf8 NOT NULL;';
		$sql5 = 'ALTER TABLE '.$table_name.' CHANGE keywords_language keywords_language VARCHAR(255) CHARACTER SET utf8 NOT NULL;';
		$sql6 = 'ALTER TABLE '.$table_name.' CHANGE campaign_template campaign_template text CHARACTER SET utf8 NOT NULL;';
		$sql7 = 'ALTER TABLE '.$table_name.' CHANGE campaign_size campaign_size VARCHAR(255) CHARACTER SET utf8 NOT NULL;';
		$sql8 = 'ALTER TABLE '.$table_name.' CHANGE campaign_schedule campaign_schedule VARCHAR(255) CHARACTER SET utf8 NOT NULL;';

		$wpdb->query($sql1);
		$wpdb->query($sql2);
		$wpdb->query($sql3);
		$wpdb->query($sql4);
		$wpdb->query($sql5);
		$wpdb->query($sql6);
		$wpdb->query($sql7);
		$wpdb->query($sql8);
		update_option( "gtp_db_version", GTP_DB_VERSION );
	}
	
	public function create_gtp_domains_table()
	{
		global $wpdb;
		$table_name = $this->gtp_domains_table();
		$sql = '
			CREATE TABLE '.$table_name.' (
				id int(11) NOT NULL auto_increment,
				domain varchar(255) NOT NULL,
				country varchar(255) NOT NULL,
				PRIMARY KEY  (id)
			)
			DEFAULT CHARACTER SET utf8
			DEFAULT COLLATE utf8_general_ci;
		';
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		$sql1 = 'ALTER TABLE '.$table_name.' CHARACTER SET utf8;';
		$sql2 = 'ALTER TABLE '.$table_name.' CHANGE domain domain VARCHAR(255) CHARACTER SET utf8 NOT NULL;';
		$sql3 = 'ALTER TABLE '.$table_name.' CHANGE country country varchar(255) CHARACTER SET utf8 NOT NULL;';

		$wpdb->query($sql1);
		$wpdb->query($sql2);
		$wpdb->query($sql3);
	}
	
	public function create_gtp_languages_table()
	{
		global $wpdb;
		$table_name = $this->gtp_languages_table();
		$sql = '
			CREATE TABLE '.$table_name.' (
				id int(11) NOT NULL auto_increment,
				code varchar(255) NOT NULL,
				country varchar(255) NOT NULL,
				PRIMARY KEY  (id)
			)
			DEFAULT CHARACTER SET utf8
			DEFAULT COLLATE utf8_general_ci;
		';
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		$sql1 = 'ALTER TABLE '.$table_name.' CHARACTER SET utf8;';
		$sql2 = 'ALTER TABLE '.$table_name.' CHANGE code code VARCHAR(255) CHARACTER SET utf8 NOT NULL;';
		$sql3 = 'ALTER TABLE '.$table_name.' CHANGE country country VARCHAR(255) CHARACTER SET utf8 NOT NULL;';

		$wpdb->query($sql1);
		$wpdb->query($sql2);
		$wpdb->query($sql3);
	}
	
	public function create_gtp_trends_country_table()
	{
		global $wpdb;
		$table_name = $this->gtp_trends_country_table();
		$sql = '
			CREATE TABLE '.$table_name.' (
				id int(11) NOT NULL auto_increment,
				code varchar(255) NOT NULL,
				country varchar(255) NOT NULL,
				PRIMARY KEY  (id)
			)
			DEFAULT CHARACTER SET utf8
			DEFAULT COLLATE utf8_general_ci;
		';
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		$sql1 = 'ALTER TABLE '.$table_name.' CHARACTER SET utf8;';
		$sql2 = 'ALTER TABLE '.$table_name.' CHANGE code code VARCHAR(255) CHARACTER SET utf8 NOT NULL;';
		$sql3 = 'ALTER TABLE '.$table_name.' CHANGE country country VARCHAR(255) CHARACTER SET utf8 NOT NULL;';

		$wpdb->query($sql1);
		$wpdb->query($sql2);
		$wpdb->query($sql3);
	}
	
	public function create_gtp_domains()
	{
		global $wpdb;
		$table_name = $this->gtp_domains_table();
		$sql = "INSERT INTO `".$table_name."` VALUES (1,'google.com','Worldwide  -  google.com'),(2,'google.ac','Ascension Island  -  google.ac'),(3,'google.ad','Andorra  -  google.ad'),(4,'google.ae','United Arab Emirates  -  google.ae'),(5,'google.com.af','Afghanistan  -  google.com.af'),(6,'google.com.ag','Antigua and Barbuda  -  google.com.ag'),(7,'google.com.ai','Anguilla  -  google.com.ai'),(8,'google.al','Albania  -  google.al'),(9,'google.am','Armenia  -  google.am'),(10,'google.co.ao','Angola  -  google.co.ao'),(11,'google.com.ar','Argentina  -  google.com.ar'),(12,'google.as','American Samoa  -  google.as'),(13,'google.at','Austria  -  google.at'),(14,'google.com.au','Australia  -  google.com.au'),(15,'google.az','Azerbaijan  -  google.az'),(16,'google.ba','Bosnia and Herzegovina  -  google.ba'),(17,'google.com.bd','Bangladesh  -  google.com.bd'),(18,'google.be','Belgium  -  google.be'),(19,'google.bf','Burkina Faso  -  google.bf'),(20,'google.bg','Bulgaria  -  google.bg'),(21,'google.com.bh','Bahrain  -  google.com.bh'),(22,'google.bi','Burundi  -  google.bi'),(23,'google.bj','Benin  -  google.bj'),(24,'google.com.bn','Brunei  -  google.com.bn'),(25,'google.com.bo','Bolivia  -  google.com.bo'),(26,'google.com.br','Brazil  -  google.com.br'),(27,'google.bs','Bahamas  -  google.bs'),(28,'google.bt','Bhutan  -  google.bt'),(29,'google.co.bw','Botswana  -  google.co.bw'),(30,'google.by','Belarus  -  google.by'),(31,'google.com.bz','Belize  -  google.com.bz'),(32,'google.ca','Canada  -  google.ca'),(33,'google.com.kh','Cambodia  -  google.com.kh'),(34,'google.cc','Cocos (Keeling) Islands  -  google.cc'),(35,'google.cd','Democratic Republic of the Congo  -  google.cd'),(36,'google.cf','Central African Republic  -  google.cf'),(37,'google.cat','CataloniaCatalan Countries  -  google.cat'),(38,'google.cg','Republic of the Congo  -  google.cg'),(39,'google.ch','Switzerland  -  google.ch'),(40,'google.ci','Ivory Coast  -  google.ci'),(41,'google.co.ck','Cook Islands  -  google.co.ck'),(42,'google.cl','Chile  -  google.cl'),(43,'google.cm','Cameroon  -  google.cm'),(44,'google.cn','China  -  google.cn'),(45,'google.com.co','Colombia  -  google.com.co'),(46,'google.co.cr','Costa Rica  -  google.co.cr'),(47,'google.com.cu','Cuba  -  google.com.cu'),(48,'google.cv','Cape Verde  -  google.cv'),(49,'google.com.cy','Cyprus  -  google.com.cy'),(50,'google.cz','Czech Republic  -  google.cz'),(51,'google.de','Germany  -  google.de'),(52,'google.dj','Djibouti  -  google.dj'),(53,'google.dk','Denmark  -  google.dk'),(54,'google.dm','Dominica  -  google.dm'),(55,'google.com.do','Dominican Republic  -  google.com.do'),(56,'google.dz','Algeria  -  google.dz'),(57,'google.com.ec','Ecuador  -  google.com.ec'),(58,'google.ee','Estonia  -  google.ee'),(59,'google.com.eg','Egypt  -  google.com.eg'),(60,'google.es','Spain  -  google.es'),(61,'google.com.et','Ethiopia  -  google.com.et'),(62,'google.fi','Finland  -  google.fi'),(63,'google.com.fj','Fiji  -  google.com.fj'),(64,'google.fm','Federated States of Micronesia  -  google.fm'),(65,'google.fr','France  -  google.fr'),(66,'google.ga','Gabon  -  google.ga'),(67,'google.ge','Georgia  -  google.ge'),(68,'google.gf','French Guiana  -  google.gf'),(69,'google.de','Germany  -  google.de'),(70,'google.gg','Guernsey  -  google.gg'),(71,'google.com.gh','Ghana  -  google.com.gh'),(72,'google.com.gi','Gibraltar  -  google.com.gi'),(73,'google.gl','Greenland  -  google.gl'),(74,'google.gm','Gambia  -  google.gm'),(75,'google.gp','Guadeloupe  -  google.gp'),(76,'google.gr','Greece  -  google.gr'),(77,'google.com.gt','Guatemala  -  google.com.gt'),(78,'google.gy','Guyana  -  google.gy'),(79,'google.com.hk','Hong Kong  -  google.com.hk'),(80,'google.hn','Honduras  -  google.hn'),(81,'google.hr','Croatia  -  google.hr'),(82,'google.ht','Haiti  -  google.ht'),(83,'google.hu','Hungary  -  google.hu'),(84,'google.co.id','Indonesia  -  google.co.id'),(85,'google.ir','Iran  -  google.ir'),(86,'google.iq','Iraq  -  google.iq'),(87,'google.ie','Ireland  -  google.ie'),(88,'google.co.il','Israel  -  google.co.il'),(89,'google.im','Isle of Man  -  google.im'),(90,'google.co.in','India  -  google.co.in'),(91,'google.io','British Indian Ocean Territory  -  google.io'),(92,'google.is','Iceland  -  google.is'),(93,'google.it','Italy  -  google.it'),(94,'google.je','Jersey  -  google.je'),(95,'google.com.jm','Jamaica  -  google.com.jm'),(96,'google.jo','Jordan  -  google.jo'),(97,'google.co.jp','Japan  -  google.co.jp'),(98,'google.co.ke','Kenya  -  google.co.ke'),(99,'google.ki','Kiribati  -  google.ki'),(100,'google.kg','Kyrgyzstan  -  google.kg'),(101,'google.co.kr','South Korea  -  google.co.kr'),(102,'google.com.kw','Kuwait  -  google.com.kw'),(103,'google.kz','Kazakhstan  -  google.kz'),(104,'google.la','Laos  -  google.la'),(105,'google.com.lb','Lebanon  -  google.com.lb'),(106,'google.com.lc','Saint Lucia  -  google.com.lc'),(107,'google.li','Liechtenstein  -  google.li'),(108,'google.lk','Sri Lanka  -  google.lk'),(109,'google.co.ls','Lesotho  -  google.co.ls'),(110,'google.lt','Lithuania  -  google.lt'),(111,'google.lu','Luxembourg  -  google.lu'),(112,'google.lv','Latvia  -  google.lv'),(113,'google.com.ly','Libya  -  google.com.ly'),(114,'google.co.ma','Morocco  -  google.co.ma'),(115,'google.md','Moldova  -  google.md'),(116,'google.me','Montenegro  -  google.me'),(117,'google.mg','Madagascar  -  google.mg'),(118,'google.mk','Macedonia  -  google.mk'),(119,'google.ml','Mali  -  google.ml'),(120,'google.com.mm','Burma  -  google.com.mm'),(121,'google.mn','Mongolia  -  google.mn'),(122,'google.ms','Montserrat  -  google.ms'),(123,'google.com.mt','Malta  -  google.com.mt'),(124,'google.mu','Mauritius  -  google.mu'),(125,'google.mv','Maldives  -  google.mv'),(126,'google.mw','Malawi  -  google.mw'),(127,'google.com.mx','Mexico  -  google.com.mx'),(128,'google.com.my','Malaysia  -  google.com.my'),(129,'google.co.mz','Mozambique  -  google.co.mz'),(130,'google.com.na','Namibia  -  google.com.na'),(131,'google.ne','Niger  -  google.ne'),(132,'google.com.nf','Norfolk Island  -  google.com.nf'),(133,'google.com.ng','Nigeria  -  google.com.ng'),(134,'google.com.ni','Nicaragua  -  google.com.ni'),(135,'google.nl','Netherlands  -  google.nl'),(136,'google.no','Norway  -  google.no'),(137,'google.com.np','Nepal  -  google.com.np'),(138,'google.nr','Nauru  -  google.nr'),(139,'google.nu','Niue  -  google.nu'),(140,'google.co.nz','New Zealand  -  google.co.nz'),(141,'google.com.om','Oman  -  google.com.om'),(142,'google.com.pa','Panama  -  google.com.pa'),(143,'google.com.pe','Peru  -  google.com.pe'),(144,'google.com.ph','Philippines  -  google.com.ph'),(145,'google.com.pk','Pakistan  -  google.com.pk'),(146,'google.pl','Poland  -  google.pl'),(147,'google.com.pg','Papua New Guinea  -  google.com.pg'),(148,'google.pn','Pitcairn Islands  -  google.pn'),(149,'google.com.pr','Puerto Rico  -  google.com.pr'),(150,'google.ps','Palestine[4]  -  google.ps'),(151,'google.pt','Portugal  -  google.pt'),(152,'google.com.py','Paraguay  -  google.com.py'),(153,'google.com.qa','Qatar  -  google.com.qa'),(154,'google.ro','Romania  -  google.ro'),(155,'google.rs','Serbia  -  google.rs'),(156,'google.ru','Russia  -  google.ru'),(157,'google.rw','Rwanda  -  google.rw'),(158,'google.com.sa','Saudi Arabia  -  google.com.sa'),(159,'google.com.sb','Solomon Islands  -  google.com.sb'),(160,'google.sc','Seychelles  -  google.sc'),(161,'google.se','Sweden  -  google.se'),(162,'google.com.sg','Singapore  -  google.com.sg'),(163,'google.sh','Saint Helena, Ascension and Tristan da Cunha  -  google.sh'),(164,'google.si','Slovenia  -  google.si'),(165,'google.sk','Slovakia  -  google.sk'),(166,'google.com.sl','Sierra Leone  -  google.com.sl'),(167,'google.sn','Senegal  -  google.sn'),(168,'google.sm','San Marino  -  google.sm'),(169,'google.so','Somalia  -  google.so'),(170,'google.st','Sao Tome and Principe  -  google.st'),(171,'google.com.sv','El Salvador  -  google.com.sv'),(172,'google.td','Chad  -  google.td'),(173,'google.tg','Togo  -  google.tg'),(174,'google.co.th','Thailand  -  google.co.th'),(175,'google.com.tj','Tajikistan  -  google.com.tj'),(176,'google.tk','Tokelau  -  google.tk'),(177,'google.tl','Timor-Leste  -  google.tl'),(178,'google.tm','Turkmenistan  -  google.tm'),(179,'google.to','Tonga  -  google.to'),(180,'google.tn','Tunisia  -  google.tn'),(181,'google.com.tn','Tunisia  -  google.com.tn'),(182,'google.com.tr','Turkey  -  google.com.tr'),(183,'google.tt','Trinidad and Tobago  -  google.tt'),(184,'google.com.tw','Taiwan  -  google.com.tw'),(185,'google.co.tz','Tanzania  -  google.co.tz'),(186,'google.com.ua','Ukraine  -  google.com.ua'),(187,'google.co.ug','Uganda  -  google.co.ug'),(188,'google.co.uk','United Kingdom  -  google.co.uk'),(189,'google.us','United States  -  google.us'),(190,'google.com.uy','Uruguay  -  google.com.uy'),(191,'google.co.uz','Uzbekistan  -  google.co.uz'),(192,'google.com.vc','Saint Vincent and the Grenadines  -  google.com.vc'),(193,'google.co.ve','Venezuela  -  google.co.ve'),(194,'google.vg','British Virgin Islands  -  google.vg'),(195,'google.co.vi','United States Virgin Islands  -  google.co.vi'),(196,'google.com.vn','Vietnam  -  google.com.vn'),(197,'google.vu','Vanuatu  -  google.vu'),(198,'google.ws','Samoa  -  google.ws'),(199,'google.co.za','South Africa  -  google.co.za'),(200,'google.co.zm','Zambia  -  google.co.zm'),(201,'google.co.zw','Zimbabwe  -  google.co.zw')";
		
		$wpdb->query($sql);
	}
	
	public function create_gtp_languages()
	{
		global $wpdb;
		$table_name = $this->gtp_languages_table();
		$sql = "INSERT INTO `".$table_name."` VALUES (1,'af','Afghanistan'),(2,'ax','Aland Islands'),(3,'al','Albania'),(4,'dz','Algeria'),(5,'as','American Samoa'),(6,'ad','Andorra'),(7,'ao','Angola'),(8,'ai','Anguilla'),(9,'aq','Antarctica'),(10,'ag','Antigua and Barbuda'),(11,'ar','Argentina'),(12,'am','Armenia'),(13,'aw','Aruba'),(14,'au','Australia'),(15,'at','Austria'),(16,'az','Azerbaijan'),(17,'bs','Bahamas'),(18,'bh','Bahrain'),(19,'bd','Bangladesh'),(20,'bb','Barbados'),(21,'by','Belarus'),(22,'be','Belgium'),(23,'bz','Belize'),(24,'bj','Benin'),(25,'bm','Bermuda'),(26,'bt','Bhutan'),(27,'bo','Bolivia, Plurinational State of'),(28,'bq','Bonaire, Sint Eustatius and Saba'),(29,'ba','Bosnia and Herzegovina'),(30,'bw','Botswana'),(31,'bv','Bouvet Island'),(32,'br','Brazil'),(33,'io','British Indian Ocean Territory'),(34,'bn','Brunei Darussalam'),(35,'bg','Bulgaria'),(36,'bf','Burkina Faso'),(37,'bi','Burundi'),(38,'kh','Cambodia'),(39,'cm','Cameroon'),(40,'ca','Canada'),(41,'cv','Cabo Verde'),(42,'ky','Cayman Islands'),(43,'cf','Central African Republic'),(44,'td','Chad'),(45,'cl','Chile'),(46,'cn','China'),(47,'cx','Christmas Island'),(48,'cc','Cocos (Keeling) Islands'),(49,'co','Colombia'),(50,'km','Comoros'),(51,'cg','Congo'),(52,'cd','Congo, the Democratic Republic of the'),(53,'ck','Cook Islands'),(54,'cr','Costa Rica'),(55,'ci','Cote d\'Ivoire'),(56,'hr','Croatia'),(57,'cu','Cuba'),(58,'cw','Curaçao'),(59,'cy','Cyprus'),(60,'cz','Czech Republic'),(61,'dk','Denmark'),(62,'dj','Djibouti'),(63,'dm','Dominica'),(64,'do','Dominican Republic'),(65,'ec','Ecuador'),(66,'eg','Egypt'),(67,'sv','El Salvador'),(68,'gq','Equatorial Guinea'),(69,'er','Eritrea'),(70,'ee','Estonia'),(71,'et','Ethiopia'),(72,'fk','Falkland Islands (Malvinas)'),(73,'fo','Faroe Islands'),(74,'fj','Fiji'),(75,'fi','Finland'),(76,'fr','France'),(77,'gf','French Guiana'),(78,'pf','French Polynesia'),(79,'tf','French Southern Territories'),(80,'ga','Gabon'),(81,'gm','Gambia'),(82,'ge','Georgia'),(83,'de','Germany'),(84,'gh','Ghana'),(85,'gi','Gibraltar'),(86,'gr','Greece'),(87,'gl','Greenland'),(88,'gd','Grenada'),(89,'gp','Guadeloupe'),(90,'gu','Guam'),(91,'gt','Guatemala'),(92,'gg','Guernsey'),(93,'gn','Guinea'),(94,'gw','Guinea-Bissau'),(95,'gy','Guyana'),(96,'ht','Haiti'),(97,'hm','Heard Island and McDonald Islands'),(98,'va','Holy See (Vatican City State)'),(99,'hn','Honduras'),(100,'hk','Hong Kong'),(101,'hu','Hungary'),(102,'is','Iceland'),(103,'in','India'),(104,'id','Indonesia'),(105,'ir','Iran, Islamic Republic of'),(106,'iq','Iraq'),(107,'ie','Ireland'),(108,'im','Isle of Man'),(109,'il','Israel'),(110,'it','Italy'),(111,'jm','Jamaica'),(112,'jp','Japan'),(113,'je','Jersey'),(114,'jo','Jordan'),(115,'kz','Kazakhstan'),(116,'ke','Kenya'),(117,'ki','Kiribati'),(118,'kp','Korea, Democratic People\'s Republic of'),(119,'kr','Korea, Republic of'),(120,'kw','Kuwait'),(121,'kg','Kyrgyzstan'),(122,'la','Lao People\'s Democratic Republic'),(123,'lv','Latvia'),(124,'lb','Lebanon'),(125,'ls','Lesotho'),(126,'lr','Liberia'),(127,'ly','Libya'),(128,'li','Liechtenstein'),(129,'lt','Lithuania'),(130,'lu','Luxembourg'),(131,'mo','Macao'),(132,'mk','Macedonia, the former Yugoslav Republic of'),(133,'mg','Madagascar'),(134,'mw','Malawi'),(135,'my','Malaysia'),(136,'mv','Maldives'),(137,'ml','Mali'),(138,'mt','Malta'),(139,'mh','Marshall Islands'),(140,'mq','Martinique'),(141,'mr','Mauritania'),(142,'mu','Mauritius'),(143,'yt','Mayotte'),(144,'mx','Mexico'),(145,'fm','Micronesia, Federated States of'),(146,'md','Moldova, Republic of'),(147,'mc','Monaco'),(148,'mn','Mongolia'),(149,'me','Montenegro'),(150,'ms','Montserrat'),(151,'ma','Morocco'),(152,'mz','Mozambique'),(153,'mm','Myanmar'),(154,'na','Namibia'),(155,'nr','Nauru'),(156,'np','Nepal'),(157,'nl','Netherlands'),(158,'nc','New Caledonia'),(159,'nz','New Zealand'),(160,'ni','Nicaragua'),(161,'ne','Niger'),(162,'ng','Nigeria'),(163,'nu','Niue'),(164,'nf','Norfolk Island'),(165,'mp','Northern Mariana Islands'),(166,'no','Norway'),(167,'om','Oman'),(168,'pk','Pakistan'),(169,'pw','Palau'),(170,'ps','Palestine, State of'),(171,'pa','Panama'),(172,'pg','Papua New Guinea'),(173,'py','Paraguay'),(174,'pe','Peru'),(175,'ph','Philippines'),(176,'pn','Pitcairn'),(177,'pl','Poland'),(178,'pt','Portugal'),(179,'pr','Puerto Rico'),(180,'qa','Qatar'),(181,'re','Reunion'),(182,'ro','Romania'),(183,'ru','Russian Federation'),(184,'rw','Rwanda'),(185,'bl','Saint Barthélemy'),(186,'sh','Saint Helena, Ascension and Tristan da Cunha'),(187,'kn','Saint Kitts and Nevis'),(188,'lc','Saint Lucia'),(189,'mf','Saint Martin (French part)'),(190,'pm','Saint Pierre and Miquelon'),(191,'vc','Saint Vincent and the Grenadines'),(192,'ws','Samoa'),(193,'sm','San Marino'),(194,'st','Sao Tome and Principe'),(195,'sa','Saudi Arabia'),(196,'sn','Senegal'),(197,'rs','Serbia'),(198,'sc','Seychelles'),(199,'sl','Sierra Leone'),(200,'sg','Singapore'),(201,'sx','Sint Maarten (Dutch part)'),(202,'sk','Slovakia'),(203,'si','Slovenia'),(204,'sb','Solomon Islands'),(205,'so','Somalia'),(206,'za','South Africa'),(207,'gs','South Georgia and the South Sandwich Islands'),(208,'ss','South Sudan'),(209,'es','Spain'),(210,'lk','Sri Lanka'),(211,'sd','Sudan'),(212,'sr','Suriname'),(213,'sj','Svalbard and Jan Mayen'),(214,'sz','Swaziland'),(215,'se','Sweden'),(216,'ch','Switzerland'),(217,'sy','Syrian Arab Republic'),(218,'tw','Taiwan, Province of China'),(219,'tj','Tajikistan'),(220,'tz','Tanzania, United Republic of'),(221,'th','Thailand'),(222,'tl','Timor-Leste'),(223,'tg','Togo'),(224,'tk','Tokelau'),(225,'to','Tonga'),(226,'tt','Trinidad and Tobago'),(227,'tn','Tunisia'),(228,'tr','Turkey'),(229,'tm','Turkmenistan'),(230,'tc','Turks and Caicos Islands'),(231,'tv','Tuvalu'),(232,'ug','Uganda'),(233,'ua','Ukraine'),(234,'ae','United Arab Emirates'),(235,'gb','United Kingdom'),(236,'us','United States'),(237,'um','United States Minor Outlying Islands'),(238,'uy','Uruguay'),(239,'uz','Uzbekistan'),(240,'vu','Vanuatu'),(241,'ve','Venezuela, Bolivarian Republic of'),(242,'vn','Viet Nam'),(243,'vg','Virgin Islands, British'),(244,'vi','Virgin Islands, U.S.'),(245,'wf','Wallis and Futuna'),(246,'eh','Western Sahara'),(247,'ye','Yemen'),(248,'zm','Zambia'),(249,'zw','Zimbabwe')";
		
		$wpdb->query($sql);
	}
	
	public function create_gtp_trends_country()
	{
		global $wpdb;
		$table_name = $this->gtp_trends_country_table();
		$sql = "INSERT INTO `".$table_name."` VALUES (1,'p30','Argentina'),(2,'p8','Australia'),(3,'p44','Austria'),(4,'p41','Belgium'),(5,'p18','Brazil'),(6,'p13','Canada'),(7,'p38','Chile'),(8,'p32','Colombia'),(9,'p43','Czech Republic'),(10,'p49','Denmark'),(11,'p29','Egypt'),(12,'p50','Finland'),(13,'p16','France'),(14,'p15','Germany'),(15,'p48','Greece'),(16,'p10','Hong Kong'),(17,'p45','Hungary'),(18,'p3','India'),(19,'p19','Indonesia'),(20,'p6','Israel'),(21,'p27','Italy'),(22,'p4','Japan'),(23,'p37','Kenya'),(24,'p34','Malaysia'),(25,'p21','Mexico'),(26,'p17','Netherlands'),(27,'p52','Nigeria'),(28,'p51','Norway'),(29,'p25','Philippines'),(30,'p31','Poland'),(31,'p47','Portugal'),(32,'p39','Romania'),(33,'p14','Russia'),(34,'p36','Saudi Arabia'),(35,'p5','Singapore'),(36,'p40','South Africa'),(37,'p23','South Korea'),(38,'p26','Spain'),(39,'p42','Sweden'),(40,'p46','Switzerland'),(41,'p12','Taiwan'),(42,'p33','Thailand'),(43,'p24','Turkey'),(44,'p35','Ukraine'),(45,'p9','United Kingdom'),(46,'p1','United States'),(47,'p28','Vietnam')";
		
		$wpdb->query($sql);
	}
	
	public function get_all_trends()
	{
		global $wpdb;
		$datas = $wpdb->get_results( "SELECT * FROM " . $this->gtp_trends_table() . "" );
		return $datas;
	}
	
	public function get_gtp_domains()
	{
		global $wpdb;
		$datas = $wpdb->get_results( "SELECT * FROM " . $this->gtp_domains_table() . "" );
		return $datas;
	}
	
	public function get_gtp_languages()
	{
		global $wpdb;
		$datas = $wpdb->get_results( "SELECT * FROM " . $this->gtp_languages_table() . "" );
		return $datas;
	}
	
	public function get_gtp_trends_country()
	{
		global $wpdb;
		$datas = $wpdb->get_results( "SELECT * FROM " . $this->gtp_trends_country_table() . "" );
		return $datas;
	}
	
	public function get_gtp_settings(){
		global $wpdb;
		$settings = $wpdb->get_row( "SELECT * FROM " . $this->gtp_settings_table() . "" );
		return $settings;
	}
	
	public function get_trends_count()
	{
		global $wpdb;
		$count = $wpdb->get_var( "SELECT count(id) FROM " . $this->gtp_trends_table() . "" );
		return $count;
	}

	public function create_gtp_trends($data)
	{
		global $wpdb;
		$wpdb->insert($this->gtp_trends_table(), $data);
		return $trends;
	}

	public function create_gtp_settings($data){
		global $wpdb;
		$data['campaign_template'] = stripslashes_deep($data['campaign_template']);
		$wpdb->insert( $this->gtp_settings_table(), $data);
	}
	
	public function get_scheduled($interval = 'daily')
	{
		global $wpdb;
		$trends = $wpdb->get_var( "SELECT count(*) FROM ".$this->gtp_settings_table()." WHERE trends_schedule = '".$interval."'");
		return $trends;
	}
	
	public function get_gtp_settings_exist()
	{
		global $wpdb;
		$count = $wpdb->get_var( "SELECT count(id) FROM " . $this->gtp_settings_table() . "" );
		return $count;
	}
	
	public function get_gtp_domains_exist()
	{
		global $wpdb;
		$count = $wpdb->get_var( "SELECT count(id) FROM " . $this->gtp_domains_table() . "" );
		return $count;
	}
	
	public function get_gtp_languages_exist()
	{
		global $wpdb;
		$count = $wpdb->get_var( "SELECT count(id) FROM " . $this->gtp_languages_table() . "" );
		return $count;
	}
	
	public function get_gtp_trends_country_exist()
	{
		global $wpdb;
		$count = $wpdb->get_var( "SELECT count(id) FROM " . $this->gtp_trends_country_table() . "" );
		return $count;
	}
	
	function get_gtp_trends_exist($trend)
	{
		global $wpdb;
		return $wpdb->get_var("SELECT * FROM ".$this->gtp_trends_table()." WHERE trends = '".trim($trend)."'");
	}

	function get_category_exist($trend)
	{
		global $wpdb;
		return $wpdb->get_var("SELECT * FROM ".$wpdb->prefix.'terms'." WHERE name = '".trim($trend)."'");
	}
	
	public function get_campaign_exist($keyword)
	{
		global $wpdb;
		return $wpdb->get_var("SELECT * FROM ".$wpdb->prefix.'papercut_campaigns'." WHERE keyword = '".trim($keyword)."'");
	}
	
	function get_category($trend)
	{
		global $wpdb;
		return $wpdb->get_var("SELECT term_id FROM ".$wpdb->prefix.'terms'." WHERE name = '".trim($trend)."'");
	}


	function create_category($trend)
	{
		wp_create_category($trend);
	}

	public function update_gtp_settings($data){
		global $wpdb;
		$data['campaign_active'] = (isset($data['campaign_active'])) ? 1 : 0;
		$data['campaign_template'] = stripslashes_deep($data['campaign_template']);
		return $wpdb->update( $this->gtp_settings_table(), $data, array('id' => 1));
	}
	
	public function create_papercut_campaign($data)
	{
		global $wpdb;
		$data['template'] = stripslashes_deep($data['template']);
		$wpdb->insert( $this->papercut_table(), $data);
	}
}
