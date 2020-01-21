<?php
final class BarcodeQR {
	
	const API_CHART_URL = "http://chart.apis.google.com/chart";

	
	private $_data;

	
	public function bookmark($url = null) {
		$this->_data = "{$url}";
	}

	
	public function content($type = null, $size = null, $content = null) {
		$this->_data = "CNTS:TYPE:{$type};LNG:{$size};BODY:{$content};;";
	}

	 
	public function generate($size = 200, $filename = null) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, self::API_CHART_URL);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "chs={$size}x{$size}&cht=qr&chl=" . urlencode($this->_data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		$img = curl_exec($ch);
		curl_close($ch);
                if($img) {
			if($filename) {
				if(!preg_match("#\.png$#i", $filename)) {
					$filename .= ".png";
				}
				return file_put_contents($filename, $img);
			} else {
				header("Content-type: image/png");
				print $img;
				return true;
			}
		}
		return false;
	}
        public function url($url = null) {
		$this->_data = preg_match("#^https?\:\/\/#", $url) ? $url : "http://{$url}";
	}

	
}

?>