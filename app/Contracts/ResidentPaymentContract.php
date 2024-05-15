<?php

namespace App\Contracts;

interface ResidentPaymentContract
{
    public function storePayment(array $validatedData);

    public function getFundData();

    public function getHistory();

    public function getFundDataByYear($year);
}
