<?php

class SiteController extends Controller {

	/**
	 * actionIndex (search)
	 *
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 *
	 * @access public
	 */
	public function actionIndex() {
		$client = null;
		$query = $_GET['q'];
		$type = $_GET['type'];
		$actors = null;
		$movies = array();

		if ($query) {
			// Create a TMDB client instance
			$client = new TMDBClient(Yii::app()->params['apiRootUrl'], Yii::app()->params['apiKey']);

			if ($type == 'person') {
				$client->searchPerson($query);
				$actors = $client->response->results;
			} else if ($type == 'movie') {
				$client->searchMovie($query);
				$movies = $client->response->results;
			}
		}

		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index', array('query'=>$query, 'type'=> $type, 'client'=>$client, 'actors'=>$actors, 'movies'=>$movies));
	}


	/**
	 * actionPerson
	 *
	 * @access public
	 */
	public function actionPerson() {
		$client = null;
		$id = $_GET['id'];
		$person = null;
		$movies = null;

		if ($id) {
			// Create a TMDB client instance
			$client = new TMDBClient(Yii::app()->params['apiRootUrl'], Yii::app()->params['apiKey']);

			// Get the person details
			$client->getPersonDetails($id);
			$person = $client->response;

			// Get the movies where it has acted, sorted by date
			$client->getMoviesByPersonId($person->id);
			$movies = $client->response->cast;
			if ($movies) {
				usort($movies, "release_date_cmp");
			}
		}

		$this->render('person', array('client'=>$client, 'id'=> $id, 'person'=>$person, 'movies'=>$movies));
	}


	/**
	 * actionMovie
	 *
	 * @access public
	 */
	public function actionMovie() {
		$client = null;
		$id = $_GET['id'];
		$movie = null;

		if ($id) {
			// Create a TMDB client instance
			$client = new TMDBClient(Yii::app()->params['apiRootUrl'], Yii::app()->params['apiKey']);

			// Get the person details
			$client->getMovieDetails($id);
			$movie = $client->response;
		}

		$this->render('person', array('client'=>$client, 'id'=> $id, 'movie'=>$movie));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}

?>