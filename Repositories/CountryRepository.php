<?php
namespace Repositories;

class CountryRepository extends Repository
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
			$this->pdo->prepare('SELECT * FROM countries WHERE id = :id');
			$sth->bindParam(':id', $id);
			$user = $sth->execute();
		} catch (\Exception $e) {
			$user = [];
		}
		
		return $user;
	}
	
	/**
	 * Loads all items
	 *
	 * @return array
	 */
	public function fetchAll(): array
	{
		try {
			$stmt = $this->pdo->prepare("SELECT * FROM countries WHERE status = 'active'");
			$stmt->execute();
			$countries = $stmt->fetchAll(\PDO::FETCH_OBJ);
		} catch (\Exception $e) {
			$countries = [];
		}
		
		return $countries;
	}
}