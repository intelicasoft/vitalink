<div class="col-md-3 mt-4">
   <b>Numero de serie</b> : {{$equipment->sr_no}}
</div>

<div class="col-md-3" style="font-weight: bold;">
   <b>@lang('equicare.company')</b> : {{ $equipment->company ?? '-' }}
</div>

<div class="col-md-3">
   <b>@lang('equicare.model')</b> : {{ $equipment->models->links ?? '-' }}
</div>

<div class="col-md-3">
   <b>@lang('equicare.hospital')</b> : {{ $equipment->hospital ? $equipment->hospital->name : '-' }}
</div>

<div class="col-md-3">
   <b>@lang('equicare.serial_no')</b> : {{ $equipment->sr_no }}
</div>

<div class="col-md-3">
   <b>@lang('equicare.department')</b> : {{ $equipment->get_department->short_name ?? '-' }} ({{ $equipment->get_department->name ?? '-' }})
</div>

<div class="col-md-3">
   <b>@lang('equicare.warranty_date')</b> : {{ $equipment->warranty_due_date ?? '-' }}
</div>
<div class="col-md-12 mt-4">
   <h3>Videos</h3>
   <div class="row">     
       <div class="col-md-6">
          <div class="embed-responsive embed-responsive-16by9">
             <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/TS6__etpQLs" allowfullscreen></iframe>
          </div>
       </div>
   </div>
</div>
{{-- @if(!empty($videoLinks))
    <div class="col-md-12 mt-4">
        <h3>Videos</h3>
        <div class="row">
            @foreach($videoLinks as $link)
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



