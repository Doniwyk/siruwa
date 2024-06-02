<div id="{{ 'payment-card-' . $formId }}" class="absolute p-10 rounded-2xl  bg-white center">
    <button class="absolute -right-2 -top-2 rounded-full bg-white"
        onclick="closeForm('#{{ 'payment-card-' . $formId }}', '#{{ 'modal-parent-' . $formId }}')" class="text-white">
        <x-icon.cancel />
    </button>
    <form class="flex-col gap-9"
        action="{{ route('admin.data-pembayaran.validatePembayaran', ['id_admin' => $fundData->id_admin, 'payment' => $fundData->id_pembayaran]) }}"
        method="POST">
        @csrf
        @method('PUT')
        <h1 class="text-xl font-bold text-main text-center">Konfirmasi Pembayaran</h1>
        <img src="{{$fundData->urlBuktiPembayaran}}" alt="Bukti Pembayaran" class="h-[11.75rem] bg-main">
        <fieldset>
            <div class="flex gap-4 justify-between items-center">
                <label for="metode_display bg-main">Metode Pembayaran</label>
                <input type="text" name="metode" id="metode" value="{{ $fundData->metode }}" class="hidden">
                <input type="text" name="metode_display" id="metode_display"
                    class="w-[17.25rem] py-2 px-4 outline-none rounded-2xl border-2 border-outline"
                    value="{{ $fundData->metode }}" disabled>
            </div>
            <div class="flex gap-4 justify-between mt-4 items-center">
                <label for="jumlah_display ">Konfirmasi Nominal</label>
                <input type="text" name="jumlah" id="jumlah" value="{{ $fundData->jumlah }}" class="hidden">
                <input type="text" name="jumlah_display" id="jumlah_display"
                    class="w-[17.25rem] py-2 px-4 outline-none rounded-2xl border-2 border-outline"
                    value="{{ $fundData->jumlah }}" disabled>
            </div>
        </fieldset>
        <div class="wrapper flex gap-5">
            <button class="mt-5 bg-red-600 text-white px-4 py-2 rounded-3xl flex-1" type="submit" name="action"
                value="tolak"> Tolak</button>
            <button type="submit" class="mt-5 bg-main text-white px-4 py-2 rounded-3xl flex-1" name="action"
                value="terima"> Konfirmasi</button>
        </div>
    </form>
</div>
