<div id="{{ 'payment-card-'. $formId }}" class="absolute p-10 rounded-2xl  bg-white center">
    {{$formId}}
    <button class="absolute w-[25px] h-[25px] -right-2 -top-2 rounded-full bg-red-600" onclick="closeForm('#{{ 'payment-card-'. $formId }}', '#{{ 'modal-parent-'. $formId }}')"></button>
    <form class="flex-col"
    action="{{ route('admin.data-pembayaran.validatePembayaran', ['id_admin' => $fundData->id_admin, 'payment'=>$fundData->id_pembayaran]) }}" method="POST">
    @csrf
    @method('PUT')
    <h1 class="text-xl font-bold text-main text-center">Konfirmasi Pembayaran</h1>
    <img src="" alt="Bukti Pembayaran" class="h-[11.75rem]">
    <input type="text" name="jumlah" id="#jumlah" class="w-[20rem] mt-4 border-2 p-2 border-outline outline-none rounded-2xl" required>
    <div class="wrapper flex gap-5">
        <button @class([
            'mt-5',
            'bg-red-600',
            'text-white',
            'px-4',
            'py-2',
            'rounded-md',
            'flex-1',
        ]) type="submit" name="action"
            value="tolak"> Tolak</button>
        <button type="submit" @class([
            'mt-5',
            'bg-main',
            'text-white',
            'px-4',
            'py-2',
            'rounded-md',
            'flex-1',
        ]) name="action"
            value="terima"> Konfirmasi</button>
    </div>
</form>
</div>
