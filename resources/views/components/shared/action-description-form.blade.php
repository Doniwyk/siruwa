<form id="{{ $formId }}" class=" absolute p-10 rounded-2xl flex-col bg-white hidden"
    action="{{ route('admin.data-dokumen.changeStatus', ['document' => $document->id_dokumen]) }}" method="POST">
    @csrf
    @method('PUT')
    <button class="absolute w-[25px] h-[25px] -right-2 -top-2 rounded-full bg-red-600" onclick="closeForm('#{{ $formId }}')"></button>
    <h1 class="text-xl font-bold text-main">Catatan</h1>
    <textarea name="keterangan_status" id="keterangan_status"
        class="h-[10rem] w-[22rem] mt-4 border-2 p-2 border-outline outline-none rounded-2xl" required></textarea>
    <button type="submit" @class([
        'mt-5',
        'bg-red-600' => $statusValue == 'batalkan',
        'bg-main' => $statusValue == 'lanjut',
        'text-white',
        'px-4',
        'py-2',
        'rounded-md',
        'flex-1',
    ]) type="submit" name="status"
        value="{{ $statusValue }}">{{ $statusValue == 'batalkan' ? 'Batalkan' : 'Konfirmasi' }}</button>
</form>
