<?php
Class RsstoTweeter {
	
	Function RsstoTweeter($feedUrl,$message,$tuser,$tpass) {
		$this->feedUrl = $feedUrl;		
		$this->messageTemplate = $message;
		$this->twitter['username'] = $tuser;
		$this->twitter['password'] = $tpass;
	}

	Function postTweet($twitterUsername, $twitterPassword, $message ) {
	
		if ($message) {
		
			$tweetUrl = 'http://www.twitter.com/statuses/update.xml';

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, 			$tweetUrl);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 	2);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 	1);
			curl_setopt($curl, CURLOPT_POST, 			1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, 		"status=".$message);
			curl_setopt($curl, CURLOPT_USERPWD, 		$twitterUsername.":".$twitterPassword);

			$result = curl_exec($curl);
			$resultArray = curl_getinfo($curl);

			if ($resultArray['http_code'] == 200)
			return true;
			else		
			return false;

			curl_close($curl);
			
		}else{
			return false;
		}
	
	}
	
	function getTinyurl($url) {
	
			$url = "http://tinyurl.com/api-create.php?url=" . $url;
			
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, 			$url);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 	2);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 	1);

			$tinyurl = curl_exec($curl);
			$resultArray = curl_getinfo($curl);
						
			return $tinyurl;
			
	}
	
	Function getNewest(){
	
		$this->feed = new SimplePie();
		$this->feed->set_feed_url($this->feedUrl);
		$this->feed->enable_cache(false);
		$this->feed->init();
		$this->feed->handle_content_type();
		
		$this->latest = $this->feed->get_item();
		$this->latest_title = $this->latest->get_title();
		$this->latest_permalink = $this->latest->get_permalink();
		$this->latest_hash = md5($this->latest->get_title());
				
		$this->cacheFile = "cache/twitter_rss_last.txt"; 
		$this->fOpen = fopen($this->cacheFile, 'r'); 
		$this->latestCacheHash = fread($this->fOpen, 32); 
		fclose($this->fOpen); 
		
		
		if($this->latestCacheHash != $this->latest_hash){
			// There is a new item
			
			$this->shortUrl = $this->getTinyurl($this->latest_permalink);
			
			$this->message_clean = str_replace("{title}",$this->latest_title,$this->messageTemplate);
			$this->message_clean = str_replace("{permalink}",$this->shortUrl,$this->message_clean);
					
			$this->postTweet($this->twitter['username'],$this->twitter['password'],$this->message_clean);
			$this->saveNewest($this->latest_hash);
			
			echo "Newest item is posted";
			
		}else { echo"There's no new items"; }
		
	}
	
	Function saveNewest($hash) {
	
		$this->file = "cache/twitter_rss_last.txt";
		$fh = fopen($this->file , 'w') or die("can't open file");
		fwrite($fh, $hash) or die("error?");
		fclose($fh);
	
	}
	
	
}
?>