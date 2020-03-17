<?php
namespace Models;

class User extends Model
{
	/**
	 * Contructor
	 */
	public function __construct()
	{
		parent::__construct('User');
		$this->id                      = 0;
		$this->country_id              = 0;
		$this->salutation              = '';
		$this->first_name              = '';
		$this->last_name               = '';
		$this->email                   = '';
		$this->zip                     = '';
		$this->in_mailing              = 0;
		$this->asset_class             = '';
		$this->investment_time_horizon = '';
		$this->expected_purchase_date  = null;
		$this->comments                = '';
		$this->deleted_at              = null;
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
		$user = $this->repo->find($id);
		
		if (isset($user['id'])) {
			$this->id                      = $id;
			$this->country_id              = $user['country_id'];
			$this->salutation              = $user['salutation'];
			$this->first_name              = $user['first_name'];
			$this->last_name               = $user['last_name'];
			$this->email                   = $user['email'];
			$this->zip                     = $user['zip'];
			$this->in_mailing              = $user['in_mailing'];
			$this->asset_class             = $user['asset_class'];
			$this->investment_time_horizon = $user['investment_time_horizon'];
			$this->expected_purchase_date  = new \DateTime($user['expected_purchase_date']);
			$this->comments                = $user['comments'];
			$this->deleted_at              = $user['deleted_at'];
		}
	}
	
	/**
	 * Saves
	 *
	 * @param array $request
	 *
	 * @return bool
	 */
	public function save(array $request): bool
	{
		$this->load((int)$request['id']);
		
		if ($this->id > 0) {
			return $this->repo->update($request);
		} else {
			return $this->repo->insert($request);
		}
	}
	
	/**
	 * Deletes
	 *
	 * @param int $id
	 *
	 * @return bool
	 */
	public function delete(int $id): bool
	{
		$this->load($id);
		
		if ($this->id > 0) {
			return $this->repo->delete($id);
		} else {
			return false;
		}
	}
}