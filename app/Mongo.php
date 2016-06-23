<?php

namespace App;

use MongoDB\Client;
use Config;

class Mongo extends Client
{

	protected $database;

	public function __construct()
	{

		$driver = Config::get('database.connections.mongodb.driver');
		$host = Config::get('database.connections.mongodb.host');
		$port = Config::get('database.connections.mongodb.port');
		$default_database = Config::get('database.connections.mongodb.database');
		$username = Config::get('database.connections.mongodb.username');
		$password = Config::get('database.connections.mongodb.password');
		$uri = $driver."://".$host.":".$port;
		$options['username'] = $username;
		$options['password'] = $password;

		$this->database = $default_database;
		parent::__construct($uri, $options);

	}

	public function getCollection($collection, $db = null)
	{
		if($db == null){
			$db = $this->database;
		}
		
		return $this->$db->$collection;
	}
	
}
