@extends('layouts.admin')
@section('content')
    @if (session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif
    <h1 class="h1-semibold">Upload CSV</h1>

    <form action="{{ route('admin.data-penduduk.saveImport') }}" method="POST" enctype="multipart/form-data"
        class="flex sm:gap-3 md:gap-8">
        @csrf
        <input
            class="block sm:w-full md:w-[30rem] text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="file_input-csv" type="file" accept=".csv" name="dataPreviewed" required>
        <button type="submit" class="button-main"">Import</button>
    </form>
    <section id="preview-csv-data" class="hidden">
        <h1 class="text-xl font-semibold text-main p-3">Hasil Preview</h1>
        <div class="w-full bg-white overflow-scroll rounded-2xl">
            <table class="table-parent">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tgl Lahir</th>
                        <th>NIK</th>
                        <th>Nomor KK</th>
                        <th>Tempat Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>RT</th>
                        <th>Status Kawin</th>
                        <th>Status Keluarga</th>
                        <th>Agama</th>
                        <th>Alamat</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                        <th>Akseptor KB</th>
                        <th>Jenis Akseptor</th>
                        <th>Aktif Posyandu</th>
                        <th>Mempunyai BKB</th>
                        <th>Mempunyai Tabungan</th>
                        <th>Ikut Kelompok Belajar</th>
                        <th>Jenis Kelompok Belajar</th>
                        <th>Ikut PAUD</th>
                        <th>Ikut Koperasi</th>
                        <th>Gaji</th>
                        <th>Pajak Bumi</th>
                        <th>Biaya Listrik</th>
                        <th>Biaya Air</th>
                        <th>Total Pajak Kendaraan</th>
                        <th>Jumlah Tanggungan</th>
                        <th>No. Hp</th>
                        <th>Email></th </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </section>
@endsection
@section('script')
    <script>
        const INITIAL_DATA_CSV = {
            nama: '',
            tgl_lahir: '',
            nik: '',
            nomor_kk: '',
            tempat_lahir: '',
            jenis_kelamin: '',
            rt: '',
            status_kawin: '',
            status_keluarga: '',
            agama: '',
            alamat: '',
            pendidikan: '',
            pekerjaan: '',
            akseptor_kb: '',
            jenis_akseptor: '',
            aktif_posyandu: '',
            has_BKB: '',
            has_tabungan: '',
            ikut_kel_belajar: '',
            jenis_kel_belajar: '',
            ikut_paud: '',
            ikut_koperasi: '',
            gaji: '',
            pajak_bumi: '',
            biaya_listrik: '',
            biaya_air: '',
            total_pajak_kendaraan: '',
            jumlah_tanggungan: '',
            noHp: '',
            email: ''
        }
        $(document).ready(function() {
            $('#file_input-csv').on('change', function(event) {
                const fileInput = document.getElementById('file_input-csv');
                const csrfToken = document.querySelector('input[name="_token"]').value;
                const previewData = document.querySelector('#preview-csv-data');
                const tableBody = previewData.querySelector('tbody')
                const updatedData = {
                    ...INITIAL_DATA_CSV
                };
                const file = fileInput.files[0];
                const resultData = [];
                
                if (file) {
                    const formData = new FormData();
                    formData.append('csv', file);
                    // formData.csv = file;

                    $.ajax({
                        url: "{{ route('admin.data-penduduk.preview') }}",
                        type: "POST", // Change to POST for file uploads
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response);
                            if (!response.length) {
                                $('#table-parent tbody').append(
                                    `<tr>
                                        <td colspan="5" class="text-center">No data found</td>
                                    </tr>`
                                );
                                return;
                            }

                            response.forEach(res => {
                                for (const key in updatedData) {
                                    updatedData[key] = res[key]
                                }
                                resultData.push(updatedData)
                            });

                            resultData.forEach(data => {
                                $('tbody').append(
                                    `<tr>
                                    <td>${data['nama']}</td>
                                    <td>${data['tgl_lahir']}</td>
                                    <td>${data['nik']}</td>
                                    <td>${data['nomor_kk']}</td>
                                    <td>${data['tempat_lahir']}</td>
                                    <td>${data['jenis_kelamin']}</td>
                                    <td>${data['rt']}</td>
                                    <td>${data['status_kawin']}</td>
                                    <td>${data['status_keluarga']}</td>
                                    <td>${data['agama']}</td>
                                    <td>${data['alamat']}</td>
                                    <td>${data['pendidikan']}</td>
                                    <td>${data['pekerjaan']}</td>
                                    <td>${data['akseptor_kb']}</td>
                                    <td>${data['jenis_akseptor']}</td>
                                    <td>${data['aktif_posyandu']}</td>
                                    <td>${data['has_BKB']}</td>
                                    <td>${data['has_tabungan']}</td>
                                    <td>${data['ikut_kel_belajar']}</td>
                                    <td>${data['jenis_kel_belajar']}</td>
                                    <td>${data['ikut_paud']}</td>
                                    <td>${data['ikut_koperasi']}</td>
                                    <td>${data['gaji']}</td>
                                    <td>${data['pajak_bumi']}</td>
                                    <td>${data['biaya_listrik']}</td>
                                    <td>${data['biaya_air']}</td>
                                    <td>${data['total_pajak_kendaraan']}</td>
                                    <td>${data['jumlah_tanggungan']}</td>
                                    <td>${data['noHp']}</td>
                                    <td>${data['email']}></td 
                                </tr>`
                                )
                            })
                            previewData.classList.remove('hidden')


                        },
                        error: function(xhr, status, error) {
                            console.error('Error uploading file:', error);
                        }
                    });
                } else {
                    console.error('No file selected');
                }
            });
        });
    </script>
@endsection
