Buttercoin PHP Library
===================
Easy integration with the Buttercoin Trading Platform through our API.

Installation with Composer
--------------------------
```sh
$ php composer.phar require buttercoin/buttercoin-sdk:dev-master
```

Usage
-----
For composer documentation, please refer to [getcomposer.org](http://getcomposer.org/).

This client was built using [Guzzle](http://guzzlephp.org/), a PHP HTTP client & framework for building RESTful web service clients.

When you first create a new `ButtercoinClient` instance you can pass `publicKey`, `privateKey`, and `environment` as configuration settings. These are optional and can be later specified through Setter methods.

For authenticated API Resources, the `publicKey` and `secretKey` are required and can also be passed to the factory method in the configuration array.  The `environment` configuration setting defaults to `'production'`.

For a list of required and available parameters for the different API Endpoints, please consult the Buttercoin
[API Reference Docs](https://developer.buttercoin.com).

#### Configuring the Client

The factory method accepts an array of configuration settings for the Buttercoin Webservice Client.

Setting | Property Name | Description
--- | --- | ---
Public Key | `publicKey` | Your Buttercoin API Public Key  
Secret Key | `secretKey` | Your Buttercoin API Secret Key  
Environment | `environment` | Your development environment (default: `'production'`, set to `'staging'` to test with testnet bitcoins
API Version | `version` | The API Version.  Currently used to version the API URL and Service Description

###### Example
```php
require 'vendor/autoload.php';
use Buttercoin\Client\ButtercoinClient;
date_default_timezone_set('UTC'); // for $timestamp

$client = ButtercoinClient::factory([
	'publicKey' => '<public_key>',
	'secretKey' => '<secret_key>',
	'environment' => 'staging' // leave this blank for production
]);
```

#### Configuration can be updated to reuse the same Client:
You can reconfigure the Buttercoin Client configuration options through available getters and setters. You can get and set the following options: 
`publicKey`, `secretKey`, `environment`, & `version`

###### Example
```php
$client->getSecretKey();
$client->setSecretKey('<new_secret_key>');
```

**Tips**

A note on the `timestamp` param sent to all client methods: 
This param must always be increasing, and within 5 minutes of Buttercoin server times (GMT). This is to prevent replay attacks on your data. 

Before every call, get a new timestamp.  (You need only set the timezone once)

```php
date_default_timezone_set('UTC'); // Do this only once
$timestamp = round(microtime(true) * 1000);
```

### Get Data

*** Unauthenticated ***

**Get Order Book**  
Return an `array` of current orders in the Buttercoin order book

```php
$client->getOrderBook();
```

**Get Ticker**  
Return the current bid, ask, and last sell prices on the Buttercoin platform

```php
$client.getTicker();
```

*** Authenticated ***

**Key Permissions**  
Returns `array` of permissions associated with this key

```php
$client->getKey($timestamp);
```

**Balances**  
Returns `array` of balances for this account

```php
$client.getBalances($timestamp);
```

**Deposit Address**  
Returns bitcoin address `string` to deposit your funds into the Buttercoin platform

```php
$client.getDepositAddress($timestamp);
```

**Get Orders**  
Returns `array` of `arrays` containing information about buy and sell orders

Valid params include (must be added to array in this order):
Name | Param | Description
--- | --- | ---
Status | `status` | enum: `['opened', 'reopened', 'filled', 'canceled']`  
Side | `side` | enum: `['buy', 'sell']`  
Order Type | `orderType` | enum: `['market', 'limit']`  
Date Min | `dateMin` | format: ISO-8601, e.g. `'2014-05-06T13:15:30Z'`  
Date Max | `dateMax` | format: ISO-8601, e.g. `'2014-05-06T13:15:30Z'`

```php
// query for multiple orders
$orderParams = [ "status" => "canceled", "side" => "sell" ];

$client.getOrders($orderParams, $timestamp);

// single order by id
$orderId = '<order_id>';

$client.getOrder($orderId, $timestamp);
```

**Get Transaction**  
Returns `array` of `arrays` containing information about deposit and withdraw action

Valid params include (must be added to array in this order): 
Name | Param | Description
--- | --- | ---
Status | `status` | enum: `['pending', 'processing', 'funded', 'canceled', 'failed']`  
Transaction Type | `transactionType` | enum: `['deposit', 'withdrawal']`  
Date Min | `dateMin` | format: ISO-8601, e.g. `'2014-05-06T13:15:30Z'`  
Date Max | `dateMax` | format: ISO-8601, e.g. `'2014-05-06T13:15:30Z'`  

```php
// query for multiple transactions
$trxnParams = [ "status" => "funded", "transactionType" => "deposit" ];

$client.getTransactions($trxnParams, $timestamp);

var trxnId = '53a22ce164f23e7301a4fee5';

$client.getTransaction(trxnId, $timestamp);
```

### Create New Actions

**Create Order**  

Valid order params include:
Name | Param | Description
--- | --- | ---
Instrument | `instrument` | enum: `['BTC_USD, USD_BTC']`
Side | `side` | enum: `['buy', 'sell']`, required `true`  
Order Type | `orderType` | enum: `['limit', 'market']`, required `true`  
Price | `price` | `string`, required `false`  
Quantity | `quantity` | `string`, required `false`

```php
// create an array with the following params
$order = [
  "instrument" => "BTC_USD",
  "orderAction" => "buy",
  "orderType" => "limit",
  "price" => "700.00"
  "quantity" => "5"
];

$client.createOrder(order, $timestamp);
```

**Create Transaction**  

Deposit transaction params include: 
Name | Param | Description
--- | --- | ---
Method | `method` | enum: `['wire']`, required `true`  
Currency | `currency` | enum: `['USD']`, required `true`  
Amount | `amount` | `string`, required `true`

```php
// create deposit
$trxnObj = [
  "method" => "wire",
  "currency" => "USD",
  "amount" => "5002"
];

$client.createDeposit($trxnObj, $timestamp);
```

Withdrawal transaction params include: 
Name | Param | Description
--- | --- | --- 
Method | `method` | enum: `['check']`, required `true`  
Currency | `currency` | enum: `['USD']`, required `true`  
Amount | `amount` | `string`, required `true`  

```php
// create withdrawal
// create deposit
$trxnObj = [
  "method" => "check",
  "currency" => "USD",
  "amount" => "900.23"
];

$client.createWithdrawal($trxnObj, $timestamp);
```
Send bitcoin transaction params include:  
Name | Param | Description
--- | --- | --- 
Currency | `currency` | `['USD']`, required `true`  
Amount | `amount` | `string`, required `true`  
Destination | `destination` | address to which to send currency `string`, required `true`  

```php
// send bitcoins to an address
$trxnObj = [
  "currency" => "BTC",
  "amount" => "100.231231",
  "destination" => "<bitcoin_address>"
];

$client.sendCrypto($trxnObj, $timestamp);
```


### Cancel Actions

All successful cancel calls to the API return a response status of `204` with a human readable success message

**Cancel Order**  
Cancel a pending buy or sell order

```php
$client.cancelOrder($orderId, $timestamp);
```

**Cancel Transaction**  
Cancel a pending deposit or withdraw action

```php
$client.cancelTransaction($trxnId, $timestamp);
```

## Further Reading

[Buttercoin - Website](https://www.buttercoin.com)  
[Buttercoin API Docs](https://developer.buttercoin.com)

## Contributing

This is an open source project and we love involvement from the community! Hit us up with pull requests and issues. 

The aim is to take your great ideas and make everyone's experience using Buttercoin even more powerful. The more contributions the better!

## Release History

### 0.0.1

- First release.

## License

Licensed under the MIT license.
