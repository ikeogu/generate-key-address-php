<?php

use BitWasp\Bitcoin\Script\ScriptFactory;
use BitWasp\Bitcoin\Transaction\TransactionFactory;
use BitWasp\Bitcoin\Transaction\TransactionInput;

// Create a transaction input (spending from a previous transaction)
$prevTransactionId = '...';  // Previous transaction ID
$prevOutpointIndex = 0;      // Previous transaction output index
$prevScript = ScriptFactory::create()->op('OP_DUP')->op('OP_HASH160')->push($privateKey->getPubKeyHash())->op('OP_EQUALVERIFY')->op('OP_CHECKSIG');
$prevOutpoint = new TransactionInput($prevTransactionId, $prevOutpointIndex, $prevScript);

// Create a transaction output (paying to a Bitcoin address)
$paymentAddress = '...';  // Recipient's Bitcoin address
$paymentAmount = 50000;   // Amount in satoshis (1 BTC = 100,000,000 satoshis)
$outputScript = ScriptFactory::scriptPubKey()->payToAddress($paymentAddress);
$transactionOutput = TransactionFactory::txOut($paymentAmount, $outputScript);

// Create the transaction
$transaction = TransactionFactory::build()
    ->spendOutPoint($prevOutpoint)
    ->payToAddress($paymentAmount, $paymentAddress)
    ->get();

echo "Transaction ID: " . $transaction->getTransactionId() . PHP_EOL;
