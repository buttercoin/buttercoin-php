<?php

require 'vendor/autoload.php';
use Buttercoin\Client\ButtercoinClient;
date_default_timezone_set('UTC'); 

$client = ButtercoinClient::factory([
	'publicKey' => '5ti8xeuujqfcla4se1d7whydryoso5z8',
	'secretKey' => 'JCfcLBAEinmKtdHgIlwXi3SEMJoCf4Bg',
	'environment' => 'staging'
]);

//$timestamp = round(microtime(true) * 1000);
//print_r ( $client->getTicker() );
//print_r ( $client->getOrderBook() );

//print_r( $client->getKey($timestamp) );
//$timestamp = round(microtime(true) * 1000);
//print_r( $client->getBalances($timestamp) );
//print_r( $client->getDepositAddress($timestamp));

//$query = [ ];

//print_r( $client->getOrders($query, $timestamp));

//$orderId = '5ff2c696-1a28-45b5-b9a4-da81525ac389';
//print_r( $client->getOrderById($orderId, $timestamp));
//print_r( $client->cancelOrder($orderId, $timestamp));

// ORDER MATTERS HERE because of the way guzzle builds the post param request
//$order = [
	//"instrument" => "USD_BTC",
	//"side" => "sell",
	//"orderType" => "market",
	//"quantity" => "500"
	//];

//$url = $client->createOrder($order, $timestamp);

//$timestamp = round(microtime(true) * 1000);
//print_r( $client->getOrderByUrl($url, $timestamp));


//$query = [];
//print_r( $client->getTransactions($query, $timestamp));

$txnId = '53c5a96364f23e4706c76b46';
print_r( $client->getTransactionById($txnId));
//print_r( $client->cancelTransaction($txnId, $timestamp));

//$timestamp = round(microtime(true) * 1000);
//$txn = [
	//"method" => "wire",
	//"currency" => "USD",
	//"amount" => "500"
//];
//$url = $client->createDeposit($txn, $timestamp);

//$timestamp = round(microtime(true) * 1000);
//print_r( $client->getTransactionByUrl($url, $timestamp));


//$txn = [
	//"method" => "check",
	//"currency" => "USD",
	//"amount" => "5"
//];
//print_r( $client->createWithdrawal($txn, $timestamp));


