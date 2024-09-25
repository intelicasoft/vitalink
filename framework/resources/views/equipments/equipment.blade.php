<div class="equipment-item">
    <b>Numero de serie</b> : {{ $equipment->sr_no }}
</div>

<div class="equipment-item">
    <b>@lang('equicare.company')</b> : {{ $equipment->company ?? '-' }}
</div>

<div class="equipment-item">
    <b>@lang('equicare.model')</b> : {{ $equipment->models->name ?? '-' }}
</div>

<div class="equipment-item">
    <b>@lang('equicare.hospital')</b> : {{ $equipment->hospital ? $equipment->hospital->name : '-' }}
</div>

{{-- <div class="equipment-item">
    <b>@lang('equicare.department')</b> : {{ $equipment->get_department->short_name ?? '-' }}
    ({{ $equipment->get_department->name ?? '-' }})
</div> --}}

<div class="equipment-item">
    <b>Fecha de instalacion</b> : {{ $equipment['date_of_installation'] ?? '-' }}
</div>

<div class="equipment-item">
    <b>Fecha de garantia</b> : {{ $equipment['warranty_due_date'] ?? '-' }}
</div>


<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<!-- Modal para Último Ticket Abierto -->
<div id="ticketModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h5>Información del Ticket</h5>
        @if ($lastOpenedTicket)
            <div class="row">
                <div class="col-md-4">
                    <b>Tipo de ticket</b> : {{ $lastOpenedTicket->category ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Título</b> : {{ $lastOpenedTicket->title ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Encargado</b> : {{ $lastOpenedTicket->manager->name ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Equipo Clínico</b> : {{ $lastOpenedTicket->equipment->sr_no ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Fecha de Registro</b> :
                    {{ date('Y-m-d h:i A', strtotime($lastOpenedTicket->created_at)) ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Estado</b> : {{ $lastOpenedTicket->status ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Fecha de Cierre</b> :
                    {{ date('Y-m-d h:i A', strtotime($lastOpenedTicket->deleted_at)) ?? '-' }}
                </div>
                <div class="col-md-12">
                    <b>Descripción</b> : {{ $lastOpenedTicket->description ?? '-' }}
                </div>
                <div class="col-md-12">
                    <b>Dirección</b> : {{ $lastOpenedTicket->adress ?? '-' }}
                </div>
                <div class="col-md-12">
                    <b>Teléfono</b> : {{ $lastOpenedTicket->phone ?? '-' }}
                </div>
                <div class="col-md-12">
                    <b>Contacto</b> : {{ $lastOpenedTicket->contact ?? '-' }}
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Modal para Último Mantenimiento -->
<div id="maintenanceModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h5>Información del Último Mantenimiento</h5>
        @if ($lastMaintenanceTicket)
            <div class="row">
                <div class="col-md-4">
                    <b>Título</b> : {{ $lastMaintenanceTicket->title ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Encargado</b> : {{ $lastMaintenanceTicket->manager->name ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Equipo Clínico</b> : {{ $lastMaintenanceTicket->equipment->sr_no ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Fecha de Registro</b> :
                    {{ date('Y-m-d h:i A', strtotime($lastMaintenanceTicket->created_at)) ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Estado</b> : {{ $lastMaintenanceTicket->status ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Fecha de Cierre</b> :
                    {{ date('Y-m-d h:i A', strtotime($lastMaintenanceTicket->deleted_at)) ?? '-' }}
                </div>
                <div class="col-md-12">
                    <b>Descripción</b> : {{ $lastMaintenanceTicket->description ?? '-' }}
                </div>
                <div class="col-md-12">
                    <b>Dirección</b> : {{ $lastMaintenanceTicket->adress ?? '-' }}
                </div>
                <div class="col-md-12">
                    <b>Teléfono</b> : {{ $lastMaintenanceTicket->phone ?? '-' }}
                </div>
                <div class="col-md-12">
                    <b>Contacto</b> : {{ $lastMaintenanceTicket->contact ?? '-' }}
                </div>
            </div>
        @endif
    </div>
</div>


<!-- Modal para Última Instalación -->
<div id="installationModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h5>Información de la Última Instalación</h5>
        @if ($lastInstallationTicket)
            <div class="row">
                <div class="col-md-4">
                    <b>Título</b> : {{ $lastInstallationTicket->title ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Encargado</b> : {{ $lastInstallationTicket->manager->name ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Equipo Clínico</b> : {{ $lastInstallationTicket->equipment->sr_no ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Fecha de Registro</b> :
                    {{ date('Y-m-d h:i A', strtotime($lastInstallationTicket->created_at)) ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Estado</b> : {{ $lastInstallationTicket->status ?? '-' }}
                </div>
                <div class="col-md-4">
                    <b>Fecha de Cierre</b> :
                    {{ date('Y-m-d h:i A', strtotime($lastInstallationTicket->deleted_at)) ?? '-' }}
                </div>
                <div class="col-md-12">
                    <b>Descripción</b> : {{ $lastInstallationTicket->description ?? '-' }}
                </div>
                <div class="col-md-12">
                    <b>Dirección</b> : {{ $lastInstallationTicket->adress ?? '-' }}
                </div>
                <div class="col-md-12">
                    <b>Teléfono</b> : {{ $lastInstallationTicket->phone ?? '-' }}
                </div>
                <div class="col-md-12">
                    <b>Contacto</b> : {{ $lastInstallationTicket->contact ?? '-' }}
                </div>
            </div>
        @endif
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modals = document.querySelectorAll('.modal');
        var buttons = document.querySelectorAll('.color-box');
        var spans = document.querySelectorAll('.close');

        buttons.forEach(function(button) {
            button.onclick = function() {
                if (!button.classList.contains('gray')) {
                    var modalId = button.getAttribute('data-modal');
                    var modal = document.getElementById(modalId);
                    modal.style.display = "block";
                }
            }
        });

        spans.forEach(function(span) {
            span.onclick = function() {
                var modal = span.closest('.modal');
                modal.style.display = "none";
            }
        });

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = "none";
            }
        }
    });
</script>





{{-- @if (!empty($videoLinks))
       <div class="col-md-12 mt-4">
           <h3>Videos</h3>
           <div class="row">
               @foreach ($videoLinks as $link)
                   <div class="col-md-4 mb-4">
                       <div class="embed-responsive embed-responsive-16by9">
                           <iframe class="embed-responsive-item" src="{{ $link }}" allowfullscreen></iframe>
                       </div>
                   </div>
               @endforeach
               <div class="col-md-6">
                  <h4>Video de Mantenimiento</h4>
                  <div class="embed-responsive embed-responsive-16by9">
                     <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/TS6__etpQLs" allowfullscreen></iframe>
                  </div>
               </div>
           </div>
       </div>
   @else
       <p>No videos available.</p>
   @endif --}}
