<?php
	class wp{
		function __construct($site){
			$this->rest='https://public-api.wordpress.com/rest/v1.1/';
			$this->site=$this->rest.'sites/'.$site.'/';
		}
		function api($u,$params=[]){
			$u=$this->site.$u.'?'.http_build_query($params);
			return json_decode(file_get_contents($u));
		}
		/*function posts($fields='ID,title',$number=50,$offset=0){
			//ID,title,content,excerpt,slug,modified,featured_image,categories,tags
			$queries=['fields'=>$fields,'number'=>$number,'offset'=>$offset];
			return $this->api('posts/',$queries);
		}*/
	}
