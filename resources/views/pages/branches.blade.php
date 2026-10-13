@extends('layouts.finbank')
@php($title = 'Lokasi Kantor — KSP Dharma Siaga')
@section('content')
@include('partials.template-breadcrumb', ['pageTitle' => 'Lokasi Kantor'])
<section class="main-contact-form-area"><div class="container"><div class="row"><div class="col-xl-8 offset-xl-2">
@include('partials.template-office-details', ['contactHeading' => 'Kantor KSP Dharma Siaga'])
</div></div></div></section>
@endsection
