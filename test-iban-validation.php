<?php

require __DIR__ . '/vendor/autoload.php';

use Swejzi\QRPlatba\QRPlatba;

echo "Test validace IBAN pomocí jschaedl/iban-validation\n";
echo "=================================================\n\n";

// Test 1: Platný formát účtu
try {
    $qrPlatba = new QRPlatba();
    $qrPlatba->setAccount('12-3456789012/0100');
    echo "✅ Test 1: Platný formát účtu - OK\n";
    echo "   Převedeno na IBAN: " . $qrPlatba->__toString() . "\n\n";
} catch (Exception $e) {
    echo "❌ Test 1: Platný formát účtu - CHYBA\n";
    echo "   " . $e->getMessage() . "\n\n";
}

// Test 2: Platný IBAN
try {
    $qrPlatba = new QRPlatba();
    $qrPlatba->setAccount('CZ6508000000192000145399');
    echo "✅ Test 2: Platný IBAN - OK\n";
    echo "   IBAN: " . $qrPlatba->__toString() . "\n\n";
} catch (Exception $e) {
    echo "❌ Test 2: Platný IBAN - CHYBA\n";
    echo "   " . $e->getMessage() . "\n\n";
}

// Test 3: Neplatný IBAN
try {
    $qrPlatba = new QRPlatba();
    $qrPlatba->setAccount('CZ6508000000192000145398'); // Změněná poslední číslice
    echo "❌ Test 3: Neplatný IBAN - CHYBA (měla by být vyhozena výjimka)\n\n";
} catch (Exception $e) {
    echo "✅ Test 3: Neplatný IBAN - OK (výjimka byla vyhozena)\n";
    echo "   " . $e->getMessage() . "\n\n";
}

// Test 4: Neplatný formát účtu
try {
    $qrPlatba = new QRPlatba();
    $qrPlatba->setAccount('123456789/ABCD'); // Neplatný formát
    echo "❌ Test 4: Neplatný formát účtu - CHYBA (měla by být vyhozena výjimka)\n\n";
} catch (Exception $e) {
    echo "✅ Test 4: Neplatný formát účtu - OK (výjimka byla vyhozena)\n";
    echo "   " . $e->getMessage() . "\n\n";
}

echo "Test dokončen!\n";
