<?php
	class wp{
		function __construct($site){
			$this->rest='https://public-api.wordpress.com/rest/v1.1/';
			$this->site=$this->rest.'sites/'.$site.'/';
		}
		function api($u,$params=[]){
			$u=$this->site.$u.'?'.http_build_query($params);
			$res=file_get_contents($u);
			file_put_contents('cache/'.md5($u),$res);
			return json_decode($res);
		}
		function found(){
			return $this->posts(['number'=>1,'fields'=>'ID'])->found;
		}
		function posts($queries=[]){
			//ID,title,content,excerpt,slug,modified,featured_image,categories,tags
			return $this->api('posts/',$queries);
		}
	}
	
