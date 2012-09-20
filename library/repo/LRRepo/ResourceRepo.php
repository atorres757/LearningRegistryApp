<?php

namespace LRRepo;

class ResourceRepo extends LRRepo{
	
	public function getReducedArrayOfResources($query, $count = 10, $toOmit = ""){
		$toReturn = array();
		$fetcher = new ResultsFetcher($this->httpClient, $this->lrServerUri, $query);
		
		while(count($toReturn) < $count){
			$someResults = $fetcher->fetchResults();
			if(empty($someResults)) break;
			$someResults = $this->reduceByToOmit($someResults, $toOmit);
			//var_dump($someResults); die();
			$someResults = $this->reduceByTags($someResults, $query);
			foreach($someResults as $result){
				$toReturn[] = $result;
			}
			//die();
		}
		return $toReturn;
	}
	
	public function reduceByToOmit($resources, $toOmit){
		$toOmit = explode(",", $toOmit);
		foreach($resources as $key => $value){
			if(array_search($value->doc_ID, $toOmit) !== false){
				unset($resources[$key]);
			}
		}
		return $resources;
	}
	
	public function reduceByTags($resources, $tags){
		$tags = explode(",", $tags);
		foreach($resources as $key => $value){
			foreach($tags as $tag){
				if(array_search($tag, $value->resource_data_description->keys) === false){
					unset($resources[$key]);
					continue;
				}
			}
		}
		return $resources;		
	}
	

}