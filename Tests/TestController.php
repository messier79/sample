<?php
namespace Tests;

class TestController extends \Controllers\Controller
{
	public function run()
	{
		if (isset($this->request['test'])) {
			$methodName = 'test' . $this->request['test'];
			
			return $this->$methodName();
		}
		
		include(__DIR__ . '/../Templates/tests.php');
	}
	
	private function testNoCountry()
	{
		$testName = 'No Country';
		$request  = [];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Country is mandatory';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testInvalidCountry()
	{
		$testName = 'Invalid Country';
		$request  = [
		    'country_id'              => 'wrong',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Country value is wrong';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testNoSalutation()
	{
		$testName = 'No Salutation';
		$request  = [
		    'country_id'              => 1,
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Salutation is mandatory';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testInvalidSalutation()
	{
		$testName = 'Invalid Salutation';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'wrong',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Salutation value is wrong';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testNoFirstName()
	{
		$testName = 'No First Name';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.'
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'First Name is mandatory';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testLongFirstName()
	{
		$testName = 'Long First Name';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => '123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 ',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'First Name value is wrong';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testNoLastName()
	{
		$testName = 'No Last Name';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Last Name is mandatory';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testLongLastName()
	{
		$testName = 'Long Last Name';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => '123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 ',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Last Name value is wrong';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testNoEmail()
	{
		$testName = 'No Email';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Email is mandatory';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testWrongEmail()
	{
		$testName = 'Wrong Email';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'wrong',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Email value is wrong';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testNoInMailing()
	{
		$testName = 'No InMailing';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Mailing option is mandatory';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testWrongInMailing()
	{
		$testName = 'Wrong InMailing';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
			'in_mailing'              => 'wrong',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Mailing option value is wrong';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testNoAssetClass()
	{
		$testName = 'No Asset Class';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
			'in_mailing'              => 0,
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Asset Class is mandatory';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testWrongAssetClass()
	{
		$testName = 'Wrong InMailing';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
			'in_mailing'              => 0,
			'asset_class'             => 'wrong',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Asset Class value is wrong';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testNoInvestmentTimeHorizon()
	{
		$testName = 'No Investment Time Horizon';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
			'in_mailing'              => 0,
			'asset_class'             => 'large',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Investment Time Horizon is mandatory';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testWrongInvestmentTimeHorizon()
	{
		$testName = 'Wrong Investment Time Horizon';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
			'in_mailing'              => 0,
			'asset_class'             => 'large',
			'investment_time_horizon' => 'wrong',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Investment Time Horizon value is wrong';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testNoExpectedPurchaseDate()
	{
		$testName = 'No Expected Purchase Date';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
			'in_mailing'              => 0,
			'asset_class'             => 'large',
			'investment_time_horizon' => 'short',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Expected Purchase Date is mandatory';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testWrongExpectedPurchaseDate()
	{
		$testName = 'Wrong Expected Purchase Date';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
			'in_mailing'              => 0,
			'asset_class'             => 'large',
			'investment_time_horizon' => 'short',
			'expected_purchase_date'  => 'wrong',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Expected Purchase Date value is wrong';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testPastExpectedPurchaseDate()
	{
		$testName = 'Past Expected Purchase Date';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
			'in_mailing'              => 0,
			'asset_class'             => 'large',
			'investment_time_horizon' => 'short',
			'expected_purchase_date'  => '2020-01-01',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Expected Purchase Date must be in the future';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testLongComments()
	{
		$testName = 'Long Comments';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
			'in_mailing'              => 0,
			'asset_class'             => 'large',
			'investment_time_horizon' => 'short',
			'expected_purchase_date'  => '2999-01-01',
			'comments'                => '123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 123456789 ',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Comments value is wrong';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testNoZipForUsa()
	{
		$testName = 'No ZIP';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
			'in_mailing'              => 0,
			'asset_class'             => 'large',
			'investment_time_horizon' => 'short',
			'expected_purchase_date'  => '2999-01-01',
			'comments'                => '',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Zip is mandatory';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testWrongZipForUsa()
	{
		$testName = 'Wrong ZIP';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
			'in_mailing'              => 0,
			'asset_class'             => 'large',
			'investment_time_horizon' => 'short',
			'expected_purchase_date'  => '2999-01-01',
			'comments'                => '',
			'zip'                     => 'H3X 7G4',
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Zip value is wrong';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testNegativeZipForUsa()
	{
		$testName = 'Negative ZIP';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
			'in_mailing'              => 0,
			'asset_class'             => 'large',
			'investment_time_horizon' => 'short',
			'expected_purchase_date'  => '2999-01-01',
			'comments'                => '',
			'zip'                     => -12345,
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Zip value is wrong';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
	
	private function testZeroZipForUsa()
	{
		$testName = 'ZIP = 0';
		$request  = [
		    'country_id'              => 1,
			'salutation'              => 'Mr.',
			'first_name'              => 'Test',
			'last_name'               => 'Test',
			'email'                   => 'test@test.com',
			'in_mailing'              => 0,
			'asset_class'             => 'large',
			'investment_time_horizon' => 'short',
			'expected_purchase_date'  => '2999-01-01',
			'comments'                => '',
			'zip'                     => 0,
		];
		
		try {
		    \Services\Validation::validateUser($request);
		} catch (\Exception $e) {
			$result = $e->getMessage();
		}
		$expectedResult = 'Zip value is wrong';
		
		if ($result === $expectedResult) {
			$result = 'OK';
		} else {
			$result = 'NOK';
		}
		
		include(__DIR__ . '/../Templates/test.php');
	}
}