<?php

namespace App\Services;

use App\Contracts\EventContract;
use App\Models\EventModel;
use App\Models\NewsModel;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryEngine;
use PHPUnit\Event\Event;

class EventService implements EventContract
{

    private $cloudinary;
    public function __construct()
    {
        $this->cloudinary = new CloudinaryEngine();
    }
    public function storeEvent(array $validatedData): void
    {
        EventModel::create($validatedData);
    }

    public function updateEvent(array $validatedData, EventModel $event): void
    {
        if (!array_key_exists('gambar', $validatedData)) {
            $event->judul = $validatedData['judul'];
            $event->isi = $validatedData['isi'];
            $event->save();
            return;
        }

        // Hapus gambar terlabih dahulu
        $publicId = $event->image_public_id;
        $result = $this->cloudinary->destroy($publicId);

        // Upload Kembali
        $cloudinaryImage = $validatedData['gambar']->storeOnCloudinary('berita');
        $url = $cloudinaryImage->getSecurePath();
        $publicId = $cloudinaryImage->getPublicId();

        // Update data
        $validatedData['url_gambar'] = $url;
        $validatedData['image_public_id'] = $publicId;

        $event->update($validatedData);
    }

    public function deleteEvent(EventModel $event): void
    {
        // Delete gambar
        $publicId = $event->image_public_id;
        $result = $this->cloudinary->destroy($publicId);

        // Delete data
        $event->delete();
    }
}
