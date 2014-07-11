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
			'baseUrl' => 'https://api.buttercoin.com/{version}/',
			'version' => 'v1',
			'publicKey' => null,
			'secretKey' => null
		);

		$config = Collection::fromConfig($config, $default);

		$client - new self($config->get('baseUrl'), $config);

		$file = 'buttercoin' . str_replace('.', '_', $client->getConfig('version')) . '.php';
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
        return $this->getCommand($method, isset($args[0]) ? $args[0] : array())->getResult();
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
	 * set X-Buttercoin-Access-Key
	 *
	 * @param string $key
	 */
	public function setXButtercoinAccessKey($key)
	{
		return $this->getConfig()->set('X-Buttercoin-Access-Key', $key);
	}

	/**
	 * get X-Buttercoin-Access-Key
	 *
	 * @return string|null value of X-Buttercoin-Access-Key
	 */
	public function getXButtercoinAccessKey()
	{
		return $this->getConfig('X-Buttercoin-Access-Key');
	}

	/**
	 * set X-Buttercoin-Signature
	 *
	 * @param string $url the full url of the API call
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 */
	public function setXButtercoinSignature($url, $timestamp)
	{
		$tsUrl = $timestamp . $url;
		$encodedUrl = base64_encode(utf8_encode($tsUrl));
		$signature = base64_encode(hash_hmac('sha256', $encodedUrl, SECRET, TRUE));
		return $this->getConfig()->set('X-Buttercoin-Signature', $signature);
	}

	/**
	 * get X-Buttercoin-Signature
	 *
	 * @return string|null value of X-Buttercoin-Signature
	 */
	public function getXButtercoinSignature()
	{
		return $this->getConfig('X-Buttercoin-Signature');
	}

	/**
	 * set X-Buttercoin-Date
	 *
	 * @param integer $timestamp UNIX timestamp must be within 5 mins of Buttercoin UTC server time
	 */
	public function setXButtercoinDate($timestamp)
	{
		return $this->getConfig()->set('X-Buttercoin-Date', $timestamp);
	}

	/**
	 * get X-Buttercoin-Date
	 *
	 * @return string|null value of X-Buttercoin-Date
	 */
	public function getXButtercoinDate()
	{
		return $this->getConfig('X-Buttercoin-Date');
	}

	/**
	 * get URL
	 *
	 * @param string $command the command to use to create the URL
	 * @params array $params the params to use for the method
	 *
	 * return string the full url with properly formatted query params (json for POST, queryString for get)
	 */
	public function getUrl($command, $params)
	{
		$url = str_replace('{version}', $this->getConfig('version'), $this->getConfig('baseUrl'));
		$url .= $this->getCommand($command)['uri'];
		
		// TODO: logic for GET and POST requests to add query params if necessary

		return $url;
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

	private function buildCommand($command, $timestamp, $params = [])
	{
		$this->setXButtercoinAccessKey($this->getConfig('publicKey'));
		$this->setXButtercoinDate($timestamp);
		$url = $this->getUrl($command, $params);
		$this->setXButtercoinSignature($url, $timestamp);

		return $this->getCommand($command)->getResult();
	}
	

}
