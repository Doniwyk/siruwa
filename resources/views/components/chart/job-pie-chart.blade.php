<div class="w-full h-full flex-center relative flex-col">
    <h3 class="text-xl font-semibold text-main absolute top-0">Rasio Pekerjaan Penduduk</h3>
    <canvas id="rasio_pekerjaan" class="h-full w-full object-contain absolute"></canvas>
</div>
@section('jobChartScript')
    <script>
        const LAST_STUDIED_INITIAL_DATA = {
            pm: {
                label: 'Pelajar/Mahasiswa',
                jumlah: '',
                warna: 'rgba(34, 81, 87, 1)',
            },
            pns: {
                label: 'PNS',
                jumlah: '',
                warna: '(84, 146, 155, 1)',
            },
            tb: {
                label: 'Tidak Bekerja',
                jumlah: '',
                warna: 'rgba(159, 218, 226, 1)',
            },
            tni_polri: {
                label: 'TNI/Polri',
                jumlah: '',
                warna: 'rgba(159, 186, 226, 1)',
            },
            wiraswasta: {
                label: 'Wiraswasta',
                jumlah: '',
                warna: 'rgba(84, 108, 155, 1)',
            },
            wirausaha: {
                label: 'Wirausaha',
                jumlah: '',
                warna: 'rgba(24, 64, 124, 1)',
            },
        }
        async function getJobData() {
            const url = '{{ route('admin.statistic.getJobData') }}';
            const response = await fetch(url);
            const {
                data
            } = await response.json();

            const updatedData = {
                ...LAST_STUDIED_INITIAL_DATA
            };
            for (const jobType in data) {
                updatedData[jobType].jumlah = data[jobType];
            }

            createJobChart(updatedData);
        }

        function createJobChart(data) {
            const ctx2 = document.getElementById('rasio_pekerjaan').getContext('2d');

            const jobChartData = {
                labels: Object.values(data).map(job => job.label),
                datasets: [{
                    label: 'Rasio Pekerjaan Penduduk',
                    data: Object.values(data).map(job => job.jumlah),
                    backgroundColor: Object.values(data).map(job => job.warna),
                    hoverOffset: 4
                }]
            };

            const config2 = {
                type: 'pie',
                data: jobChartData,
                options: {
                    plugins: {
                        legend: {
                            position:'right',
                        }
                    }

                }
            };

            const myChart2 = new Chart(ctx2, config2);
        }

        getJobData();
    </script>
@endsection
