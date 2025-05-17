{{-- @if (Auth::user()->user_type_id == 1)
@include('components.naviBars.super_admin_nav')
@elseif (Auth::user()->user_type_id == 2)
@include('components.naviBars.asistant_admin_nav')
@elseif (Auth::user()->user_type_id == 3)
@include('components.naviBars.station_leader_nav')
@elseif (Auth::user()->user_type_id == 4)
@include('components.naviBars.bodaboda_nav')
@else
@include('components.naviBars.default_nav')
@endif --}}

@include('backend.components.naviBars.super_admin_nav')
