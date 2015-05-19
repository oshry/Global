<?php
/**
 * Created by PhpStorm.
 * User: oshry
 * Date: 5/17/15
 * Time: 2:39 PM
 */
namespace Search\Usecase;

use Search\Repository\Cache;

class SearchRes {
    public function __construct($query, $repo){
        $this->search_query = $query;
        $this->repo  = $repo;

    }
    public function search_result(){
        $query = "SELECT CONCAT(c.FirstName, ' ', c.LastName) as `full_name` FROM `customers` c
                  WHERE ((CONCAT( c.FirstName,  ' ', c.LastName ) LIKE '%".$this->search_query."%')
                  OR (CONCAT( c.FirstName, ' ', c.LastName) LIKE  '%".$this->search_query."%'))";
        $cache = new Cache;

        $matches = $cache->read($this->search_query);
        if (empty($matches)) {
            //die('No Cached');
            $matches = $this->repo->query($query);
            $cache->write($this->search_query, $matches);
        }else{
            //die('cached');
        }
        echo json_encode(array("matches" => $matches));
        die();
    }

}