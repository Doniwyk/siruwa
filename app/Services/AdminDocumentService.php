<?php

    namespace App\Services;

    use App\Contracts\AdminDocumentContract;
    use App\Models\DocumentModel;
    use Exception;

    class AdminDocumentService implements AdminDocumentContract
    {
        public function validateDocument(array $validatedData, string $action, DocumentModel $document)
        {
            $keteranganStatus = $validatedData['keterangan_status'];
            $document->keterangan_status = $keteranganStatus;
            $document->status = match ($action) {
                'terima' => 'Proses',
                'tolak' => 'Ditolak',
                default => throw new Exception("Invalid action status")
            };
            $document->save();
        }
        public function getDocumentRequest()
        {
            return DocumentModel::whereNotIn('status', ['Selesai', 'Ditolak'])->with('penduduk')->get();
        }
        public function getValidateHistory()
        {
            return DocumentModel::whereIn('status', ['Selesai', 'Ditolak'])->with('penduduk')->get();
        }
        public function changeStatus(array $validatedData, DocumentModel $dokumen){
            $dokumen->status = $validatedData['status'];
            $dokumen->keterangan_status = $validatedData['keterangan_status'];
            $dokumen->save();
        }
    }

