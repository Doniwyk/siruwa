<?php

namespace App\Contracts;

use App\Models\PaymentModel;

interface AdminPaymentContract
{
    public function validatePayment(array $validatedData, string $action, PaymentModel $payment);

    public function getFundData();

    public function getValidatedPayment($search, $order);

    public function getSubmission($search, $order);
}
