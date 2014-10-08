<?php

namespace Buttercoin\Client;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Http\Exception\BadResponseException;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Common\Event;

/**
 * Class ButtercoinClient
 *
 * @package Buttercoin\Client
 *
 */

class ButtercoinClient extends Client
{
	public static function factory ($config = array())
	{
		// default to production environment
		$default = array(
			'baseUrl' => 'https://api.buttercoin.com/{version}/',
			'version' => 'v1',
			'publicKey' => null,
			'secretKey' => null
		);

		if (isset($config['environment'])) {
			if ($config['environment'] === 'sandbox' || $config['environment'] === 'staging') {
				$default['baseUrl'] = 'https://sandbox.buttercoin.com/{version}/';
			} else if ($config['environment'] !== 'production') {
				throw new Exception('Invalid environment');
			}	
		}

		$config = Collection::fromConfig($config, $default);

		$client = new self($config->get('baseUrl'), $config);

		$file = 'buttercoin-' . str_replace('.', '_', $client->getConfig('version')) . '.php';
		$client->setDescription(ServiceDescription::factory(__DIR__ . "/Resources/{$file}"));

		// Set the content type header to use "application/json" for all requests
		$client->setDefaultOption('headers', array('Content-Type' => 'application/json'));

        return $client;
	}

	/**
     * Sets the API Version used by the Buttercoin Client.
     * Changing the API Version will attempt to load a new Service Definition for that Version.
     *
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->getConfig()->set('version', $version);

        /* Set the Service Definition from the versioned file */
        $file = 'buttercoin-' . str_replace('.', '_', $this->getConfig('version')) . '.php';
        $this->setDescription(ServiceDescription::factory(__DIR__ . "/Resources/{$file}"));
    }

    /**
     * Gets the Version being used by the Buttercoin Client
     *
     * @return string|null Value of the Version or NULL
     */
    public function getVersion()
    {
        return $this->getConfig('version');
    }

	/**
	 * set Public Key
	 *
	 * @param string $publicKey
	 */
	public function setPublicKey($publicKey)
	{
		return $this->getConfig()->set('publicKey', $publicKey);
	}

	/**
	 * get Public Key
	 *
	 * @return string|null value of public key
	 */
	public function getPublicKey()
	{
		return $this->getConfig('publicKey');
	}

	/**
	 * set Secret Key
	 *
	 * @param string $secretKey
	 */
	public function setSecretKey($secretKey)
	{
		return $this->getConfig()->set('secretKey', $secretKey);
	}

	/**
	 * get Secret Key
	 *
	 * @return string|null value of secret key
	 */
	public function getSecretKey()
	{
		return $this->getConfig('secretKey');
	}

	/**
	 * set Environment
	 *
	 * @param string $environment
	 */
	public function setEnvironment($environment)
	{
		return $this->getConfig()->set('environment', $environment);
	}

	/**
	 * get Environment
	 *
	 * @return string|null value of environment
	 */
	public function getEnvironment()
	{
		return $this->getConfig('environment');
	}

	/**
	 * get X-Buttercoin-Signature
	 *
	 * @return string|null value of X-Buttercoin-Signature
	 */
	public function getXButtercoinSignature($url, $timestamp)
	{
		$tsUrl = $timestamp . $url;
		$encodedUrl = base64_encode(utf8_encode($tsUrl));
		$signature = base64_encode(hash_hmac('sha256', $encodedUrl, $this->getSecretKey(), TRUE));
		return $signature;
	}

	/**
	 * get URL
	 *
	 * @param string $command the command to use to create the URL
	 * @param array $params the params to use for the method
	 * @param boolean $handleParams set to true if params are part of the signed URL separately 
	 *
	 * return string the full url with properly formatted query params (json for POST, queryString for GET)
	 */
	public function getUrl($command, $params, $handleParams = true)
	{
		$url = str_replace('{version}', $this->getConfig('version'), $this->getConfig('baseUrl'));
		$url .= $this->getCommand($command, [])->getClient()->getDescription()->getOperation($command)->getUri();
		if (isset($params['id']))
			$url = str_replace('{id}', $params['id'], $url);

		$httpMethod = $this->getCommand($command, [])->getClient()->getDescription()->getOperation($command)->getHttpMethod();

		if (count($params) > 0 && $handleParams) {
			if ($httpMethod === "GET") {
				$url .= "?" . http_build_query($params);
			} else if ($httpMethod === "POST") {
				$url .= json_encode($params);
			}
		}
		
		return $url;
	}

	/**
	 * Shortcut for the getTicker command
	 *
	 * @return mixed
	 */
	public function getTicker()
	{
		// set headers, if necessary
		$this->_setHeaders(null, null, false);
		return $this->_sendCommand('getTicker');
	}

	/**
	 * Shortcut for the getOrderBook command
	 *
	 * @return mixed
	 */
	public function getOrderBook()
	{
		// set headers, if necessary
		$this->_setHeaders(null, null, false);
		return $this->_sendCommand('getOrderBook');
	}

	/**
	 * Shortcut for the getOrderBook command
	 *
	 * @return mixed
	 */
	public function getTradeHistory()
	{
		// set headers, if necessary
		$this->_setHeaders(null, null, false);
		return $this->_sendCommand('getTradeHistory');
	}

	/**
	 * Shortcut for the getKey command
	 *
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getKey($timestamp = null)
	{
		$result = $this->_buildCommand('getKey', $timestamp);
		if (isset($result['errors'])) {
			return $result;
		} else {
			return $result['permissions'];
		}
	}

	/**
	 * Shortcut for the getBalances command
	 *
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getBalances($timestamp = null)
	{
		return $this->_buildCommand('getBalances', $timestamp);
	}

	/**
	 * Shortcut for the getDepositAddress command
	 *
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getDepositAddress($timestamp = null)
	{
		$result = $this->_buildCommand('getDepositAddress', $timestamp);
		if (isset($result['errors'])) {
			return $result;
		} else {
			return $result['address'];
		}
	}

	/**
	 * Shortcut for the getOrder command
	 *
	 * @param string $orderId the UUIDv4 id of the order to get
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getOrderById($orderId, $timestamp = null)
	{
		return $this->_buildCommand('getOrder', $timestamp, ["id" => $orderId], false);
	}

	/**
	 * Shortcut for the getOrderByUrl command
	 *
	 * @param string $url the location URL of the order to get
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getOrderByUrl($url, $timestamp = null)
	{
		$orderId = self::_parseId($url);
		return $this->_buildCommand('getOrder', $timestamp, ["id" => "$orderId"], false);
	}

	/**
	 * Shortcut for the getOrders command
	 *
	 * @param array $data array contain data for order query (Please see Buttercoin docs)
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getOrders($data, $timestamp = null)
	{
		$result = $this->_buildCommand('getOrders', $timestamp, $data);
		if (isset($result['errors'])) {
			return $result;
		} else {
			return $result['results'];
		}
	}

	/**
	 * Shortcut for the createOrder command
	 *
	 * @param array $data array contain data for order creation (Please see Buttercoin docs)
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function createOrder($data, $timestamp = null)
	{
		$result = $this->_buildCommand('createOrder', $timestamp, $data);
		if (is_array($result) && isset($result['errors'])) {
			return $result;
		} else {
			return $result->getLocation();
		}
	}

	/**
	 * Shortcut for the cancelOrder command
	 *
	 * @param string $orderId the UUIDv4 id of the order to cancel
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function cancelOrder($orderId, $timestamp = null)
	{
		$result = $this->_buildCommand('cancelOrder', $timestamp, ["id" => $orderId], false);
		if (is_array($result) && isset($result['errors'])) {
			return $result;
		} else {
			return [ 'status' => 204, 'message' => 'Order canceled successfully'];
		}
	}

	/**
	 * Shortcut for the getTransactionById command
	 *
	 * @param string $transactionId the UUIDv4 id of the transaction to get
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getTransactionById($transactionId, $timestamp = null)
	{
		return $this->_buildCommand('getTransaction', $timestamp, ["id" => $transactionId], false);
	}

	/**
	 * Shortcut for the getTransactionByUrl command
	 *
	 * @param string $url the location URL of the order to get
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getTransactionByUrl($url, $timestamp = null)
	{
		$transactionId = self::_parseId($url);
		return $this->_buildCommand('getTransaction', $timestamp, ["id" => "$transactionId"], false);
	}
	
	/**
	 * Shortcut for the getTransactions command
	 *
	 * @param array $data array contain data for transaction query (Please see Buttercoin docs)
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getTransactions($data, $timestamp = null)
	{
		$result = $this->_buildCommand('getTransactions', $timestamp, $data);
		if (isset($result['errors'])) {
			return $result;
		} else {
			return $result['results'];
		}
	}

	/**
	 * Shortcut for the createDeposit command
	 *
	 * @param array $data array contain data for deposit creation (Please see Buttercoin docs)
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function createDeposit($data, $timestamp = null)
	{
		$result = $this->_buildCommand('createDeposit', $timestamp, $data);
		if (is_array($result) && isset($result['errors'])) {
			return $result;
		} else {
			return $result->getLocation();
		}
	}

	/**
	 * Shortcut for the createWithdrawal command
	 *
	 * @param array $data array contain data for withdrawal creation (Please see Buttercoin docs)
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function createWithdrawal($data, $timestamp = null)
	{
		$result = $this->_buildCommand('createWithdrawal', $timestamp, $data);
		if (is_array($result) && isset($result['errors'])) {
			return $result;
		} else {
			if ($result->getStatusCode() === 201) {
				return [ "status" => 201, "message" => "Withdraw request created, but email confirmation is required" ];
			} else {
				return [ "status" => 202, "message" => $result->getLocation()];
			}
		}
	}

	/**
	 * Shortcut for the sendCrypto command
	 *
	 * @param array $data array contain data for send creation (Please see Buttercoin docs)
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function sendCrypto($data, $timestamp = null)
	{
		$result = $this->_buildCommand('send', $timestamp, $data);
		if (is_array($result) && isset($result['errors'])) {
			return $result;
		} else {
			if ($result.getStatusCode() === 201) {
				return [ "status" => 201, "message" => "Send request created, but email confirmation is required" ];
			} else {
				return [ "status" => 202, "message" => $result->getLocation()];
			}
		}
	}

	/**
	 * Shortcut for the cancelTransaction command
	 *
	 * @param string $transactionId the UUIDv4 id of the order to cancel
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function cancelTransaction($transactionId, $timestamp = null)
	{
		$result = $this->_buildCommand('cancelTransaction', $timestamp, ["id" => $transactionId], false);
		if (is_array($result) && isset($result['errors'])) {
			return $result;
		} else {
			return [ 'status' => 204, 'message' => 'Transaction canceled successfully'];
		}
	}

	/**
	 * Set Headers, build URL, and send the authenticated request
	 *
	 * @param string $command the name of the command to send
	 * @param integer $timestamp UNIX timestamp must be withing 5 mins of Buttercoin UTC server time
	 * @param array $params request params to send
	 * @param boolean $handleParams if true, add the params in the proper format for URL signing
	 */
	private function _buildCommand($command, $timestamp, $params = [], $handleParams = true)
	{
		$this->getConfig()->set('command.params', $params);
		$url = $this->getUrl($command, $params, $handleParams);
		$this->_setHeaders($url, $timestamp);
		return $this->_sendCommand($command, $params);
	}

	private function _sendCommand($command, $params = [])
	{
		try {
			return $this->getCommand($command, $params)->execute();
		} catch (ClientErrorResponseException $e) {
			$response = $e->getResponse();
			return json_decode($response->getBody(true), true);
		}
	}

	/**
	 * Set Headers for the API Request
	 * 
	 * @param string $url the correctly formatted url to sign
	 * @param integer $timestamp UNIX timestamp must be withing 5 mins of Buttercoin UTC server time
	 * @param boolean $authenticate set to false for unauthenticated requests (e.g. ticker or orderbook)
	 */
	private function _setHeaders($url, $timestamp, $authenticate = true)
	{
		if (!$timestamp)
			$timestamp = round(microtime(true) * 1000);

		$params = $this->getConfig()->get('command.params');
		if ($authenticate === true) {
			$params['X-Buttercoin-Access-Key'] = $this->getConfig('publicKey');
			$params['X-Buttercoin-Date'] = "$timestamp";
			$params['X-Buttercoin-Signature'] = $this->getXButtercoinSignature($url, $timestamp);
		}
		if ($this->getConfig()->get('environment') === 'localhost') {
			$params['X-Forwarded-For'] = '127.0.0.1';
		}
		$this->getConfig()->set('command.params', $params);
	}

	private static function _parseId($url)
	{
		return substr(strrchr($url, '/'), 1);
	}
}
