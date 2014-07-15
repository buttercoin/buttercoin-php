<?php

namespace Buttercoin\Client;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Buttercoin\Exception\RuntimeException;

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
		$default = array(
			'baseUrl' => 'http://localhost:9002/{version}/',
			'version' => 'v1',
			'publicKey' => null,
			'secretKey' => null
		);

		$config = Collection::fromConfig($config, $default);

		$client = new self($config->get('baseUrl'), $config);

		$file = 'buttercoin-' . str_replace('.', '_', $client->getConfig('version')) . '.php';
		$client->setDescription(ServiceDescription::factory(__DIR__ . "/Resources/{$file}"));

		// Set the content type header to use "application/json" for all requests
        $client->setDefaultOption('headers', array('Content-Type' => 'application/json'));

        return $client;
	}

	/**
     * Magic method used to retrieve a command
     *
     * @param string $method Name of the command object to instantiate
     * @param array  $args   Arguments to pass to the command
     *
     * @return mixed Returns the result of the command
     */
    public function __call($method, $args)
    {
        return $this->getCommand($method, $args)->getResult();
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
	 * @params array $params the params to use for the method
	 * @params boolean $handleParams set to true if params are part of the signed URL separately 
	 *
	 * return string the full url with properly formatted query params (json for POST, queryString for get)
	 */
	public function getUrl($command, $params, $handleParams = true)
	{
		$url = str_replace('{version}', $this->getConfig('version'), $this->getConfig('baseUrl'));
		$url .= $this->getCommand($command, [])->getClient()->getDescription()->getOperation($command)->getUri();
		$url = str_replace('{id}', $params['id'], $url);

		$httpMethod = $this->getCommand($command, [])->getClient()->getDescription()->getOperation($command)->getHttpMethod();

		if (count($params) > 0 && $handleParams) {
			if ($httpMethod === "GET") {
				$url .= "?" . http_build_query($params);
			} else if ($httpMethod === "POST") {
				$url .= json_encode($params);
			}
		}
		print_r($url . PHP_EOL);
		
		// TODO: logic for GET and POST requests to add query params if necessary
		return $url;
	}

	/**
	 * Shortcut for the getTicker command
	 *
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getTicker($timestamp)
	{

		return $this->buildCommand('getTicker', $timestamp);
	}

	/**
	 * Shortcut for the getOrderBook command
	 *
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getOrderBook($timestamp)
	{

		return $this->buildCommand('getOrderBook', $timestamp);
	}

	/**
	 * Shortcut for the getKey command
	 *
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getKey($timestamp)
	{
		return $this->buildCommand('getKey', $timestamp);
	}

	/**
	 * Shortcut for the getBalances command
	 *
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getBalances($timestamp)
	{
		return $this->buildCommand('getBalances', $timestamp);
	}

	/**
	 * Shortcut for the getDepositAddress command
	 *
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getDepositAddress($timestamp)
	{
		return $this->buildCommand('getDepositAddress', $timestamp);
	}

	/**
	 * Shortcut for the createOrder command
	 *
	 * @param string $orderId the UUIDv4 id of the order to get
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getOrder($orderId, $timestamp )
	{
		return $this->buildCommand('getOrder', $timestamp, ["id" => $orderId], false);
	}

	/**
	 * Shortcut for the createOrder command
	 *
	 * @param array $data array contain data for order creation (Please see Buttercoin docs)
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function getOrders($data, $timestamp)
	{
		$orders = $this->buildCommand('getOrders', $timestamp, $data);
		return $orders['results'];
	}

	/**
	 * Shortcut for the createOrder command
	 *
	 * @param array $data array contain data for order creation (Please see Buttercoin docs)
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function createOrder($data, $timestamp)
	{
		return $this->buildCommand('createOrder', $timestamp, $data);
	}

	/**
	 * Shortcut for the deleteOrder command
	 *
	 * @param string $orderId the UUIDv4 id of the order to delete
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 *
	 * @return mixed
	 */
	public function deleteOrder($orderId, $timestamp )
	{
		return $this->buildCommand('deleteOrder', $timestamp, ["id" => $orderId], false);
	}

	private function buildCommand($command, $timestamp, $params = [], $handleParams = true)
	{
		$url = $this->getUrl($command, $params, $handleParams);

		$params['X-Buttercoin-Access-Key'] = $this->getConfig('publicKey');
		$params['X-Buttercoin-Date'] = "$timestamp";
		$params['X-Buttercoin-Signature'] = $this->getXButtercoinSignature($url, $timestamp);
		$params['X-Forwarded-For'] = '127.0.0.1';
		print_r($params);
		$this->getConfig()->set('command.params', $params);
		return $this->getCommand($command, $params)->getResult();
	}
}
