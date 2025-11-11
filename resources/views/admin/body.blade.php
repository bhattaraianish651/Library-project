
<html>
<head>
    <style>
        .chart-container {
            display: flex;
            justify-content: space-between;
        }
        .chart {
            width: 48%;
            height: 400px;
        }
    </style>
</head>
<body>
<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
        </div>
    </div>
    <section class="no-padding-top no-padding-bottom">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="fas fa-user"></i></div><strong>Total User</strong>
                            </div>
                            <div class="number dashtext-1">{{$user}}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                 aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="fas fa-book"></i></div><strong>Total Books</strong>
                            </div>
                            <div class="number dashtext-2">{{$book}}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                 aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="fas fa-book-reader"></i></div><strong>Borrowed</strong>
                            </div>
                            <div class="number dashtext-3">{{$borrow}}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0"
                                 aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="fas fa-book-reader"></i></div><strong>Returned</strong>
                            </div>
                            <div class="number dashtext-4">{{$returned}}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                 aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="fas fa-book-reader"></i></div><strong>Rejected</strong>
                            </div>
                            <div class="number dashtext-4">{{$rejected}}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                 aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="fas fa-wallet"></i></div><strong>Total Price</strong>
                            </div>
                            <div class="number dashtext-5">{{$totalPrice}}</div>
                        </div>
                        <div class="progress progress-template">
                            <div role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                 aria-valuemax="100" class="progress-bar progress-bar-template dashbg-5"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-10">
                <div class="col-md-12">
                    <div class="statistic-block block">
                        <div class="progress-details d-flex align-items-end justify-content-between">
                            <div class="title">
                                <div class="icon"><i class="fas fa-chart-pie"></i></div>
                                <strong>Book Statistics</strong>
                            </div>
                        </div>
                        <div class="chart-container">
                            <!-- Pie Chart -->
                            <div class="chart">
                                <canvas id="pieChart"></canvas>
                            </div>
                            <!-- Bar Chart -->
                            <div class="chart">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Script for Charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataPie = {
        labels: ["Borrowed", "Rejected", "Returned"],
        datasets: [{
            label: "Book Data",
            data: [{{$borrow}}, {{$rejected}}, {{$returned}}],
            backgroundColor: [
                "rgb(90, 50, 241)",
                "rgb(255, 99, 132)",
                "rgb(54, 162, 235)"
            ],
            hoverOffset: 4
        }]
    };

    const configPie = {
        type: 'pie',
        data: dataPie,
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    };

    const dataBar = {
        labels: ["Total Users", "Total Books", "Borrowed", "Returned", "Rejected"],
        datasets: [{
            label: "Library Statistics",
            data: [{{$user}}, {{$book}}, {{$borrow}}, {{$returned}}, {{$rejected}}],
            backgroundColor: [
                "rgb(54, 162, 235)",
                "rgb(75, 192, 192)",
                "rgb(255, 205, 86)",
                "rgb(153, 102, 255)",
                "rgb(255, 99, 132)"
            ],
            borderWidth: 1
        }]
    };

    const configBar = {
        type: 'bar',
        data: dataBar,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Create Charts
    new Chart(document.getElementById('pieChart'), configPie);
    new Chart(document.getElementById('barChart'), configBar);
</script>
</body>
</html>
