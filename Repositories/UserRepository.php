<?php
namespace Repositories;

class UserRepository extends Repository
{
	/**
	 * Finds an item
	 *
	 * @param int $id
	 *
	 * @return array
	 */
	public function find(int $id): array
	{
		try {
			$stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			$user = $stmt->fetch();
			
			if ($user === false) {
				$user = [];
			}
		} catch (\Exception $e) {
			$user = [];
		}
		
		return $user;
	}
	
	/**
	 * Checks if the email already exists
	 *
	 * @param string $email
	 * #param int $id
	 *
	 * @return bool
	 */
	public function emailExists(string $email, int $id = null): bool
	{
		$query = '
		    SELECT *
			FROM users
			WHERE email = :email
			AND deleted_at IS NULL
		';
		
		if ($id !== null) {
			$query .= ' AND id <> :id';
		}
		
		$stmt = $this->pdo->prepare($query);
		
		$stmt->bindParam(':email', $email);
		
		if ($id !== null) {
    		$stmt->bindParam(':id', $id);
		}
		$stmt->execute();
		$user = $stmt->fetch();
		
		if ($user === false) {
			return false;
		} else {
			return true;
		}
	}
	
	/**
	 * Loads all items
	 *
	 * @return array
	 */
	public function fetchAll(): array
	{
		try {
			$stmt = $this->pdo->prepare('SELECT * FROM users WHERE deleted_at IS NULL');
			$stmt->execute();
			$users = $stmt->fetchAll();
			
			foreach ($users as &$user) {
				$object = new \Models\User();
				
				foreach ($user as $key => $val) {
					$object->$key = $val;
				}
				$user = $object;
			}
		} catch (\Exception $e) {
			$users = [];
		}
		
		return $users;
	}
	
	/**
	 * Inserts
	 *
	 * @param array $request
	 *
	 * @return bool
	 */
	public function insert(array $request): bool
	{
		try {
			if ($this->emailExists($request['email'])) {
				throw new \Exceptions\ValidationException('The email already exists');
			}
			
			$stmt = $this->pdo->prepare('INSERT INTO users(
				country_id,
				salutation,
				first_name,
				last_name,
				email,
				zip,
				in_mailing,
				asset_class,
				investment_time_horizon,
				expected_purchase_date,
				comments,
				created_at,
				updated_at,
				deleted_at
			) VALUES(
				:country_id,
				:salutation,
				:first_name,
				:last_name,
				:email,
				:zip,
				:in_mailing,
				:asset_class,
				:investment_time_horizon,
				:expected_purchase_date,
				:comments,
				NOW(),
				NOW(),
				NULL
			)');
			$stmt->bindParam(':country_id', $request['country_id']);
			$stmt->bindParam(':salutation', $request['salutation']);
			$stmt->bindParam(':first_name', $request['first_name']);
			$stmt->bindParam(':last_name', $request['last_name']);
			$stmt->bindParam(':email', $request['email']);
			$stmt->bindParam(':zip', $request['zip']);
			$stmt->bindParam(':in_mailing', $request['in_mailing']);
			$stmt->bindParam(':asset_class', $request['asset_class']);
			$stmt->bindParam(':investment_time_horizon', $request['investment_time_horizon']);
			$stmt->bindParam(':expected_purchase_date', $request['expected_purchase_date']);
			$stmt->bindParam(':comments', $request['comments']);
			$stmt->execute();
			
			if ((int)$stmt->errorInfo()[0] > 0) {
				throw new \Exception('An error happened');
			}
		} catch (\Exception $e) {
			throw $e;
		}
		
		return true;
	}
	
	/**
	 * Updates
	 *
	 * @param array $request
	 *
	 * @return bool
	 */
	public function update(array $request): bool
	{
		try {
			if ($this->emailExists($request['email'], $request['id'])) {
				throw new \Exceptions\ValidationException('The email already exists');
			}
			
			$stmt = $this->pdo->prepare('UPDATE users
			SET country_id = :country_id,
				salutation = :salutation,
				first_name = :first_name,
				last_name = :last_name,
				email = :email,
				zip = :zip,
				in_mailing = :in_mailing,
				asset_class = :asset_class,
				investment_time_horizon = :investment_time_horizon,
				expected_purchase_date = :expected_purchase_date,
				comments = :comments,
				updated_at = NOW()
			WHERE id = :id');
			$stmt->bindParam(':country_id', $request['country_id']);
			$stmt->bindParam(':salutation', $request['salutation']);
			$stmt->bindParam(':first_name', $request['first_name']);
			$stmt->bindParam(':last_name', $request['last_name']);
			$stmt->bindParam(':email', $request['email']);
			$stmt->bindParam(':zip', $request['zip']);
			$stmt->bindParam(':in_mailing', $request['in_mailing']);
			$stmt->bindParam(':asset_class', $request['asset_class']);
			$stmt->bindParam(':investment_time_horizon', $request['investment_time_horizon']);
			$stmt->bindParam(':expected_purchase_date', $request['expected_purchase_date']);
			$stmt->bindParam(':comments', $request['comments']);
			$stmt->bindParam(':id', $request['id']);
			$stmt->execute();
			
			if ((int)$stmt->errorInfo()[0] > 0) {
				throw new \Exception('An error happened');
			}
		} catch (\Exception $e) {
			throw $e;
		}
		
		return true;
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
		try {
			$stmt = $this->pdo->prepare('UPDATE users
			SET deleted_at = NOW()
			WHERE id = :id');
			$stmt->bindParam(':id', $id);
			$stmt->execute();
		} catch (\Exception $e) {
			throw $e;
		}
		
		return true;
	}
}