<?php

namespace App\Service;

class Invoice
{

    public function __construct(private EmailService $emailService){}

    public function process(string $email, float $amount): bool
    {
        $message = sprintf('Votre commande d’un montant de %.2f€ est confirmée', $amount);

        return $this->emailService->send($email, $message);
    }
}