<?php

namespace App\Services;

use App\Contracts\PendudukContract;
use App\Contracts\NewsContract;
use App\Models\NewsModel;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;

class NewsService implements NewsContract
{
    private $cloudinary;
    public function __construct(){
        $this->cloudinary = new CloudinaryEngine;
    }

    public function storeNews(array $validatedData): void
    {
        NewsModel::create($validatedData);
    }

    public function updateNews(array $validatedData, NewsModel $news): void
    {
        if (!array_key_exists('gambar', $validatedData)) {
            $news->judul = $validatedData['judul'];
            $news->isi = $validatedData['isi'];
            $news->save();
            return;
        }

        // Hapus gambar terlabih dahulu
        $publicId = $news->image_public_id;
        $result = $this->cloudinary->destroy($publicId);


        // Upload Kembali
        $cloudinaryImage = $validatedData['gambar']->storeOnCloudinary('berita');
        $url = $cloudinaryImage->getSecurePath();
        $publicId = $cloudinaryImage->getPublicId();

        // Update data
        $validatedData['url_gambar'] = $url;
        $validatedData['image_public_id'] = $publicId;

        $news->update($validatedData);
    }

    public function deleteNews(NewsModel $news): void
    {
        // Delete gambar
        $publicId = $news->image_public_id;
        $result = $this->cloudinary->destroy($publicId);
        
        // Delete data
        $news->delete();
    }

}
