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
<style>
    .red{ border-left: 5px solid red; }
</style>
<div class="row ">
   <div class="col-lg-3 col-xs-6 ">
      <!-- small box -->
      @php $count=0;  $count = \App\Hospital::query()->Hospital()->count(); @endphp
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $count }}</h3>
                <p>@lang('equicare.hospitals')</p>
            </div>
            <div class="icon">
              <i class="fa fa-hospital-o"></i>
            </div>
            <a href="{{ url('admin/hospitals') }}" class="small-box-footer">@lang('equicare.more_info')
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        @php $count=0; $count = \App\Equipment::query()->Hospital()->count(); @endphp
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $count }}</h3>
                <p>@lang('equicare.equipments')</p>
            </div>
            <div class="icon">
                <i class="fa fa-wheelchair"></i>
            </div>
            <a href="{{ url('admin/equipments') }}" class="small-box-footer">@lang('equicare.more_info')
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        @php $count=0; $count =\App\Models\Tickets::where('status','1')->count(); @endphp
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $count }}</h3>
                <p>Tickets Abiertos</p>
            </div>
            <div class="icon">
                <i class="fa fa-wrench"></i>
            </div>
            <a href="{{ url('admin/call/breakdown_maintenance') }}" class="small-box-footer">@lang('equicare.more_info')
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    {{-- <div class="col-lg-3 col-xs-6">
        @php $count=0; $count =\App\CallEntry::where('call_type','preventive')->Hospital()->count(); @endphp
        <div class="small-box bg-teal">
            <div class="inner">
                <h3>{{$count}}</h3>
                <p>@lang('equicare.preventive_maintenance')</p>
            </div>
            <div class="icon">
                <i class="fa fa-life-buoy"></i>
            </div>
            <a href="{{ url('admin/call/preventive_maintenance') }}" class="small-box-footer">@lang('equicare.more_info')
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div> --}}
     {{-- <div class="col-lg-3 col-xs-6">
        @php $count=0; $count = \App\Calibration::query()->Hospital()->count(); @endphp
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $count }}</h3>
                <p>@lang('equicare.calibrations')</p>
            </div>
            <div class="icon">
                <i class="fa fa-balance-scale"></i>
            </div>
            <a href="{{ url('admin/calibration') }}" class="small-box-footer">@lang('equicare.more_info')
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div> --}}
    {{-- <div class="col-lg-3 col-xs-6">
        @php $count=0; $count = \App\Department::all()->count(); @endphp
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>{{  $count }}</h3>
                <p>@lang('equicare.departments')</p>
            </div>
            <div class="icon">
                <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ url('admin/departments') }}" class="small-box-footer">@lang('equicare.more_info')
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div> --}}
    {{-- <div class="col-lg-3 col-xs-6">
        @php($date = date('Y-m-d',strtotime('+15 days')))
        @php($preventive_reminder_count = \App\CallEntry::where('call_type','preventive')->where('next_due_date','<=',$date)->Hospital()->count())
        <div class="small-box bg-purple {{ $preventive_reminder_count > 0 ? 'red':''}}">
            <div class="inner">
                <h3>{{ $preventive_reminder_count  }}</h3>
                <p>@lang('equicare.preventive_reminder')</p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar-check-o"></i>
            </div>
            <a href="{{ url('admin/reminder/preventive_maintenance') }}" class="small-box-footer">@lang('equicare.more_info')
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
        
    </div>
    <div class="col-lg-3 col-xs-6">
        @php($calibrations_reminder_count = \App\Calibration::where('due_date','<=',$date)->Hospital()->count())
        <div class="small-box bg-gray-active {{ $calibrations_reminder_count > 0 ? 'red':''}}">
            <div class="inner">
                
                <h3>{{ $calibrations_reminder_count }}</h3>
                <p>@lang('equicare.calibrations_reminder')</p>
            </div>
            <div class="icon">
                <i class="fa fa-clock-o"></i>
            </div>
            <a href="{{ url('admin/reminder/calibration') }}" class="small-box-footer">@lang('equicare.more_info')
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div> --}}
</div>
<div class="box">
    <div class="box-header with-border">
        <h4 class="box-title">Revisiones del mes</h4>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12" id="chart-container">


                {{-- <canvas id="myChart">
                    @lang('equicare.call_entries_chart_render')
                </canvas> --}}
                <canvas id="reviewsPerUserThisMonthChart"></canvas>
                <canvas id="reviewsPerUserYesterdayChart"></canvas>
                <canvas id="ticketsClosedIn72HoursPerMonthChart"></canvas>
                <canvas id="ticketsClosedPerMonthChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/bower_components/chart.js/Chart.bundle.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){

            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($total_days_array) !!},
                    datasets: [
                    {
                        label: '{{__("equicare.breakdown_maintenance")}}',
                        data: {!! json_encode($breakdown) !!},
                        fill:false,
                        lineTension: 0.1,
                        borderColor: 'rgba(0,192,239,0.9)',
                    },
                    {
                        label: '{{__("equicare.preventive_maintenance")}}',
                        data: {!! json_encode($preventive) !!},
                        fill:false,
                        lineTension: 0.1,
                        borderColor:'rgba(57,204,204,0.7)'

                    },
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true // Comienza el eje y en 0
                            }
                        }]
                    }
                }
            });

        });

        var ctxMonth = document.getElementById('reviewsPerUserThisMonthChart').getContext('2d');
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
                labels: {!! json_encode($ticketsClosedIn72HoursPerMonth->map(function($item) {
                    return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT); // Formato Año-Mes
                })) !!},
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
                labels: {!! json_encode($ticketsClosedPerMonth->map(function($item) {
                    return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
                })) !!},
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
@section('styles')
  <style type="text/css">
    .bg-gray-active:hover{
        color:#000;
    }
  </style>
@endsection
