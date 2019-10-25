<?php
class context
{
	private $data;

	private $viewport = array(
		"header" => "header",
		"statusBar" => "banner",
		"left" => null,
		"content" => null,
		"right" => null,
		"footer" => "footer"
	);

    const SUCCESS = "Success";
    const ERROR = "Error";
    const NONE = "None";

    private $name; // Nom de l'application

    private static $instance = null; // Instance du context
	
	 /**
	 * Revoie le context
     * @return context
     */
	public static function getInstance()
	{
		if(self::$instance == null)
		  self::$instance = new context();
		return self::$instance; 
	}
	
	private function __construct()
	{}

	/*
	* Initialise le nom du context
	*/
	public function init($name)
	{
       $this->name = $name;       
	}

	/**
	 * Renvoie la view correspondant à la zone demandé
	 */
	public function getViewport($location)
	{
		return "CERIcar" . "/view/" . $this->viewport[$location] . "Success.php";
	}

	/**
	 * Set une zone à une view spécifique 
	 */
	public function setViewport($location, $view)
	{
		$this->viewport[$location] = $view;
	}
	
	public function getLayout()
	{
		return $this->layout;
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
	}	
	
	public function redirect($url)
	{
		header("location:".$url); 
	}

	/**
	* Lance le controller de la route $action
	*/
	public function executeAction($action,$request)
	{
		$this->layout = "layout";

		// Vérifie qu'il existe une methode dans le main controller pour cette route
		if(!method_exists('mainController',$action)) return false;

		// Il lance la fonction correspante à la route
		return  mainController::$action($request,$this);
		
	}
	
	public function getSessionAttribute($attribute)
	{
		if(array_key_exists($attribute, $_SESSION))		
			return $_SESSION[$attribute];
		else
			return NULL;
	}
	
	public function setSessionAttribute($attribute,$value)
	{
		$_SESSION[$attribute]=$value;
	}
    
	
	
	public function __get($prop)
	{
		if(array_key_exists($prop, $this->data)) {       	
			return $this->data[$prop];
		}
		else {
			return NULL;
		}   
	}
    
    // Ajoute la variable dans le tableau data et lui attribue la valeur
   	public function __set($prop,$value) 
	{
    	$this->data[$prop] = $value;
	}
	
		
}
