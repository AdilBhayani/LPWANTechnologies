<html>
  <head>
   <title>LPWAN demonstration</title>
  </head>
  <body>
  <?php
     $_id = $_GET["id"];
     $_time = $_GET["time"];
     $_signal = $_GET["signal"];
     $_station = $_GET["station"];
     $_lat = $_GET["lat"];
     $_lng = $_GET["lng"];
     $_rssi = $_GET["rssi"];
     $_data = $_GET["data"];
     $_avgSignal = $_GET["avgSignal"];
     $_dt = new DateTime("@$_time");
     $_dt = $_dt->format('H:i:s');
     if ( $fl = fopen(('sigfoxData' .$_id. '.json'),'a')) {
       fwrite($fl,"\"data\": { \"id\" : \"". $_id . "\", "
		                     ."\"time\" :\"" . $_time . "\", "
							 ."\"signal\" :\"" . $_signal . "\", "
							 ."\"station\" :\"" . $_station . "\", "
							 ."\"lat\" :\"" . $_lat . "\", "
                             ."\"lng\" :\"" . $_lng . "\", "
							 ."\"rssi\" :\"" . $_rssi . "\", "
							 ."\"data\" :\"" . $_data . "\", "
							 ."\"avgSignal\" :\"" . $_avgSignal . "\" }\n" );
       fclose($fl);
     }
	 if ( $f2 = fopen(($_id. 'RSSI.json'),'a')) {
		 fwrite($f2, "[\"". $_dt . "\",". $_rssi. "]]");
		 fclose($f2);
	 }
	 $f2 = $_id. 'RSSI.json';
	 file_put_contents($f2,str_replace(']][','],[',file_get_contents($f2)));
  ?>
  </body>
</html>