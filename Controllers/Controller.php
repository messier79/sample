<?php
namespace Controllers;

class Controller
{
	/**
	 * array $request
	 */
	protected $request;

    /**
	 * Constructor
	 */	
	public function __construct()
	{
		$this->request = array_merge($_POST, $_GET);
	}
}