<?php
namespace Controllers;

class UserController extends Controller
{
	/**
	 * Displays the main page
	 */
	public function index()
	{
		try {
			$user = new \Models\User();
			$success = '';
			$error = '';
			
			if (isset($this->request['save'])) {
				$isUserValid = \Services\Validation::validateUser($this->request);
				
				if (!$isUserValid) {
					throw new \Exception('The User is invalid');
				}
				$user->save($this->request);
				
				$user = new \Models\User();
				$success = 'User saved';
			} elseif (isset($this->request['delete'])) {
				$result = $user->getRepository()->delete((int)$this->request['delete']);
				
				if ($result === false) {
					throw new \Exception('The User could not be deleted');
				}
				
				$success = 'User deleted';
			} elseif (isset($this->request['id'])) {
				$user->load($this->request['id']);
				
				if ($user->deleted_at !== null || $user->id === 0) {
					throw new \Exception('No User found');
				}
			}
			$users = $user->getRepository()->fetchAll();
		} catch (\Exception $e) {
			foreach ($this->request as $key => $value) {
				if ($key === 'expected_purchase_date') {
					$value = new \DateTime($value);
				}
				$user->$key = $value;
			}
			$error = $e->getMessage();
		}
		$country = new \Models\Country();
		$countries = $country->getRepository()->fetchAll();
		
		include(__DIR__ . '/../Templates/users.php');
	}
}