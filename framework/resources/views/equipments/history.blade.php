@extends('layouts.app')

@section('body-title')
    @lang('equicare.equipment_history')
@endsection

@section('title')
    | @lang('equicare.equipment_history')
@endsection

@section('breadcrumb')
    <li class="active">@lang('equicare.equipment_history')</li>
@endsection

@section('content')

    <style>
        .equipment-details {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            /* Espacio entre elementos */
            padding: 20px;
            background-color: #f1f1f1;
            /* Fondo claro para todo el contenedor */
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .equipment-item {
            width: 100%;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            /* Fondo blanco para cada ítem */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Sombra ligera para los ítems */

        }

        .equipment-container {
            overflow-x: auto;
            white-space: nowrap;
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
        }

        .video-container {
            width: 100%;
            height: 300px;
            overflow: hidden;
            margin-bottom: 20px
        }

        .full-width {
            width: 50%;
        }

        .color-box {
            flex: 1 1 calc(33.333% - 20px);
            /* Tres elementos por fila */
            box-sizing: border-box;
            padding: 20px;
            border-radius: 5px;
            margin: 10px;
            height: 100px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            /* Espacio entre los divs */
            text-align: center;
            /* Alineación centrada del texto */
            cursor: pointer;
            /* Cambia el cursor a una mano al pasar sobre los cuadros */
        }

        .color-box.green {
            background-color: #2ecc71;
            color: #fff;
        }

        .color-box.gray {
            background-color: rgb(160, 159, 159);
            cursor: not-allowed;
        }


        @media (max-width: 1000px) {
            .equipment-item {
                width: 100%;
            }

            .full-width {
                width: 100%;
            }

        }

        @media (max-width: 480px) {
            .equipment-item {
                flex: 1 1 100%;
            }

            .full-width {
                width: 100%;
            }
        }

        .carousel-container {
            position: relative;
            width: 100%;
            max-width: 800px;
            overflow: hidden;
        }

        .carousel {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-item {
            min-width: 100%;
            box-sizing: border-box;
        }

        button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .prev {
            left: 10px;
        }

        .next {
            right: 10px;
        }
    </style>

    <script>
        let currentIndex = 0;

        function moveSlide(direction) {
            const carousel = document.querySelector('.carousel');
            const items = document.querySelectorAll('.carousel-item');
            const totalItems = items.length;

            currentIndex += direction;

            if (currentIndex < 0) {
                currentIndex = totalItems - 1;
            } else if (currentIndex >= totalItems) {
                currentIndex = 0;
            }

            const offset = -currentIndex * 100;
            carousel.style.transform = `translateX(${offset}%)`;
        }


        document.addEventListener('DOMContentLoaded', function() {
            var buttons = document.querySelectorAll('.color-box');
            buttons.forEach(function(button) {
                if (button.classList.contains('gray')) {
                    button.onclick = function(event) {
                        event.preventDefault();
                    };
                } else {
                    button.onclick = function() {
                        var modalId = this.getAttribute('data-modal');
                        console.log('Abriendo modal: ' + modalId);
                    };
                }
            });
        });
    </script>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>@lang('equicare.equipment_history')</h2>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title" style="float:left;">
                            <b>@lang('equicare.name')</b> : {{ $equipment->name ?? '' }}
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </h4>
                    </div>

                    <div class="box-body" style="padding: 20px">
                        <div class="row">
                            <div class="col-md-8 full-width">
                                @include('equipments.equipment')
                            </div>
                            <div class="col-md-4 full-width">
                                <div class="video-container">
                                    <div class="carousel-container">
                                        <div class="carousel">
                                            <?php
                                            // Verificar si $equipment->models existe y si tiene links
                                            if ($equipment->models && !empty($equipment->models->links)) {
                                                $links = explode(',', $equipment->models->links);
                                                foreach ($links as $link) {
                                                    $link = str_replace('watch?v=', 'embed/', $link);
                                                    echo '<div class="carousel-item">';
                                                    echo '<iframe class="video-container" src="' . $link . '" frameborder="0" allowfullscreen></iframe>';
                                                    echo '</div>';
                                                }
                                            } else {
                                                // Mostrar mensaje si no hay enlaces disponibles
                                                echo '<p>No hay videos disponibles para este equipo.</p>';
                                            }
                                            ?>
                                        </div>
                                        <?php if ($equipment->models && !empty($equipment->models->links)): ?>
                                            <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
                                            <button class="next" onclick="moveSlide(1)">&#10095;</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="flex-container" style="width: 100%">
                                    <div class="color-box <?php echo isset($lastOpenedTicket) ? 'green' : 'gray'; ?>" data-modal="ticketModal">
                                        <?php echo isset($lastOpenedTicket) ? 'Ver último ticket' : 'No existen tickets abiertos'; ?>
                                    </div>
                                    <div class="color-box <?php echo isset($lastMaintenanceTicket) ? 'green' : 'gray'; ?>" data-modal="maintenanceModal">
                                        <?php echo isset($lastMaintenanceTicket) ? 'Ver último mantenimiento' : 'No existen mantenimientos abiertos'; ?>
                                    </div>
                                    <div class="color-box <?php echo isset($lastInstallationTicket) ? 'green' : 'gray'; ?>" data-modal="installationModal">
                                        <?php echo isset($lastInstallationTicket) ? 'Ver última instalación' : 'No existen instalaciones abiertas'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <!-- The time line -->
                <ul class="timeline">
                    {{-- <script>
                        console.log(@json($data));
                    </script> --}}
                    @if ($data->count() > 0)
                        @foreach ($data as $d)
                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-red">
                                    {{ date('Y-m-d', strtotime($d['created_at'])) }}
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                @if ($d['type'] == 'Ticket')
                                    <i class="fa fa-ticket bg-green"></i>
                                @endif

                                <div class="timeline-item">
                                    <span class="time">
                                        <i class="fa fa-clock-o"></i> {{ date('h:i A', strtotime($d['created_at'])) }}
                                    </span>
                                    <span class="time">
                                        <!-- Aquí puedes agregar enlaces adicionales según el tipo de ticket si es necesario -->
                                        @if ($d['status'] == '1')
                                            <a href="{{ route('tickets.edit', $d['id']) }}" title="@lang('equicare.edit')"
                                                class="h4">
                                                <i class="fa fa-edit purple-color"></i> @lang('equicare.edit')
                                            </a>
                                        @endif
                                    </span>
                                    <h3 class="timeline-header text-blue">
                                        <b>{{ $d['category'] }}</b>
                                    </h3>

                                    <div class="timeline-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <b>Titulo</b> : {{ $d['title'] ?? '-' }}
                                            </div>
                                            <div class="col-md-4">
                                                <b>Encargado</b> : {{ $d['manager']['name'] ?? '-' }}
                                            </div>
                                            <div class="col-md-4">
                                                <b>Equipo Clínico</b> : {{ $d['equipment']['sr_no'] ?? '-' }}
                                            </div>
                                            <div class="col-md-4">
                                                <b>Fecha de Registro</b> :
                                                {{ date('Y-m-d h:i A', strtotime($d['created_at'])) ?? '-' }}
                                            </div>
                                            <div class="col-md-4">
                                                <b>Estado</b> : {{ $d['status'] ?? '-' }}
                                            </div>
                                            <div class="col-md-4">
                                                <b>Fecha de Cierre</b> :
                                                {{ date('Y-m-d h:i A', strtotime($d['deleted_at'])) ?? '-' }}
                                            </div>

                                            <div class="col-md-12">
                                                <b>Descripción</b> : {{ $d['description'] ?? '-' }}
                                            </div>
                                            <div class="col-md-12">
                                                <b>Dirección</b> : {{ $d['adress'] ?? '-' }}
                                            </div>
                                            <div class="col-md-12">
                                                <b>Teléfono</b> : {{ $d['phone'] ?? '-' }}
                                            </div>
                                            <div class="col-md-12">
                                                <b>Contacto</b> : {{ $d['contact'] ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <!-- timeline item -->
                        <li>
                            <i class="fa fa-circle bg-green"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header text-blue">
                                    No History Found for this Equipment.
                                </h3>
                                <div class="timeline-body"></div>
                            </div>
                        </li>
                    @endif

                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>


                </ul>
            </div>
        </div>
    </div>
    </div>
@endsection
