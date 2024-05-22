<form id="{{ $formId }}" class="absolute p-10 rounded-2xl flex-col bg-white center"
    action="{{ route('admin.data-dokumen.changeStatus', ['document' => $fundData->id_admin]) }}" method="POST">
    @csrf
    @method('PUT')
    <button class="absolute w-[25px] h-[25px] -right-2 -top-2 rounded-full bg-red-600" onclick="closeForm('#{{ $formId }}')"></button>
    <h1 class="text-xl font-bold text-main text-center">Konfirmasi Pembayaran</h1>
    <img src="" alt="Bukti Pembayaran" class="h-[11.75rem]">
    <input type="text" name="jumlah" id="#jumlah" class="w-[20rem] mt-4 border-2 p-2 border-outline outline-none rounded-2xl" required>
    <div class="wrapper flex gap-5">
        <button type="submit" @class([
            'mt-5',
            'bg-red-600',
            'text-white',
            'px-4',
            'py-2',
            'rounded-md',
            'flex-1',
        ]) type="submit" name="status"
            value="{{ $statusValue }}"> Tolak</button>
        <button type="submit" @class([
            'mt-5',
            'bg-main',
            'text-white',
            'px-4',
            'py-2',
            'rounded-md',
            'flex-1',
        ]) type="submit" name="status"
            value="{{ $statusValue }}"> Konfirmasi</button>
    </div>
</form>
