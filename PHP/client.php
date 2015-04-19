<?php

namespace TTG;
error_reporting(E_ALL);

require_once __DIR__ . '/Thrift/ClassLoader/ThriftClassLoader.php';
require_once __DIR__ . '/Gen/TTGService.php';
require_once __DIR__ . '/Gen/Types.php';

use Thrift\ClassLoader\ThriftClassLoader;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\TBufferedTransport;

// Load
$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift', __DIR__ . '/');
$loader->registerDefinition('TTG', __DIR__ . '/Gen');
$loader->register();

// Init
$socket = new TSocket('127.0.0.1', 9090);
$transport = new TBufferedTransport($socket, 1024, 1024);
$protocol = new TBinaryProtocol($transport);
$client = new TTGServiceClient($protocol);

// Config
$socket->setSendTimeout(30 * 1000);
$socket->setRecvTimeout(30 * 1000);

// Connect
$transport->open();

// Create request
$request = new Request();
$request->studentID = 100;

// Call...
$response = $client->getStudentInfo($request);

// Print response...
var_dump($response);

// Close
$transport->close();
