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
	 $_time = $_time + 43200;
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
    if (strcmp($_station,"3597") == 0) {
		
		$dataStr = '';
		for($i=0;$i<strlen($_data);$i+=2) $dataStr .= chr(hexdec(substr($_data,$i,2)));
		$valuesArray = explode(',', $dataStr);
		
        /*if ( $f2 = fopen(($_id. 'RSSI.json'),'a')) {
            fwrite($f2, "[\"". $_dt . "\",". $_rssi. "]]");
            fclose($f2);
        }
        $f2 = $_id. 'RSSI.json';
        file_put_contents($f2,str_replace(']][','],[',file_get_contents($f2)));
		
		if ( $f2 = fopen(($_id. 'SNR.json'),'a')) {
            fwrite($f2, "[\"". $_dt . "\",". $_signal. "]]");
            fclose($f2);
        }
        $f2 = $_id. 'SNR.json';
        file_put_contents($f2,str_replace(']][','],[',file_get_contents($f2)));*/
		
		if (strcmp($_id,"3E3370") == 0 or strcmp($_id,"3E3652") == 0){
			if ( $f2 = fopen(('CombinedRSSI.json'),'a')) {
				if (strcmp($_id,"3E3370") == 0){
					fwrite($f2, "[\"". $_dt . "\",". $_rssi. ",". "null". "]]");
				}else{
					fwrite($f2, "[\"". $_dt . "\",". "null". ",". $_rssi. "]]");
				}
				fclose($f2);
			}
			$f2 = 'CombinedRSSI.json';
			file_put_contents($f2,str_replace(']][','],[',file_get_contents($f2)));
			
			if ( $f2 = fopen(('CombinedMoisture.json'),'a')) {
				if (strcmp($_id,"3E3370") == 0){
					fwrite($f2, "[\"". $_dt . "\",". $valuesArray[0] * 0.33 . ",". "null". "]]");
				}else{
					fwrite($f2, "[\"". $_dt . "\",". "null". ",". $valuesArray[0] * 0.33 . "]]");
				}
				fclose($f2);
			}
			$f2 = 'CombinedMoisture.json';
			file_put_contents($f2,str_replace(']][','],[',file_get_contents($f2)));
			
			if ( $f2 = fopen(('CombinedTemperature.json'),'a')) {
				if (strcmp($_id,"3E3370") == 0){
					fwrite($f2, "[\"". $_dt . "\",". $valuesArray[1]. ",". "null". "]]");
				}else{
					fwrite($f2, "[\"". $_dt . "\",". "null". ",". $valuesArray[1]. "]]");
				}
				fclose($f2);
			}
			$f2 = 'CombinedTemperature.json';
			file_put_contents($f2,str_replace(']][','],[',file_get_contents($f2)));
		}
		
		/*if ( $f2 = fopen(($_id. 'Moisture.json'),'a')) {
            fwrite($f2, "[\"". $_dt . "\",". $valuesArray[0]. "]]");
            fclose($f2);
        }
        $f2 = $_id. 'Moisture.json';
        file_put_contents($f2,str_replace(']][','],[',file_get_contents($f2)));
		
		
		
		if ( $f2 = fopen(($_id. 'Temperature.json'),'a')) {
            fwrite($f2, "[\"". $_dt . "\",". $valuesArray[1]. "]]");
            fclose($f2);
        }
        $f2 = $_id. 'Temperature.json';
        file_put_contents($f2,str_replace(']][','],[',file_get_contents($f2)));*/
    }
  ?>
  </body>
</html>