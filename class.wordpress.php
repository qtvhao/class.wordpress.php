<?php
	class wp{
		function __construct($site){
			$this->rest='https://public-api.wordpress.com/rest/v1.1/';
			$this->site=$this->rest.'sites/'.$site.'/';
		}
		function getAndCache($u){
			$fn='cache/'.md5($u);
			if(file_exists($fn) and $res=file_get_contents($fn))return $res;
			if(!@$res=file_get_contents($u))return 'false';
			file_put_contents($fn,$res);
			return $res;
		}
		function api($u,$params=[],$cache=true){
			$u=$this->site.$u.'?'.http_build_query($params);
			if($cache)
				$res=$this->getAndCache($u);
			else
				$res=file_get_contents($u);
			return json_decode($res);
		}
		function found(){
			return $this->posts(['number'=>1,'fields'=>'ID'])->found;
		}
		function posts($queries=[]){
			//ID,title,content,excerpt,slug,modified,featured_image,categories,tags
			return $this->api('posts/',$queries);
		}
		function postWithSlug($slug){
			return $this->api('posts/slug:'.$slug,['fields'=>'title,content,featured_image,categories,tags'],false);
		}
	}
	
