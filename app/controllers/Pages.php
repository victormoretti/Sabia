<?php
	/**
	 * This is a Controller example.
	 * File naming convention: always capital first letter and plural.
	 * Following the MVC pattern, the Controller handles the processed
	 * data by the Model and send it to the View. Likewise, the Controller
	 * takes data input from the View and send it to be processed by the Model.
	 */
	class Pages extends Controller{

		public function __construct(){
			//Loading the example Post Model. You should load the Models here
			$this->postModel = $this->model('Post');
		}

		public function index(){
			//Getting a function from the Post Model example and delivering it to the View
			//It is commented because the method itself needs a valid connection to the database
			//but that way you can get the idea: call it from the Model, pass it to the view.
				# $postsNumber = $this->postModel->postsNumber();   //Calling it from the Post Model

			$data = [
				'title' => 'This is nest.',
				'paragraph' => 'Your nest application has been successfully installed!<br>
				Check the configuration file in "/config/config.php" and set the definitions for your project needs.<br>
				If you need help, just refer to the <a href="https://github.com/victormoretti/nest">documentation</a> or open an issue.<br>
				Nest is a GNU GPL3.0 open source MVC PHP framework thought to serve the community. Branch it, make it better.<br>
				And, of course, happy coding!',
				# 'postsNumber' => $postsNumber   //Passing it to the view as data
			];
			$this->view('pages/index', $data);
		}

		public function about(){
			$data = [
				'title' => 'About Page',
				'paragraph' => 'This is another example page so you can get the gist of nest.<br>
				I normally use a "pages" directory inside Views, so I can organize things better.<br>
				For instance, hundreds of blog posts could go right inside a "posts" directory for better content management.<br>
				This about age, together with the index page, is inside the "/app/views/pages" directory.',
			];
			$this->view('pages/about', $data);
		}

	}