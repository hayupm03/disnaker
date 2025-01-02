    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </a> -->
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Mediator</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_mediator; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-user-cog fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Pelapor</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pelapor; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-user-cog fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Agenda Mediasi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_agenda; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pelaporan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_laporan; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Total Agenda Mediasi per bulan</h6>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <h5 class="card-title">Total Agenda Mediasi</h5>
                            <div id="agendaChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var agendaOptions = {
            chart: {
                type: 'bar',
                width: '100%',
                height: '400px'
            },
            series: [{
                name: 'Agenda Mediasi',
                data: <?= json_encode($agenda_totals) ?>
            }],
            xaxis: {
                categories: <?= json_encode($agenda_status) ?>
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'center',
                floating: false,
                fontSize: '14px',
                fontFamily: 'Arial',
                fontWeight: 400,
                offsetY: 0,
                itemMargin: {
                    horizontal: 5,
                    vertical: 5
                }
            }
        };

        // Membuat chart untuk agenda mediasi
        var agendaChart = new ApexCharts(document.querySelector("#agendaChart"), agendaOptions);
        agendaChart.render();
    </script>