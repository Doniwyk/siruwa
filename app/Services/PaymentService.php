<?php

namespace App\Services;

use App\Contracts\NewsContract;
use App\Contracts\PaymentContract;
use App\Models\NewsModel;
use App\Models\PaymentModel;

class PaymentService implements PaymentContract
{

    public function storePayment(array $validatedData): void
    {
        NewsModel::create($validatedData);
    }

    public function updatePayment(array $validatedData, PaymentModel $news): void
    {
        $news->update($validatedData);
    }

    public function deletePayment(PaymentModel $payment): void
    {
        $payment->delete();
    }
}
