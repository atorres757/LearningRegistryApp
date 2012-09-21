<?php

namespace LRRepo;

class ResourceRepo extends LRRepo{
	
	public function getReducedArrayOfResources($query, $count = 10, $toOmit = ""){
		$resourceArray = array();
		$fetcher = new ResultsFetcher($this->httpClient, $this->lrServerUri, $query);
		
		while(count($resourceArray) < $count){
			$someResults = $fetcher->fetchResults();
			if(empty($someResults)) break;
			$someResults = $this->reduceByToOmit($someResults, $toOmit);
			// var_dump($someResults); die();
			$someResults = $this->reduceByTags($someResults, $query);
			// var_dump($someResults); die();
			foreach($someResults as $result){
				$resourceArray[] = $result;
				if(count($resourceArray) == $count) break;
			}
		}
		
		$toReturn = array();
		foreach($resourceArray as $key => $resource){
			$lightRes = new \stdClass();
			$lightRes->_id = $resource->doc_ID;
			$lightRes->keys = $resource->resource_data_description->keys;
			$lightRes->document = $resource->resource_data_description->resource_locator;
			$lightRes->title = "";
			$lightRes->description = "";
	        $data = $resource->resource_data_description->resource_data;
			if(gettype($data) == "string"){
				$data = $resource->resource_data_description->resource_data;
				if(preg_match("/(<dc:title>)(.+?)(<\/dc:title>)/", $data, $title) !== false){
					$lightRes->title = (isset($title[2])) ? $title[2] : "";
				}
				if(preg_match("/(<dc:description>)(.+?)(<\/dc:description>)/", $data, $desc) !== false){
					$lightRes->description = (isset($desc[2])) ? $desc[2] : "";
				}
			}
			$toReturn[] = $lightRes;
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
				if(array_search(strtolower($tag), array_map('strtolower', $value->resource_data_description->keys)) === false){
					unset($resources[$key]);
					continue;
				}
			}
		}
		return $resources;		
	}
	

}