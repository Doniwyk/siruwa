<div class="flex-center relative flex-col w-full">
    <h3 class="text-xl font-semibold text-main top-0">Rasio Pekerjaan Penduduk</h3>
    <div role="status" id="rasio_pekerjaan_skeleton"
        class="w-full p-4 border border-gray-200 rounded shadow animate-pulse md:p-6 dark:border-gray-700">
        <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-32 mb-2.5"></div>
        <div class="w-48 h-2 mb-10 bg-gray-200 rounded-full dark:bg-gray-700"></div>
        <div class="flex items-baseline mt-4">
            <div class="w-full bg-gray-200 rounded-t-lg h-72 dark:bg-gray-700"></div>
            <div class="w-full h-56 ms-6 bg-gray-200 rounded-t-lg dark:bg-gray-700"></div>
            <div class="w-full bg-gray-200 rounded-t-lg h-72 ms-6 dark:bg-gray-700"></div>
            <div class="w-full h-64 ms-6 bg-gray-200 rounded-t-lg dark:bg-gray-700"></div>
            <div class="w-full bg-gray-200 rounded-t-lg h-80 ms-6 dark:bg-gray-700"></div>
            <div class="w-full bg-gray-200 rounded-t-lg h-72 ms-6 dark:bg-gray-700"></div>
            <div class="w-full bg-gray-200 rounded-t-lg h-80 ms-6 dark:bg-gray-700"></div>
        </div>
    </div>
    <canvas id="rasio_pekerjaan" class="max-w-full hidden"></canvas>
</div>
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

        return updatedData;
    }

    async function createJobChart() {
        let data = await getJobData()
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
                        position: 'right',
                    }
                }

            }
        };

        const myChart2 = new Chart(ctx2, config2);
        return new Promise((resolve, reject) => {
            if (myChart2) {
                resolve(true)
            }
        });
    }

    createJobChart()
        .then(() => {
            const skeleton = document.querySelector('#rasio_pekerjaan_skeleton')
            const chart = document.querySelector('#rasio_pekerjaan');
            
            skeleton.classList.add('hidden')
            chart.classList.remove('hidden')
        });
</script>
