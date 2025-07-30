@extends('layouts.back-end.app')

@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Welcome to the Dashboard</h1>
            <p>This is your dashboard where you can manage your real estate listings, view statistics, and more.</p>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    // Custom scripts for the dashboard can be added here
    console.log('Dashboard script loaded');
</script>
@endsection