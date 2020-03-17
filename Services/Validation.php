<?php
namespace Services;

use \Exceptions\ValidationException;

class Validation
{
	public static function validateUser(array $request): bool
	{
		$mandatoryFields = [
			'country_id'              => ['mandatory', 'numeric;not_zero', 'Country'],
			'salutation'              => ['mandatory', 'string;enum:Mr.,Ms.,Mrs.,Dr.', 'Salutation'],
			'first_name'              => ['mandatory', 'string;max:255', 'First Name'],
			'last_name'               => ['mandatory', 'string;max:255', 'Last Name'],
			'email'                   => ['mandatory', 'email', 'Email'],
			'in_mailing'              => ['mandatory', 'bool', 'Mailing option'],
			'asset_class'             => ['mandatory', 'string;enum:large,mid,small', 'Asset Class'],
			'investment_time_horizon' => ['mandatory', 'string;enum:short,medium,long', 'Investment Time Horizon'],
			'expected_purchase_date'  => ['mandatory', 'date;future', 'Expected Purchase Date'],
			'comments'                => ['optional', 'string;max:500', 'Comments']
		];
		
		if (isset($request['country_id']) && $request['country_id'] == \Models\Country::USA) {
			$mandatoryFields['zip'] = ['mandatory', 'numeric;not_zero,positive', 'Zip'];
		}
		
		foreach ($mandatoryFields as $fieldName => $params) {
			if ((!isset($request[$fieldName]) || $request[$fieldName] === '') && $params[0] === 'mandatory') {
				throw new ValidationException($params[2] . ' is mandatory');
			}
			$fieldParams = preg_split('/;/', $params[1]);
			
			if ($fieldParams[0] === 'string') {
				$strParams = preg_split('/:/', $fieldParams[1]);
				
				if ($strParams[0] === 'enum') {
    				$values = preg_split('/,/', $strParams[1]);
					
					if (!in_array($request[$fieldName], $values)) {
        				throw new ValidationException($params[2] . ' value is wrong');
					}
				} elseif ($strParams[0] === 'max') {
    				$maxLength = preg_split('/,/', $strParams[1]);
					
					if (strlen($request[$fieldName]) > $maxLength[0]) {
        				throw new ValidationException($params[2] . ' value is wrong');
					}
				}
			}
			
			if ($fieldParams[0] === 'bool' && !is_numeric($request[$fieldName])) {
				throw new ValidationException($params[2] . ' value is wrong');
			}
			
			if ($fieldParams[0] === 'email' && !self::checkEmail($request[$fieldName])) {
				throw new ValidationException($params[2] . ' value is wrong');
			}
			
			if ($fieldParams[0] === 'date') {
				$dateParams = preg_split('/:/', $fieldParams[1]);
				$today = new \DateTime();
				$date = \DateTime::createFromFormat('Y-m-d', $request[$fieldName]);
                $dateErrors = \DateTime::getLastErrors();
				
				if ($dateErrors['warning_count'] + $dateErrors['error_count'] > 0) {
    				throw new ValidationException($params[2] . ' value is wrong');
				}
				
				if ($today > $date) {
    				throw new ValidationException($params[2] . ' must be in the future');
				}
			}
			
			if ($fieldParams[0] === 'numeric') {
				$numParams = preg_split('/:/', $fieldParams[1]);
				$numParamItems = preg_split('/,/', $numParams[0]);
				
				foreach ($numParamItems as $numParamItem) {
					if (!is_numeric($request[$fieldName])
						|| ($numParamItem === 'not_zero' && (int)$request[$fieldName] === 0)
						|| ($numParamItem === 'positive' && (int)$request[$fieldName] < 0)
					) {
						throw new ValidationException($params[2] . ' value is wrong');
					}
				}
			}
		}
		
		return true;
	}
	
	public static function checkEmail($str) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
    }
}