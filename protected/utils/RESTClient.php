<?php
/**
* RESTClient
*
* RESTClient: Simple JSON REST Client, based on http://snipplr.com/view/44760/
*
* @uses      curl
*
* @author    Daniel Garcia <daniel@danielgarcia.co>
*/
class RESTClient {
	/**
	 * $handle
	 *
	 * The CURL handle.
	 *
	 * @var curl
	 *
	 * @access public
	 */
	public $handle;

	/**
	 * $response
	 *
	 * HTTP response from the current session.
	 *
	 * @var object(stdClass)
	 *
	 * @access public
	 */
	public $response;

	/**
	 * $http_code
	 *
	 * HTTP response code from the current session.
	 *
	 * @var int
	 *
	 * @access public
	 */
	public $http_code;

	/**
	 * $error
	 *
	 * Last error message for the current session.
	 *
	 * @var string
	 *
	 * @access public
	 */
	public $error;

	/**
	 * __construct
	 *
	 * Constructor of the class.
	 *
	 * @access public
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * init
	 *
	 * Creates the curl handle and configures common headers for the requests.
	 *
	 * @access private
	 */
	private function init() {
		$headers = array(
			'Accept: application/json',
			'Content-Type: application/json',
		);
		$this->handle = curl_init();
		curl_setopt($this->handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->handle, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($this->handle, CURLOPT_SSL_VERIFYPEER, false);
	}

	/**
	 * close
	 *
	 * Closes the curl handle.
	 *
	 * @access private
	 */
	private function close() {
		curl_close($this->handle);
	}

	/**
	 * exec
	 *
	 * Executes the request and saves the http response, http response code and error message (if any).
	 *
	 * @access private
	 */
	private function exec() {
		$this->response = json_decode(curl_exec($this->handle));
		$this->http_code = curl_getinfo($this->handle, CURLINFO_HTTP_CODE);
		$this->error = curl_error($this->handle);
	}

	/**
	 * GET
	 *
	 * Implements the GET method.
	 *
	 * @param string $url        URL to request.
	 * @param string $url_params URL parameters to send.
	 *
	 * @access public
	 */
	public function GET($url, $url_params='') {
		curl_setopt($this->handle, CURLOPT_URL, $url . '?' . $url_params);
		$this->exec();
	}

	/**
	 * POST
	 *
	 * Implements the POST method.
	 *
	 * @param string $url        URL to request.
	 * @param array  $data_array Array containing the data to send.
	 *
	 * @access public
	 */
	public function POST($url, $data_array) {
		$data = json_encode($data_array);
		curl_setopt($this->handle, CURLOPT_URL, $url);
		curl_setopt($this->handle, CURLOPT_POST, true);
		curl_setopt($this->handle, CURLOPT_POSTFIELDS, $data);
		$this->exec();
	}

	/**
	 * PUT
	 *
	 * Implements the PUT method.
	 *
	 * @param string $url        URL to request.
	 * @param array  $data_array Array containing the data to send.
	 *
	 * @access public
	 */
	public function PUT($url, $data_array) {
		$data = json_encode($data_array);
		curl_setopt($this->handle, CURLOPT_URL, $url);
		curl_setopt($this->handle, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($this->handle, CURLOPT_POSTFIELDS, $data);
		$this->exec();
	}

	/**
	 * DELETE
	 *
	 * Implements the DELETE method.
	 *
	 * @param string $url URL to request.
	 *
	 * @access public
	 */
	public function DELETE($url) {
		curl_setopt($this->handle, CURLOPT_URL, $url);
		curl_setopt($this->handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
		$this->exec();
	}
}
?>