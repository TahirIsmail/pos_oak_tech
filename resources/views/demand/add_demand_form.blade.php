@extends('layouts.layout')

@section("content")
<adddemandformcomponent :suppliers="{{ json_encode($suppliers) }}"></adddemandformcomponent>
@endsection