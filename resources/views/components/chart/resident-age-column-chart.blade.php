<head>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <style>
        .chart-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        #column-chart {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="flex-center flex-col gap-4">
        <h3 class="text-xl text-main font-semibold">Sebaran Umur Penduduk RW 02</h3>
        <div class="chart-container">
            <div id="column-chart"></div>
        </div>
    </div>

    <script>
        async function getAgeDistribution() {
            const url = '{{ route('admin.statistic.getAgeDistribution') }}'; // pastikan URL benar
            try {
                const response = await fetch(url);
                const { data } = await response.json();

                const categories = Object.keys(data);
                const values = Object.values(data);

                const options = {
                    colors: ["#225157"],
                    series: [{
                        name: 'Umur Penduduk',
                        data: values
                    }],
                    chart: {
                        type: 'bar',
                        height: '390',
                        width: '100%',
                        fontFamily: '"Anek Tamil", sans-serif',
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '70%',
                            borderRadiusApplication: 'end',
                            borderRadius: 6,
                        },
                    },
                    states: {
                        hover: {
                            filter: {
                                type: 'darken',
                                value: 1,
                            },
                        },
                    },
                    grid: {
                        show: true,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: -14
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    legend: {
                        show: false,
                    },
                    xaxis: {
                        categories: categories,
                        floating: false,
                        labels: {
                            show: true,
                            style: {
                                fontFamily: 'Inter, sans-serif',
                                cssClass: 'text-xs font-normal fill-gray-500'
                            }
                        },
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                    },
                    yaxis: {
                        show: true,
                        style: {
                            fontFamily: 'Inter, sans-serif',
                            cssClass: 'text-base font-normal fill-gray-500'
                        }
                    },
                    fill: {
                        opacity: 1,
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: '100%',
                                height: '100%'
                            },
                            plotOptions: {
                                bar: {
                                    columnWidth: '60%',
                                }
                            },
                            xaxis: {
                                labels: {
                                    style: {
                                        fontSize: '10px',
                                        cssClass: 'text-xs font-normal fill-gray-500'
                                    }
                                }
                            }
                        }
                    }]
                }

                if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.getElementById("column-chart"), options);
                    chart.render();
                }
            } catch (error) {
                console.error("Error fetching age distribution data:", error);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            getAgeDistribution();
        });
    </script>
</body>
