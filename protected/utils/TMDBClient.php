<?php
/**
* TMDBClient
*
* TMDBClient: Simple TMDB (The Movie Database) REST Client.
* Notice its methods are limited to the ones needed for this project.
* API docs: http://docs.themoviedb.apiary.io/
*
* @uses      RESTClient
*
* @author    Daniel Garcia <daniel@danielgarcia.co>
*/
class TMDBClient extends RESTClient {

	/**
	 * $config
	 *
	 * @var mixed
	 *
	 * @access public
	 */
	public $config;

	/**
	 * $api_root_url
	 *
	 * @var string
	 *
	 * @access public
	 */
	public $api_root_url;

	/**
	 * $api_key
	 *
	 * @var string
	 *
	 * @access public
	 */
	public $api_key;

	/**
	 * __construct
	 *
	 * Constructor of the class.
	 *
	 * @param string $api_root_url API Root URL.
	 * @param string $api_key      API Key.
	 *
	 * @access public
	 */
	public function __construct($api_root_url, $api_key) {
		$this->api_root_url = $api_root_url;
		$this->api_key = $api_key;

		parent::__construct();

		// Get some config parameters from TMDB
		$this->getConfiguration();
		$this->config = $this->response;
	}

	/**
	 * GET
	 *
	 * Overrides the GET method to handle the API root url and API key.
	 *
	 * @param string $service_name Name (path) of the service.
	 * @param string $query_string Query parameters.
	 *
	 * @access public
	 */
	public function GET($service_name, $url_params='') {
		$url = $this->api_root_url . $service_name;
		$url_params = $url_params . '&api_key=' . $this->api_key;
		parent::GET($url, $url_params);
	}

	/**
	 * POST
	 *
	 * Overrides the POST method to handle the API root url and API key.
	 *
	 * @param string $service_name Name (path) of the service.
	 * @param array  $data_array   Array containing the data to send.
	 *
	 * @access public
	 */
	public function POST($service_name, $data_array) {
		$url = $this->api_root_url . $service_name;
		$data_array['api_key']=$this->api_key;
		parent::POST($url, $data_array);
	}

	/**
	 * PUT
	 *
	 * Overrides the PUT method to handle the API root url and API key.
	 *
	 * @param string $service_name Name (path) of the service.
	 * @param array  $data_array   Array containing the data to send.
	 *
	 * @access public
	 */
	public function PUT($service_name, $data_array) {
		$url = $this->api_root_url . $service_name;
		$data_array['api_key']=$this->api_key;
		parent::PUT($url, $data_array);
	}

	/**
	 * DELETE
	 *
	 * Overrides the DELETE method to handle the API root url and API key.
	 *
	 * @param string $service_name Name (path) of the service.
	 *
	 * @access public
	 */
	public function DELETE($service_name) {
		$url = $this->api_root_url . $service_name;
		parent::DELETE($url);
	}

	/**
	 * getConfiguration
	 *
	 * Requests the configuration parameters from TMDB
	 *
	 * @access public
	 */
	public function getConfiguration() {
		$service = 'configuration';
		$this->GET($service);
	}

	/**
	 * searchPerson
	 *
	 * @param string $query Requests the persons matching the given name.
	 *
	 * @access public
	 */
	public function searchPerson($query) {
		$service = 'search/person';
		$query = "query=".urlencode($query);
		$this->GET($service, $query);
	}

	/**
	 * getMoviesByPerson
	 *
	 * Requests the movies with credits matching the given person id.
	 *
	 * @param string $person_id Description.
	 *
	 * @access public
	 */
	public function getMoviesByPerson($person_id) {
		$service = 'person/'.urlencode($person_id).'/credits';
		$this->GET($service);
	}
}

/**
 * release_date_cmp
 *
 * Auxiliar function to sort movies by release date.
 *
 * @param object $movie_a Movie 'a'.
 * @param object $movie_b Movie 'b'.
 *
 * @access public
 *
 * @return int Returns < 0 if $movie_b->release_date is less than $movie_a->release_date; > 0 if $movie_b->release_date is greater than $movie_a->release_date, and 0 if they are equal.
 */
function release_date_cmp($movie_a, $movie_b) {
	return strcmp($movie_b->release_date, $movie_a->release_date);
}
?>