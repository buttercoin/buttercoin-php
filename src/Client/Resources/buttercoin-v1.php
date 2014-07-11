<?php

return array(
    'name'			=> 'Buttercoin',
    'apiVersion'	=> 'v1',
	'operations'	=> array(
		'getKey'	=> array(
			'uri'			=> 'key',
			'description'	=> 'get the permissions associated with this API Key',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'xButtercoinAccessKey' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'xButtercoinSignature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'xButtercoinDate' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'pattern'		=> '/^([[:num:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				)
			)
		),
		'getBalances' => array(
			'uri'			=> 'balances',
			'description'	=> 'get the balances associated with this account',
			'httpMethod'	=> 'GET',
			'parameters'	=> array(
				'xButtercoinAccessKey' => array (
					'location'		=> 'header',
					'description'	=> 'Your Public API Key',
					'sentAs'		=> 'X-Buttercoin-Access-Key',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'xButtercoinSignature' => array (
					'location'		=> 'header',
					'description'	=> 'HMAC-SHA256 signature',
					'sentAs'		=> 'X-Buttercoin-Signature',
					'pattern'		=> '/^([[:alnum:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				),
				'xButtercoinDate' => array (
					'location'		=> 'header',
					'description'	=> 'Unix Timestamp must be within 5 minutes of Buttercoin UTC server time',
					'sentAs'		=> 'X-Buttercoin-Date',
					'pattern'		=> '/^([[:num:]])+$/',
					'type'			=> 'string',
					'required'		=> true
				)
			)
			
		)
	)
);
