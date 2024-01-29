<?php

require_once './vendor/autoload.php';

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Key\Factory\HierarchicalKeyFactory as FactoryHierarchicalKeyFactory;
use BitWasp\Bitcoin\Network\NetworkFactory;

// Set the Bitcoin network (mainnet or testnet)
$network = NetworkFactory::bitcoin();

// Generate a random master key
$master = (new FactoryHierarchicalKeyFactory)->generateMasterKey();

// Derive a child key for a specific purpose (e.g., receiving payments)
$childKey = $master->deriveChild(0);

// Get the address and private key
$address = $childKey->getAddress($network);
$privateKey = $childKey->getPrivateKey();

echo "Bitcoin Address: " . $address->getAddress() . PHP_EOL;
echo "Private Key (WIF): " . $privateKey->toWif() . PHP_EOL;
