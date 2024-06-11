<div class="flex-center relative flex-col">
    <h3 class="text-xl font-semibold text-main top-0">Rasio Pendidikan Terakhir Penduduk</h3>
    <div role="status" id="pendidikan_terakhir_skeleton"
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
    <canvas id="pendidikan_terakhir" class="max-w-full"></canvas>
</div>
<script>
    const JOB_INITIAL_DATA = {
        diploma: {
            label: 'Diploma',
            jumlah: '',
            warna: 'rgba(34, 81, 87, 1)',
        },
        sarjana: {
            label: 'Sarjana',
            jumlah: '',
            warna: '(84, 146, 155, 1)',
        },
        sd: {
            label: 'SD/MI/Sederajat',
            jumlah: '',
            warna: 'rgba(159, 218, 226, 1)',
        },
        sma: {
            label: 'SMA/MA/Sederajat',
            jumlah: '',
            warna: 'rgba(159, 186, 226, 1)',
        },
        smp: {
            label: 'SMP/MTs/Sederajat',
            jumlah: '',
            warna: 'rgba(84, 108, 155, 1)',
        },
        tts: {
            label: 'Tidak Tamat SD',
            jumlah: '',
            warna: 'rgba(24, 64, 124, 1)',
        },
    }

    async function getLastStudiedData() {
        const url = '{{ route('admin.statistic.getLastStudiedData') }}';
        const response = await fetch(url);
        const {
            data
        } = await response.json();

        const updatedData = {
            ...JOB_INITIAL_DATA
        };

        for (const lastStudied in data) {
            updatedData[lastStudied].jumlah = data[lastStudied];
        }

        return updatedData;
    }

    async function createLastStudiedChart() {
        let data = await getLastStudiedData()
        const ctx3 = document.getElementById('pendidikan_terakhir').getContext('2d');

        const lastStudiedChartData = {
            labels: Object.values(data).map(lastStudied => lastStudied.label),
            datasets: [{
                label: 'My First Dataset',
                data: Object.values(data).map(lastStudied => lastStudied.jumlah),
                backgroundColor: Object.values(data).map(lastStudied => lastStudied.warna),
                hoverOffset: 4
            }]
        };

        const config3 = {
            type: 'pie',
            data: lastStudiedChartData,
            options: {
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        };
        const myChart3 = new Chart(ctx3, config3);
        return new Promise((resolve, reject) => {
            if (myChart3) {
                resolve(true)
            }
        });

    }

    createLastStudiedChart()
        .then(() => {
            const skeleton = document.querySelector('#pendidikan_terakhir_skeleton')
            const chart = document.querySelector('#pendidikan_terakhir');

            skeleton.classList.add('hidden')
            chart.classList.remove('hidden')
        });;
</script>
