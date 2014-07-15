<?php

return array(
    'name'			=> 'Buttercoin',
    'apiVersion'	=> 'v1',
	'operations'	=> array(
		'getTicker' 	=> array(
			'uri'		=> 'ticker',
			'description'	=> 'get the latest bid, ask, and trade price',
			'httpMethod'	=> 'GET'
		),
		'getOrderBook' 	=> array(
			'uri'		=> 'orderbook',
			'description'	=> 'get all the current open bids and asks in the order book',
			'httpMethod'	=> 'GET'
		),
		'getKey'		=> array(
			'uri'		=> 'key',
			'description'	=> 'get the permissions associated with this API Key',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'		=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'		=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'		=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				)
			)
		),
		'getBalances' => array(
			'uri'		=> 'account/balances',
			'description'	=> 'get the balances associated with this account',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'		=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'		=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'		=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				)
			)
			
		),
		'getDepositAddress'	=> array(
			'uri'			=> 'account/depositAddress',
			'description'		=> 'get the bitcoin deposit address for this account',
			'httpMethod'		=> 'GET',
			'parameters'		=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'		=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'		=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' 	=> array (
					'location'		=> 'header',
					'description'		=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				)
			)
		),
		'getOrder' => array(
			'uri'		=> 'orders/{id}',
			'description'	=> 'get order by id',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'		=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'		=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'		=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'id'       => array(
					'location' 		=> 'uri',
					'type'     		=> 'string',
					'description' 		=> 'UUIDv4 id of the order to get',
					'required' 		=> true
				)
			)
			
		),
		'getOrders' => array(
			'uri'		=> 'orders',
			'description'	=> 'get orders',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'		=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'		=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' 	=> array (
					'location'		=> 'header',
					'description'		=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'status'       		=> array(
					'location' 		=> 'query',
					'description'		=> 'opened, reopened, filled, or canceled',
					'type'     		=> 'string',
					'required'		=> false
				),
				'side'       		=> array(
					'location' 		=> 'query',
					'description'		=> 'buy or sell',
					'type'     		=> 'string',
					'required'		=> false
				),
				'orderType'       	=> array(
					'location' 		=> 'query',
					'description'		=> 'market or limit',
					'type'     		=> 'string',
					'required'		=> false
				),
				'dateMin'       	=> array(
					'location' 		=> 'query',
					'description'		=> 'ISO 8601 Date-Time',
					'type'     		=> 'string',
					'required'		=> false
				),
				'dateMax'       	=> array(
					'location' 		=> 'query',
					'description'		=> 'ISO 8601 Date-Time',
					'type'     		=> 'string',
					'required'		=> false
				)
				
				
				
				
			)
			
		),
		'createOrder' => array(
			'uri'		=> 'orders',
			'description'	=> 'create a new order',
			'httpMethod'	=> 'POST',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'		=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'		=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' 	=> array (
					'location'		=> 'header',
					'description'		=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'instrument'       	=> array(
					'location' 		=> 'json',
					'description'		=> 'The two assets being traded (e.g. BTC_USD or USD_BTC)',
					'type'     		=> 'string',
					'required'		=> true
				),
				'side'       		=> array(
					'location' 		=> 'json',
					'description'		=> 'buy or sell',
					'type'     		=> 'string',
					'required'		=> true
				),
				'orderType'       	=> array(
					'location' 		=> 'json',
					'description'		=> 'market or limit',
					'type'     		=> 'string',
					'required'		=> true
				),
				'price'       		=> array(
					'location' 		=> 'json',
					'description'		=> 'the amount paid for the asset',
					'type'     		=> 'string',
					'required'		=> true
				),
				'quantity' 	      	=> array(
					'location' 		=> 'json',
					'description'		=> 'the quantity of asset desired (required for limit orders)',
					'type'     		=> 'string',
					'required'		=> false
				)
			)
			
		),
		'deleteOrder' => array(
			'uri'		=> 'orders/{id}',
			'description'	=> 'get order by id',
			'httpMethod'	=> 'DELETE',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'		=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'		=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' 	=> array (
					'location'		=> 'header',
					'description'		=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'		=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> true
				),
				'id'       		=> array(
					'location' => 'uri',
					'type'     => 'string',
					'description' => 'UUIDv4 id of the order to get',
					'required' => true
				)
			)
			
		)
	)
);
