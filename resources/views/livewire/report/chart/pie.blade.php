<div>
    @if(auth()->user()->isAdmin())

        <div class="row" wire:ignore>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex mg-b-10">
                                <h6 class="main-content-label my-auto">{{ __('lang.project.project_charts') }}</h6>
                                <div class="ms-auto  d-flex">
                                    <div class="me-3 d-flex text-muted tx-13">
                                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('lang.chart_info.pie_projects') }}"><i class="fas fa-question-circle"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row row-sm">
                                    <div class="col-12 mg-b-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fe fe-calendar  lh--9 op-6"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="filter-range-pie"
                                                   class="form-control pull-right date-range-picker"
                                                   value="{{ $projectPieDateFilter['start_date'] }} - {{ $projectPieDateFilter['end_date'] }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="ht-300 ht-sm-300">
                                            <div id="flotPieReportProjects" class="ht-300 ht-sm-300"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex mg-b-10">
                                <h6 class="main-content-label my-auto">{{ __('lang.seller') }}</h6>
                                <div class="ms-auto  d-flex">
                                    <div class="me-3 d-flex text-muted tx-13">
                                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('lang.chart_info.user_seller_projects') }}"><i class="fas fa-question-circle"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row row-sm">
                                    <div class="col-12 mg-b-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fe fe-calendar  lh--9 op-6"></i>
                                                </div>
                                            </div>
                                            <input type="text" id="filter-range-seller"
                                                   class="form-control pull-right date-range-picker"
                                                   value="{{ $sellerDateFilter['start_date'] }} - {{ $sellerDateFilter['end_date'] }}"
                                            >
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="ht-300 ht-sm-300">
                                            <canvas id="chartJsReportUserSeller" class="ht-300 ht-sm-300"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-4"></div>
        </div>

        @push('script')
            <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
            <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
            <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
            <script src="{{ asset('assets/plugins/chart.js/chart.4.4.1.js') }}"></script>
            <script src="{{ asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
            <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}"></script>
            <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

            <script>
                const pieProjectsChart = $.plot('#flotPieReportProjects', @json($pieChartProjects->data_chart), {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            label: {
                                show: true,
                                radius: 2 / 3,
                                formatter: labelFormatter,
                                threshold: 0.1
                            }
                        }
                    },
                    grid: {
                        hoverable: true,
                        clickable: true
                    }
                });

                document.addEventListener('livewire:init', () => {
                    Livewire.on('update-chart-pie-projects', event => {
                        pieProjectsChart.setData(event.data);
                        pieProjectsChart.draw();
                    });
                })

                function labelFormatter(label, series) {
                    return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                }


                initDateRangePicker('#filter-range-seller', function (start, end, label) {
                    Livewire.dispatch('filter-seller-report', {
                        startDate: start.format('YYYY-MM-DD'),
                        endDate: end.format('YYYY-MM-DD')
                    })
                });

                initDateRangePicker('#filter-range-pie', function (start, end, label) {
                    Livewire.dispatch('filter-pie-report', {
                        startDate: start.format('YYYY-MM-DD'),
                        endDate: end.format('YYYY-MM-DD')
                    })
                });


                function initDateRangePicker(element, customFunction)
                {
                    $(element).daterangepicker({
                        opens: 'left',
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        locale: {
                            format: 'YYYY-MM-DD',
                        }
                    }, customFunction);
                }

                const chartOptions = {
                    responsive: true,
                    legend: {
                        position: "top"
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
                const chartUserSeller = new Chart(document.getElementById("chartJsReportUserSeller"), {
                    type: 'bar',
                    data: @json($usersSellerChart->data_chart),
                    options: chartOptions
                });
                document.addEventListener('livewire:init', () => {
                    Livewire.on('update-chart-user-seller', event => {
                        chartUserSeller.data = event.data;
                        chartUserSeller.update();
                    });
                })

            </script>

        @endpush
    @endif
</div>
