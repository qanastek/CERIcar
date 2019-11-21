<?php
class context
{
	/**
	 * Tableau associatif contenant toutes les variables créer par l'utilisateur
	 *
	 * @var Array
	 */
	private $data;

    const SUCCESS = "Success";
    const ERROR = "Error";
    const NONE = "None";

	/**
	 * Nom de l'application
	 *
	 * @var String
	 */
    private $name;

	/**
	 * Instance du Context
	 *
	 * @var Context
	 */
    private static $instance = null;
	
	 /**
	 * Revoie le context
     * @return Context
     */
	public static function getInstance()
	{
		if(self::$instance == null)
		  self::$instance = new context();
		return self::$instance; 
	}
	
	private function __construct() {}

	/**
	 * Initialise le nom du context
	 *
	 * @param String $name Nom du context
	 * @return void
	 */
	public function init($name)
	{
       $this->name = $name;       
	}
	
	public function getLayout()
	{
		return $this->layout;
	}

	public function setLayout($layout)
	{
		$this->layout = $layout;
	}	
	
	/**
	 * Redirection vers $url
	 *
	 * @param String $url Url vers laquelle ont souhaite être redirigé
	 * @return void
	 */
	public function redirect($url)
	{
		header("Location:" . $url); 
	}

	/**
	 * Lance le controller de la route $action
	 *
	 * @param String $action Route où l'ont souhaite aller 
	 * @param Array $request Un tableau associatif qui contient par défaut le contenu des variables $_GET, $_POST et $_COOKIE.
	 * @return void
	 */
	public function executeAction($action,$request)
	{
		// Layout dans lequelle la vue sera chargé
		$this->layout = "layout";

		// Vérifie qu'il existe un controller pour cette route
		if(!method_exists('mainController',$action)) return false;

		// Il lance le controller correspondant à la route
		return  mainController::$action($request,$this);		
	}
	
	/**
	 * Récupère l'attribut $_SESSION['$attribute']
	 *
	 * @param String $attribute Attribut que l'ont souhaite récupéré
	 * @return void
	 */
	public function getSessionAttribute($attribute)
	{
		if(array_key_exists($attribute, $_SESSION))		
			return $_SESSION[$attribute];
		else
			return NULL;
	}
	
	/**
	 * Set l'attribut $_SESSION['$attribute']
	 *
	 * @param String $attribute Attribut que l'ont souhaite modifier
	 * @param String $value Nouvelle valeur de celui-ci
	 * @return void
	 */
	public function setSessionAttribute($attribute,$value)
	{
		$_SESSION[$attribute] = $value;
	}

	/**
	 * Return the error message and destroy it
	 * @return void String The error status
	 */
	public function getErrorMessage() {
		$notification = $_SESSION["notification"];
		unset($_SESSION['notification']);
		return $notification;
	}

	/**
	 * Return the error status and destroy it
	 * @return void String The error status
	 */
	public function getErrorStatus() {
		$notification_status = $_SESSION["notification_status"];
		unset($_SESSION['notification_status']);
		return $notification_status;
	}

	/**
	 * Get the URL of the image
	 * @return void String The link to the image
	 */
	public function getImages($nameApp, $img) {
		return $nameApp . "/assets/img/" . $img;
	}

	/**
	 * Calcule la durée d'un trajet
	 * @return void String La durée du trajet
	 */
	public function getDureeTrajet($heureDepart, $distance) {
		$speed = 1;
		$duration = $speed * $distance;

		$hour = $heureDepart + round($duration / 60);
		$min = round($duration % 60);

		$rslt = $hour % 24 . ":" . $min;

		return $rslt;
	}

	/**
	 * Calcule le nombre de places restantes
	 * @return void String Le nombre de places restantes
	 */
	public function getNbrPlacesRestante($idVoyage) {
		return voyageTable::getPlacesRestantes($idVoyage);
	}
    
	/**
	 * Récupère une variable dans $data
	 *
	 * @param String $prop Variable à récupéré
	 * @return void
	 */
	public function __get($prop)
	{
		if(array_key_exists($prop, $this->data)) {       	
			return $this->data[$prop];
		}
		else {
			return NULL;
		}   
	}
    
    /**
	 * Ajoute la variable dans le tableau data et lui attribue la valeur
	 *
	 * @param String $prop Variable à set
	 * @param String $value Nouvelle valeur de celle-ci
	 */
   	public function __set($prop,$value) 
	{
    	$this->data[$prop] = $value;
	}
	
		
}
