<?php

define("FETCH_LIMIT_PER_REQUEST", 1000);
define("DEFAULT_FETCH_COUNT_PER_REQUEST", 5);
define("RESOURCE_URL", "https://api.mockaroo.com/api/");

class Mocker{
    public $schema;
    public $key;

    public function __construct($schema, $key){
        $this->schema = $schema;
        $this->key = $key;
    }

    public function get_mock($count=DEFAULT_FETCH_COUNT_PER_REQUEST){
        $mock = [];

        if ($count <= 0) {
            $count = DEFAULT_FETCH_COUNT_PER_REQUEST;
        }

        while ($count > 0){
            try {
                $limit = ($count >FETCH_LIMIT_PER_REQUEST) ?FETCH_LIMIT_PER_REQUEST : $count;

                $url = RESOURCE_URL.$this->schema."?count=".$limit."&key=".$this->key;
    
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_URL, $url);
                $result = curl_exec($curl);
                array_push($mock, ...json_decode($result, true));
    
                $count = ($count >= FETCH_LIMIT_PER_REQUEST) ? $count - FETCH_LIMIT_PER_REQUEST : $count - $count;
            } catch (Exception $e){
                break;
            }
        }

        return $mock;

    }
}