@php
    /** @var $page  */
    if(!isset($page))
    {
        dd("Unable to display layouts.vertical.blade.php - the $page object is not set. Please refer to documentation for additional information");
    }
@endphp

@extends($page->getTemplate())

@section('layout')
    @include('includes.navbar')
    @include('includes.blocks')
@endsection
