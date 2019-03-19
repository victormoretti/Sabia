<?php
/**
 *  App core class
 *  Creates URL & loads core controller
 *  URL FORMAT -  /controller/method/params
 */

//Setting the class namespace
namespace Sabia;

class Core {
	protected $currentController = 'Pages';
	protected $currentMethod = 'index';
	protected $params = [];

	public function __construct(){
		
		$url = $this->getUrl();

		//For the first array value, check if is there are any controllers
		if( file_exists('../app/controllers/' . ucwords($url[0]) . '.php') ){
			//if it exists, set as current controller
			$this->currentController = ucwords($url[0]);
			//unset the 0 index of the url array
			unset($url[0]);
		}

		//Require the controller
		require_once '../app/controllers/' . $this->currentController . '.php';

		//Instantiate the class as an object inside Core
		$this->currentController = new $this->currentController;


		//For the second array value, check if there is any value
		if( isset($url[1]) ){
			//For the second array value, check if is there any method
			if( method_exists($this->currentController, $url[1]) ){
				$this->currentMethod = $url[1];
				unset($url[1]);
			}
		}

		//For the third array value and on, pass the parameters through the currentMethod
		$this->params = $url ? array_values($url) : [];
		call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

	}

	public function getUrl(){
		if( isset($_GET['url']) ){
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			return $url;
		}
	}

}
