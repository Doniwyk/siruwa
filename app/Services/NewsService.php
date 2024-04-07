<?php

namespace App\Services;

use App\Contracts\PendudukContract;
use App\Contracts\NewsContract;
use App\Models\NewsModel;

class NewsService implements NewsContract
{

    public function storeNews(array $validatedData): void
    {
        NewsModel::create($validatedData);
    }

    public function updateNews(array $validatedData, NewsModel $news): void
    {
        $news->update($validatedData);
    }

    public function deleteNews(NewsModel $news): void
    {
        $news->delete();
    }

}
