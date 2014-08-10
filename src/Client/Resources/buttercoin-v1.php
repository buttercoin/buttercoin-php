<?php

return array(
    'name'			=> 'Buttercoin',
    'apiVersion'	=> 'v1',
	'operations'	=> array(
		'getTicker' 	=> array(
			'uri'			=> 'ticker',
			'description'	=> 'get the latest bid, ask, and trade price',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				)
			)
		),
		'getOrderBook' 	=> array(
			'uri'			=> 'orderbook',
			'description'	=> 'get all the current open bids and asks in the order book',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				)
			)
		),
		'getKey'		=> array(
			'uri'			=> 'key',
			'description'	=> 'get the permissions associated with this API Key',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				)
			)
		),
		'getBalances' => array(
			'uri'			=> 'account/balances',
			'description'	=> 'get the balances associated with this account',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				)
			)
		),
		'getDepositAddress'	=> array(
			'uri'				=> 'account/depositAddress',
			'description'		=> 'get the bitcoin deposit address for this account',
			'httpMethod'		=> 'GET',
			'parameters'		=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				)
			)
		),
		'getOrder' => array(
			'uri'			=> 'orders/{id}',
			'description'	=> 'get order by id',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				),
				'id'       			=> array(
					'location' 		=> 'uri',
					'type'     		=> 'string',
					'description' 	=> 'UUIDv4 id of the order to get',
					'required' 		=> true
				)
			)
		),
		'getOrders' => array(
			'uri'			=> 'orders',
			'description'	=> 'get orders',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				),
				'status'       		=> array(
					'location' 		=> 'query',
					'description'	=> 'opened, reopened, filled, or canceled',
					'type'     		=> 'string',
					'required'		=> false
				),
				'side'       		=> array(
					'location' 		=> 'query',
					'description'	=> 'buy or sell',
					'type'     		=> 'string',
					'required'		=> false
				),
				'orderType'       	=> array(
					'location' 		=> 'query',
					'description'	=> 'market or limit',
					'type'     		=> 'string',
					'required'		=> false
				),
				'dateMin'       	=> array(
					'location' 		=> 'query',
					'description'	=> 'ISO 8601 Date-Time',
					'type'     		=> 'string',
					'required'		=> false
				),
				'dateMax'       	=> array(
					'location' 		=> 'query',
					'description'	=> 'ISO 8601 Date-Time',
					'type'     		=> 'string',
					'required'		=> false
				)
			)
		),
		'createOrder' => array(
			'uri'			=> 'orders',
			'description'	=> 'create a new order',
			'httpMethod'	=> 'POST',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				),
				'instrument'       	=> array(
					'location' 		=> 'json',
					'description'	=> 'The two assets being traded (e.g. BTC_USD or USD_BTC)',
					'type'     		=> 'string',
					'required'		=> true
				),
				'side'       		=> array(
					'location' 		=> 'json',
					'description'	=> 'buy or sell',
					'type'     		=> 'string',
					'required'		=> true
				),
				'orderType'       	=> array(
					'location' 		=> 'json',
					'description'	=> 'market or limit',
					'type'     		=> 'string',
					'required'		=> true
				),
				'price'       		=> array(
					'location' 		=> 'json',
					'description'	=> 'the amount paid for the asset',
					'type'     		=> 'string',
					'required'		=> false
				),
				'quantity' 	      	=> array(
					'location' 		=> 'json',
					'description'	=> 'the quantity of asset desired (required for limit orders)',
					'type'     		=> 'string',
					'required'		=> false
				)
			)
		),
		'cancelOrder' => array(
			'uri'			=> 'orders/{id}',
			'description'	=> 'cancel order by id',
			'httpMethod'	=> 'DELETE',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				),
				'id'       			=> array(
					'location' 		=> 'uri',
					'type'     		=> 'string',
					'description' 	=> 'UUIDv4 id of the order to cancel',
					'required' 		=> true
				)
			)
		),
		'getTransaction' => array(
			'uri'			=> 'transactions/{id}',
			'description'	=> 'get transaction by id',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				),
				'id'       			=> array(
					'location' 		=> 'uri',
					'type'     		=> 'string',
					'description' 	=> 'UUIDv4 id of the transaction to get',
					'required' 		=> true
				)
			)
		),
		'getTransactions' => array(
			'uri'			=> 'transactions',
			'description'	=> 'get transactions',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				),
				'status'       		=> array(
					'location' 		=> 'query',
					'description'	=> 'pending, processing, funded, canceled, or failed',
					'type'     		=> 'string',
					'required'		=> false
				),
				'transactionType'  	=> array(
					'location' 		=> 'query',
					'description'	=> 'deposit or withdrawal',
					'type'     		=> 'string',
					'required'		=> false
				),
				'dateMin'       	=> array(
					'location' 		=> 'query',
					'description'	=> 'ISO 8601 Date-Time',
					'type'     		=> 'string',
					'required'		=> false
				),
				'dateMax'       	=> array(
					'location' 		=> 'query',
					'description'	=> 'ISO 8601 Date-Time',
					'type'     		=> 'string',
					'required'		=> false
				)
			)
		),
		'createDeposit' => array(
			'uri'			=> 'transactions/deposit',
			'description'	=> 'create a new deposit',
			'httpMethod'	=> 'POST',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				),
				'method' 	       	=> array(
					'location' 		=> 'json',
					'description'	=> 'only wire method available right now',
					'type'     		=> 'string',
					'required'		=> true
				),
				'currency'     		=> array(
					'location' 		=> 'json',
					'description'	=> 'USD only right now',
					'type'     		=> 'string',
					'required'		=> true
				),
				'amount'       		=> array(
					'location' 		=> 'json',
					'description'	=> 'amount to deposit',
					'type'     		=> 'string',
					'required'		=> true
				)
			)
		),
		'createWithdrawal' => array(
			'uri'			=> 'transactions/withdraw',
			'description'	=> 'create a new withdrawal',
			'httpMethod'	=> 'POST',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				),
				'method' 	       	=> array(
					'location' 		=> 'json',
					'description'	=> 'only check method available right now',
					'type'     		=> 'string',
					'required'		=> true
				),
				'currency'     		=> array(
					'location' 		=> 'json',
					'description'	=> 'USD only right now',
					'type'     		=> 'string',
					'required'		=> true
				),
				'amount'       		=> array(
					'location' 		=> 'json',
					'description'	=> 'amount to withdraw',
					'type'     		=> 'string',
					'required'		=> true
				)
			)
		),
		'sendCrypto' => array(
			'uri'			=> 'transactions/send',
			'description'	=> 'send bitcoins to a designated address',
			'httpMethod'	=> 'POST',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				),
				'currency'     		=> array(
					'location' 		=> 'json',
					'description'	=> 'USD only right now',
					'type'     		=> 'string',
					'required'		=> true
				),
				'amount'       		=> array(
					'location' 		=> 'json',
					'description'	=> 'amount to withdraw',
					'type'     		=> 'string',
					'required'		=> true
				),
				'destination'  		=> array(
					'location' 		=> 'json',
					'description'	=> 'Address of crytpocurrency',
					'type'     		=> 'string',
					'required'		=> true
				)
			)
		),
		'cancelTransaction' => array(
			'uri'			=> 'transactions/{id}',
			'description'	=> 'cancel transaction by id',
			'httpMethod'	=> 'DELETE',
			'parameters'	=> array(
				'X-Buttercoin-Access-Key' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Signature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Buttercoin-Date' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'type'			=> 'string',
					'required'		=> true
				),
				'X-Forwarded-For' 	=> array (
					'location'		=> 'header',
					'description'	=> 'localhost ip',
					'sentAs'		=> 'X-Forwarded-For',
					'type'			=> 'string',
					'required'		=> false
				),
				'id'       			=> array(
					'location' 		=> 'uri',
					'type'     		=> 'string',
					'description' 	=> 'UUIDv4 id of the transaction to cancel',
					'required' 		=> true
				)
			)
		)
	)
);
