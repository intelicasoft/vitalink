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
    <script src="{{ asset('assets/js/dashboard.js') }}" type="text/javascript"></script>

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

                        <div class="card">
                            <div>
                                <div class="numbers">80</div>
                                <div class="cardName">Sales</div>
                            </div>
                            <div class="iconBx">
                                <ion-icon name="cart-outline"></ion-icon>
                            </div>
                        </div>
                        {{-- <div class="card">
                            <div>
                                <div class="numbers">284</div>
                                <div class="cardName">Comments</div>
                            </div>
                            <div class="iconBx">
                                <ion-icon name="chatbubbles-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="card">
                            <div>
                                <div class="numbers">$7,842</div>
                                <div class="cardName">Earning</div>
                            </div>
                            <div class="iconBx">
                                <ion-icon name="cash-outline"></ion-icon>
                            </div>
                        </div> --}}
                    </div>



                    <!-- Add Charts -->
                    <div class="graphBox">
                        <div class="box">
                            <canvas id="myChartt"></canvas>
                        </div>
                        <div class="box">
                            <canvas id="earning"></canvas>
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


    @section('scripts')
        <script>
            var ctxMonth = document.getElementById('earning').getContext('2d');
            var reviewsPerUserThisMonthChart = new Chart(ctxMonth, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($reviewsPerUserThisMonth->pluck('user_id')) !!},
                    datasets: [{
                        label: 'Revisiones del Mes',
                        data: {!! json_encode($reviewsPerUserThisMonth->pluck('total_reviews')) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                }
            });

            var ctxYesterday = document.getElementById('reviewsPerUserYesterdayChart').getContext('2d');
            var reviewsPerUserYesterdayChart = new Chart(ctxYesterday, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($reviewsPerUserYesterday->pluck('user_id')) !!},
                    datasets: [{
                        label: 'Revisiones del Día de Ayer',
                        data: {!! json_encode($reviewsPerUserYesterday->pluck('total_reviews')) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                }
            });

            var ctx72HoursPerMonth = document.getElementById('ticketsClosedIn72HoursPerMonthChart').getContext('2d');
            var ticketsClosedIn72HoursPerMonthChart = new Chart(ctx72HoursPerMonth, {
                type: 'bar', // Puedes cambiar a 'line' si prefieres una gráfica de líneas
                data: {
                    labels: {!! json_encode(
                        $ticketsClosedIn72HoursPerMonth->map(function ($item) {
                            return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT); // Formato Año-Mes
                        }),
                    ) !!},
                    datasets: [{
                        label: 'Tickets Cerrados en 72 Horas por Mes',
                        data: {!! json_encode($ticketsClosedIn72HoursPerMonth->pluck('total_tickets')) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo de las barras
                        borderColor: 'rgba(54, 162, 235, 1)', // Color del borde de las barras
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true // Comienza el eje y en 0
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
                            return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
                        }),
                    ) !!},
                    datasets: [{
                        label: 'Tickets Cerrados',
                        data: {!! json_encode($ticketsClosedPerMonth->pluck('total_tickets')) !!},
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                }
            });
        </script>
    @endsection
