@extends('layouts.layout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/multiselect.css') }}">
@endpush
@section("content")

    <productimportcomponent :upload_options = "{{ json_encode($upload_options) }}" :templates="{{ json_encode($templates) }}" :suppliers="{{ json_encode($suppliers) }}" :categories="{{ json_encode($categories) }}" />
@endsection