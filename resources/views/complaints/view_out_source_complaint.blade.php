@extends('layouts.layout')
@section('content')
<viewoutsourcecomplaint  :complaint="{{ json_encode($complaint) }}" ></viewoutsourcecomplaint>
@endsection