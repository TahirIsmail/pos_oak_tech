@extends('layouts.layout')
@section('content')
<viewcustomercomplaint @if(isset($assign_access)) :assign_access="{{ $assign_access }}" @endif  @if(isset($delete_access)) :delete_access="{{ $delete_access }}" @endif  :complaint="{{ json_encode($complaint) }}" :labusers="{{ json_encode($labTechnician) }}"></viewcustomercomplaint>
@endsection