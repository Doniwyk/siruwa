@extends('layouts.user')
@section('content-user')

<script>
    window.documentLabels = {
        'Surat Pengantar Pernikahan': {
            label: 'Surat Pengantar Pernikahan',
            desc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet earum facilis laudantium atque corrupti totam quidem, beatae iure fuga nulla? Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, in. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, officia!'
        },
        'Surat Pengantar KTP': {
            label: 'Surat Pengantar KTP',
            desc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet earum facilis laudantium atque corrupti totam quidem, beatae iure fuga nulla? Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, in. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, officia!'
        },
        'Surat Keterangan': {
            label: 'Surat Keterangan',
            desc: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet earum facilis laudantium atque corrupti totam quidem, beatae iure fuga nulla? Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, in. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, officia!'
        }
    };
</script>

<div class="resident-header">{{ $title }}</div>

<!-- TAB -->
<div x-data="{
    openTab: localStorage.getItem('openTab') ? parseInt(localStorage.getItem('openTab')) : 1,
    selectedDocument: '',
    documents: window.documentLabels
}" id="data-document">
    <div class="resident-tab-parent">
        <button x-on:click="openTab = 1; localStorage.setItem('openTab', 1)" :class="{ 'bg-secondary text-white': openTab === 1 }"
            class="resident-tab">Pengajuan</button>
        <button x-on:click="openTab = 2; localStorage.setItem('openTab', 2)" :class="{ 'bg-secondary text-white': openTab === 2 }"
            class="resident-tab">Riwayat</button>
    </div>

    <!-- TAB PENGAJUAN -->
    <div x-show="openTab === 1">
        <form action="{{ route('resident.data-dokumen.request') }}" method="post" class="bg-white rounded-2xl py-9 px-16">
            @csrf
            @method('POST')
            <section>
                <div class="text-secondary text-xl font-bold mb-5">Jenis Dokumen</div>
                <div class="grid gap-x-9 grid-cols-2">
                    <div class="col-span-1">
                        <div class="relative">
                            <select x-model="selectedDocument" name="jenis" id="jenis_dokumen" class="form-control-input appearance-none cursor-pointer w-full">
                                <option value="">Pilih Jenis Dokumen</option>
                                <option value="Surat Pengantar Pernikahan">Surat Pengantar Pernikahan</option>
                                <option value="Surat Pengantar KTP">Surat Pengantar KTP</option>
                                <option value="Surat Keterangan">Surat Keterangan</option>
                            </select>
                            <img src="{{ asset('assets/icons/arrow-up.svg') }}" alt="arrow-up" class="right-icon pointer-events-none">
                        </div>
                    </div>
                </div>
            </section>

            <template x-if="selectedDocument">
                <section class="mb-5 mt-9">
                    <span class="text-secondary text-base font-bold" x-text="documents[selectedDocument].label"></span>
                    <span class="text-secondary text-base font-medium" x-text="documents[selectedDocument].desc"></span>
                </section>
            </template>

            <section id="form-reason" x-show="selectedDocument !== ''">
                <hr class="h-1 mx-auto bg-secondary border-0 rounded mb-9">
                <div class="text-secondary text-base font-medium mb-5">Silahkan isi formulir dibawah ini!</div>

                <div class="grid gap-x-9 gap-y-5 grid-cols-2">
                    <x-form.show-input-form :label="'Nama Lengkap'"  :name="'anu'" :value="$resident->nama" />
                    <div class="form-group">
                        <label class="text-label_light">Tanggal Pengajuan</label>
                        <input type="date" name="tglPengajuan" id="tglPengajuan" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                    </div>
            
                    <div class="form-group col-span-2">
                        <label for="nomor_hp" class="block text-base font-medium leading-6 text-secondary">Alasan Pengajuan</label>
                        <textarea name="keperluan" id="keperluan" cols="30" rows="10" class="resident-input" placeholder="Alasan Pengajuan"></textarea>
                    </div>
                </div>
            </section>

            <section class="flex justify-end mt-9" x-show="selectedDocument !== ''">
                <button type="submit" class="btn-main">Simpan Data</button>
            </section>
        </form>
    </div>

    <!-- TAB RIWAYAT -->
    <div x-show="openTab === 2">
        <div class="overflow-x-auto rounded-xl">
            <table class="w-full text-left table-fixed">
                <thead class="history-header">
                    <tr>
                        <th>Nama Pengaju</th>
                        <th>Tipe Berkas</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Detail Status</th>
                    </tr>
                </thead>
                <tbody class="history-body">
                    @foreach($documentData['document'] as $record)
                        <tr>
                            <td>{{ $detailAccount->nama }}</td>
                            <td>{{ $record->jenis }}</td>
                            <td>{{ $record->created_at }}</td>
                            <td class="flex items-center">
                                <div class="w-1/2">
                                    {{ $record->status }}
                                </div>
                                <button class="w-1/2">
                                    <x-icon.detail />
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
