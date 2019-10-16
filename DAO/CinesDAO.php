<?php namespace DAO;

use Repository\IRepository as IRepository;
use models\Cine as Cine;
use \Exception as Exception;
use \PDOException as PDOException;

/**
 * 
 */
class CinesDAO extends SingletonAbstractDAO implements IDAO
{
	private $table = 'Cines';
	
	function __construct(argument)
	{
		# code...
	}
}





?>