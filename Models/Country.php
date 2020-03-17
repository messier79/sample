<?php
namespace Models;

class Country extends Model
{
	const USA = 1;
	
	/**
	 * Contructor
	 */
	public function __construct()
	{
		parent::__construct('Country');
		$this->id = 0;
		$this->cde = '';
		$this->name = '';
		$this->status = '';
	}
	
	/**
	 * Loads an item
	 *
	 * @param int $id
	 *
	 * @return void
	 */
	public function load(int $id): void
	{
		$user = $this->repo->find();
	}
}