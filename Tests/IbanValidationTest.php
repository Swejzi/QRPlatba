<?php

/*
 * This file is part of the library "QRPlatba".
 *
 * (c) Swejzi
 *
 * For the full copyright and license information,
 * please view LICENSE.
 */

use PHPUnit\Framework\TestCase;
use Swejzi\QRPlatba\QRPlatba;

/**
 * Class IbanValidationTest.
 */
class IbanValidationTest extends TestCase
{
    public function testValidAccountNumber(): void
    {
        $qrPlatba = new QRPlatba();
        $qrPlatba->setAccount('12-3456789012/0100');
        
        $this->assertStringContainsString(
            'ACC:CZ0301000000123456789012',
            $qrPlatba->__toString()
        );
    }
    
    public function testValidIban(): void
    {
        $qrPlatba = new QRPlatba();
        $qrPlatba->setAccount('CZ6508000000192000145399');
        
        $this->assertStringContainsString(
            'ACC:CZ6508000000192000145399',
            $qrPlatba->__toString()
        );
    }
    
    public function testInvalidIban(): void
    {
        $this->expectException(InvalidArgumentException::class);
        
        $qrPlatba = new QRPlatba();
        $qrPlatba->setAccount('CZ6508000000192000145398'); // Změněná poslední číslice
    }
    
    public function testInvalidAccountFormat(): void
    {
        $this->expectException(InvalidArgumentException::class);
        
        $qrPlatba = new QRPlatba();
        $qrPlatba->setAccount('123456789/ABCD'); // Neplatný formát
    }
}
