<?php

namespace App\Contracts;

use App\Models\BeritaModel;
use App\Models\NewsModel;
use App\Models\UserModel;

interface NewsContract
{
    public function storeNews(array $validatedData): void;

    public function updateNews(array $validatedData, NewsModel $news);

    public function deleteNews(NewsModel $news);
}
