@extends('template.admin.main')

@section('title', 'Dashboard')

@section('content')

<!-- Main -->
<main class="app-content">

    <!-- Breadcrumb -->
    @include('template.admin._breadcrumb', ['breadcrumb' => [
        'title' => 'Dashboard',
        'items' => [
            ['text' => 'Dashboard', 'url' => '#'],
        ]
    ]])
    <!-- /Breadcrumb -->
    
</main>
<!-- /Main -->

@endsection