@extends('layouts.admin')
@section('body-title')
    @lang('equicare.home')
@endsection
@section('title')
    | @lang('equicare.dashboard')
@endsection
@section('breadcrumb')
    <li class="active">@lang('equicare.dashboard')</li>
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">

    <div class="row ">

        <body>

            <div class="container">
                <!-- main -->
                <div class="main">
                    @php
                        $countHospitals = 0;
                        $countHospitals = \App\Hospital::query()->Hospital()->count();

                        $countOpenTickets = 0;
                        $countOpenTickets = \App\Models\Tickets::where('status', '1')->count();

                        $countEquipment = 0;
                        $countEquipment = \App\Equipment::query()->Hospital()->count();
                    @endphp

                    <!-- cards -->
                    <div class="cardBox">

                        {{-- onclick url --}}
                        <div class="card" onclick="window.location.href='{{ url('admin/hospitals') }}'">
                            <div class="cardName">
                                <div class="numbers">{{ $countHospitals }}</div>
                                <p>@lang('equicare.hospitals')</p>
                            </div>
                            <div class="iconBx">
                                <i class="fa fa-hospital-o"></i>
                            </div>
                        </div>


                        <div class="card" onclick="window.location.href='{{ url('admin/equipments') }}'">
                            <div class="cardName">
                                <div class="numbers">{{ $countEquipment }}</div>
                                <p>@lang('equicare.equipments')</p>
                            </div>
                            <div class="iconBx">
                                <i class="fa fa-wheelchair"></i>
                            </div>
                        </div>


                        <div class="card" onclick="window.location.href='{{ url('admin/tickets') }}'">
                            <div class="cardName">
                                <div class="numbers">{{ $countOpenTickets }}</div>
                                <p>Tickets Abiertos</p>
                            </div>
                            <div class="iconBx">
                                <i class="fa fa-wrench"></i>
                            </div>
                        </div>

                        <div class="card" onclick="window.location.href='{{ url('admin/tickets') }}'">
                            <div class="cardName">
                                <div class="numbers">{{ $countOpenTickets }}</div>
                                <p>Tickets Abiertos</p>
                            </div>
                            <div class="iconBx">
                                <i class="fa fa-wrench"></i>
                            </div>
                        </div>

                    </div>

                    <!-- Add Charts -->
                    <div class="graphBox">
                        <div class="box" style="padding: 30px">
                            <canvas id="equipmentStatusChart"></canvas>
                        </div>

                        <div class="carousel-container">
                            <div class="carousel">
                                <div class="carousel-item">
                                    <div class="box">
                                        <canvas id="earning"></canvas>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="box">
                                        <canvas id="reviewsPerUserYesterdayChart"></canvas>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="box">
                                        <canvas id="ticketsClosedIn72HoursPerMonthChart"></canvas>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="box">
                                        <canvas id="ticketsClosedPerMonthChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
                            <button class="next" onclick="moveSlide(1)">&#10095;</button>
                        </div>
                    </div>




                    <div class="details">
                        <!-- order details list -->
                        <div class="recentOrders">
                            <div class="cardHeader">
                                <h2>Recent Orders</h2>
                                <a href="#" class="btn">View All</a>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Price</td>
                                        <td>Payment</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Star Refrigerator</td>
                                        <td>$1200</td>
                                        <td>Paid</td>
                                        <td><span class="status delivered">Delivered</span></td>
                                    </tr>
                                    <tr>
                                        <td>Window Coolers</td>
                                        <td>$110</td>
                                        <td>Due</td>
                                        <td><span class="status pending">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>Speakers</td>
                                        <td>$620</td>
                                        <td>Paid</td>
                                        <td><span class="status return">Return</span></td>
                                    </tr>
                                    <tr>
                                        <td>Hp Laptop</td>
                                        <td>$110</td>
                                        <td>Due</td>
                                        <td><span class="status inprogress">In Progress</span></td>
                                    </tr>
                                    <tr>
                                        <td>Apple Watch</td>
                                        <td>$1200</td>
                                        <td>Paid</td>
                                        <td><span class="status delivered">Delivered</span></td>
                                    </tr>
                                    <tr>
                                        <td>Wall Fan</td>
                                        <td>$110</td>
                                        <td>Paid</td>
                                        <td><span class="status pending">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>Adidas Shoes</td>
                                        <td>$620</td>
                                        <td>Paid</td>
                                        <td><span class="status return">Return</span></td>
                                    </tr>
                                    <tr>
                                        <td>Denim Shirts</td>
                                        <td>$110</td>
                                        <td>Due</td>
                                        <td><span class="status inprogress">In Progress</span></td>
                                    </tr>
                                    <tr>
                                        <td>Casual Shoes</td>
                                        <td>$575</td>
                                        <td>Paid</td>
                                        <td><span class="status pending">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>Wall Fan</td>
                                        <td>$110</td>
                                        <td>Paid</td>
                                        <td><span class="status pending">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>Denim Shirts</td>
                                        <td>$110</td>
                                        <td>Due</td>
                                        <td><span class="status inprogress">In Progress</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- New Customers -->
                        <div class="recentCustomers">
                            <div class="cardHeader">
                                <h2>Recent Customers</h2>
                            </div>
                            <table>
                                <tr>
                                    <td width="60px">
                                        <div class="imgBx"><img src="img1.jpg"></div>
                                    </td>
                                    <td>
                                        <h4>David<br><span>Italy</span></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="imgBx"><img src="img2.jpg"></div>
                                    </td>
                                    <td>
                                        <h4>Muhammad<br><span>India</span></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="imgBx"><img src="img3.jpg"></div>
                                    </td>
                                    <td>
                                        <h4>Amelia<br><span>France</span></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="imgBx"><img src="img4.jpg"></div>
                                    </td>
                                    <td>
                                        <h4>Olivia<br><span>USA</span></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="imgBx"><img src="img5.jpg"></div>
                                    </td>
                                    <td>
                                        <h4>Amit<br><span>Japan</span></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="imgBx"><img src="img6.jpg"></div>
                                    </td>
                                    <td>
                                        <h4>Ashraf<br><span>India</span></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="imgBx"><img src="img7.jpg"></div>
                                    </td>
                                    <td>
                                        <h4>Diana<br><span>Malaysia</span></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="imgBx"><img src="img8.jpg"></div>
                                    </td>
                                    <td>
                                        <h4>Amit<br><span>India</span></h4>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
            <script src="{{ asset('assets/js/my_chart.js') }}" type="text/javascript"></script>

        </body>
    @endsection
    @php
        function getNombreMes($numeroMes)
        {
            $meses = [
                1 => 'Enero',
                2 => 'Febrero',
                3 => 'Marzo',
                4 => 'Abril',
                5 => 'Mayo',
                6 => 'Junio',
                7 => 'Julio',
                8 => 'Agosto',
                9 => 'Septiembre',
                10 => 'Octubre',
                11 => 'Noviembre',
                12 => 'Diciembre',
            ];
            return $meses[$numeroMes] ?? '';
        }
    @endphp

    @section('scripts')
        <script>
            const purpleGradient = {
                backgroundColor: [
                    'rgba(65, 22, 87, 1)',
                    'rgba(87, 30, 117, 0.9)',
                    'rgba(109, 38, 147, 0.8)',
                    'rgba(131, 46, 177, 0.7)',
                    'rgba(153, 54, 207, 0.6)',
                    'rgba(175, 62, 237, 0.5)',
                    'rgba(197, 70, 255, 0.4)'
                ],
                borderColor: [
                    'rgb(65, 22, 87)',
                    'rgb(87, 30, 117)',
                    'rgb(109, 38, 147)',
                    'rgb(131, 46, 177)',
                    'rgb(153, 54, 207)',
                    'rgb(175, 62, 237)',
                    'rgb(197, 70, 255)'
                ]
            };

            const coolColors = {
                backgroundColor: [
                    'rgba(0, 63, 92, 1)',
                    'rgba(5, 102, 141, 0.9)',
                    'rgba(2, 128, 144, 0.8)',
                    'rgba(0, 168, 150, 0.7)',
                    'rgba(2, 195, 154, 0.6)',
                    'rgba(240, 243, 189, 0.5)',
                    'rgba(73, 190, 170, 0.4)'
                ],
                borderColor: [
                    'rgb(0, 63, 92)',
                    'rgb(5, 102, 141)',
                    'rgb(2, 128, 144)',
                    'rgb(0, 168, 150)',
                    'rgb(2, 195, 154)',
                    'rgb(240, 243, 189)',
                    'rgb(73, 190, 170)'
                ]
            };

            var ctxMonth = document.getElementById('earning').getContext('2d');

            var reviewsPerUserThisMonthChart = new Chart(ctxMonth, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($reviewsPerUserThisMonth->pluck('user_name')) !!},
                    datasets: [{
                        label: 'Revisiones del Mes',
                        data: {!! json_encode($reviewsPerUserThisMonth->pluck('total_reviews')) !!},
                        backgroundColor: purpleGradient.backgroundColor,
                        borderColor: purpleGradient.borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',

                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                            max: 50 // Fija el límite máximo en el eje Y a 50
                        }
                    }
                }

            });

            var ctxYesterday = document.getElementById('reviewsPerUserYesterdayChart').getContext('2d');
            var reviewsPerUserYesterdayChart = new Chart(ctxYesterday, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($reviewsPerUserYesterday->pluck('user_name')) !!},
                    datasets: [{
                        label: 'Revisiones del Día de Ayer',
                        data: {!! json_encode($reviewsPerUserYesterday->pluck('total_reviews')) !!},
                        backgroundColor: purpleGradient.backgroundColor,
                        borderColor: purpleGradient.borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 20
                        }
                    }
                }

            });



            var ctx72HoursPerMonth = document.getElementById('ticketsClosedIn72HoursPerMonthChart').getContext('2d');
            var ticketsClosedIn72HoursPerMonthChart = new Chart(ctx72HoursPerMonth, {
                type: 'bar', // Puedes cambiar a 'line' si prefieres una gráfica de líneas
                data: {
                    labels: {!! json_encode(
                        $ticketsClosedIn72HoursPerMonth->map(function ($item) {
                            return getNombreMes($item->month);
                        }),
                    ) !!},
                    datasets: [{
                        label: 'Tickets Cerrados en 72 Horas por Mes',
                        data: {!! json_encode($ticketsClosedIn72HoursPerMonth->pluck('total_tickets')) !!},
                        backgroundColor: purpleGradient.backgroundColor,
                        borderColor: purpleGradient.borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 50 // Fija el límite máximo en el eje Y a 50
                        }
                    }
                }

            });

            var ctxPerMonth = document.getElementById('ticketsClosedPerMonthChart').getContext('2d');
            var ticketsClosedPerMonthChart = new Chart(ctxPerMonth, {
                type: 'line',
                data: {
                    labels: {!! json_encode(
                        $ticketsClosedPerMonth->map(function ($item) {
                            return getNombreMes($item->month);
                        }),
                    ) !!},
                    datasets: [{
                        label: 'Tickets Cerrados',
                        data: {!! json_encode($ticketsClosedPerMonth->pluck('total_tickets')) !!},
                        backgroundColor: purpleGradient.backgroundColor,
                        borderColor: purpleGradient.borderColor,
                        borderWidth: 1
                    }]
                },
                options: {


                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 50 // Fija el límite máximo en el eje Y a 50
                        }
                    }
                }

            });

            var ctx = document.getElementById('equipmentStatusChart').getContext('2d');
            var equipmentStatusChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($equipmentStatusCounts->pluck('status_description')) !!},
                    datasets: [{
                        label: 'Cantidad de Equipos por Estado',
                        data: {!! json_encode($equipmentStatusCounts->pluck('total')) !!},
                        backgroundColor: purpleGradient.backgroundColor,
                        borderColor: purpleGradient.borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Cantidad de Equipos por Estado',
                            font: {
                                size: 20
                            },
                            padding: {
                                bottom: 10
                            }
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        </script>
    @endsection
