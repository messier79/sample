<?php
namespace Models;

class Model
{
	/** @/Repositories\Repository */
	protected $repo;
	
	/**
	 * Constructor
	 */
	public function __construct(string $entityName)
	{
		switch ($entityName) {
			case 'Country':
    		    $this->repo = new \Repositories\CountryRepository();
				break;
			case 'User':
    		    $this->repo = new \Repositories\UserRepository();
				break;
		}
	}
	
	/**
	 * @return Repositories\Repository
	 */
	public function getRepository()
	{
		return $this->repo;
	}
}