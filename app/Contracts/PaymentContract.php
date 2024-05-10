<?php

namespace App\Contracts;

use App\Models\PaymentModel;

interface PaymentContract
{
    public function storePayment(array $validatedData): void;

    public function updatePayment(array $validatedData, PaymentModel $payment);

    public function deletePayment(PaymentModel $payment);
}
