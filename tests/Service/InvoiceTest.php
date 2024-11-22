<?php

namespace App\Tests\Service;

use App\Service\EmailService;
use App\Service\Invoice;
use PHPUnit\Framework\TestCase;

class InvoiceTest extends TestCase
{
    public function testProcessSendsEmail(): void
    {
          /** @var \PHPUnit\Framework\MockObject\MockObject|EmailService $emailServiceMock */
        $emailServiceMock = $this->createMock(EmailService::class);

    
        $emailServiceMock
            ->expects($this->once())
            ->method('send')
            ->willReturn(true);

        $invoice = new Invoice($emailServiceMock);


        $this->assertTrue($invoice->process('test@example.com', 50.00));
    }
}
