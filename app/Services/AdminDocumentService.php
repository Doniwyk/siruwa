<?php

    namespace App\Services;

    use App\Contracts\AdminDocumentContract;
    use App\Models\AccountModel;
    use App\Models\DocumentModel;
    use Exception;
    use Illuminate\Support\Facades\Auth;

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
        public function getDocumentRequest() //Untuk di page index
        {
            return DocumentModel::whereIn('status', ['Menunggu Verifikasi'])->with('penduduk')->get();
        }
        public function getDocumentOngoing()
        {
            return DocumentModel::whereIn('status', ['Proses'])->with('penduduk')->get();
        }
        public function getDocumentCanBeTaken()
        {
            return DocumentModel::whereIn('status', ['Bisa Diambil'])->with('penduduk')->get();

//             $userId = Auth::id();
//             $accountData = AccountModel::findOrFail($userId);
//             $documentData = DocumentModel::where('status', 'Menunggu Verifikasi')->with('penduduk')->get();
//             return [
//                 'accountData' => $accountData,
//                 'documentData' => $documentData
//             ];

        }
        public function getValidateHistory() //Untuk di page riwayat
        {
            return DocumentModel::whereIn('status', ['Selesai', 'Ditolak', 'Dibatalkan'])->with('penduduk')->get();
        }

        public function getProcessedDocument() //Untuk di page proses
        {
            $userId = Auth::id();
            $accountData = AccountModel::findOrFail($userId);
            $documentData = DocumentModel::where('status', 'Proses')->with('penduduk')->get();
            return [
                'accountData' => $accountData,
                'documentData' => $documentData
            ];
        }
        public function changeStatus(array $validatedData, DocumentModel $dokumen, string $action){ //Untuk di page proses
            $keteranganStatus = $validatedData['keterangan_status'];
            $dokumen->keterangan_status = $keteranganStatus;
            $dokumen->status = match ($action) {
                'lanjut' => 'Bisa Diambil',
                'batalkan' => 'Dibatalkan',
                default => throw new Exception("Invalid action status")
            };
            $dokumen->save();
        }
        
        public function getCanBeTakenDocument() //Untuk di page bisa diambil
        {
            $userId = Auth::id();
            $accountData = AccountModel::findOrFail($userId);
            $documentData = DocumentModel::where('status', ['Bisa Diambil'])->with('penduduk')->get();
            return [
                'accountData' => $accountData,
                'documentData' => $documentData
            ];
        }
        public function changeIntoSelesai(DocumentModel $dokumen){ //Untuk di page bisa diambil
            $dokumen->status = 'Selesai';
            $dokumen->save();
        }
    }

