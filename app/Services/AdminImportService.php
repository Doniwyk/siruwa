<?php

namespace App\Services;

use App\Models\UserModel; // Import the UserModel class
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdminImportService
{
    public function importResident($file)
    {
        Log::info('Started importResident method.');

        $fileContents = file($file->getPathname());
        $errors = [];

        // Parse the CSV file
        $csv = array_map('str_getcsv', $fileContents);
        $headers = array_shift($csv); // Remove the first row (headers)
        $dataPreview = [];

        Log::info('CSV file parsed successfully.');

        foreach ($csv as $row) {
            // Combine headers with each row to create an associative array
            $data = array_combine($headers, $row);
            $dataPreview[] = $data;
        }

        // Save data preview to session
        Session::put('dataPreview', $dataPreview);
        Log::info('Data preview stored in session successfully.');
        return $dataPreview;
    }

    public function saveImportedResidents()
    {
        Log::info('Started saveImportedResidents method.');

        $dataPreview = Session::get('dataPreview', []);

        if (empty($dataPreview)) {
            Log::warning('No data to import.');
            return;
        }

        foreach ($dataPreview as $data) {
            // Save each row to the database
            UserModel::create($data);
        }

        // Clear session after saving
        Session::forget('dataPreview');
        Log::info('Data saved successfully, session cleared.');
    }
}
