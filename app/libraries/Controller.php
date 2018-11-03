<?php
/**
 * Base Controller
 * Loads the Models and Views
 */

class Controller {

	//Load model method
	public function model($model){
		//Require model file
		require_once '../app/models/'. $model .'.php';

		//Instantiate Model
		return new $model();
	}

	//Load view method
	public function view($view, $data = []){

		//Check for the header include
		if( file_exists('../app/views/inc/header.php')){
			require_once '../app/views/inc/header.php';
		}else{
			die('Header does not exist');
		}
		//Check for and require the view file
		if( file_exists('../app/views/'. $view .'.php') ){
			require_once '../app/views/'. $view .'.php';
		}else{
			//If view does not exist
			die('View does not exist');
		}
		//Check for the footer include
		if( file_exists('../app/views/inc/footer.php')){
			require_once '../app/views/inc/footer.php';
		}else{
			die('Footer does not exist');
		}

	}
}