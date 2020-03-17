<?php
namespace Repositories;

use Config\Config;

class Repository
{
	protected $pdo;
	
	public function __construct()
	{
		$dsn = "mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_NAME . ";charset=" . Config::DB_CHARSET;
		$this->pdo = new \PDO($dsn, Config::DB_USER, Config::DB_PASS);
		$this->pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING );
	}
}