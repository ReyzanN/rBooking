@extends('layouts.app.customers.layouts')

@section('title', 'Tableau de bord')

@section('content')
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Tableau de bord</a></li>
            </ol>
        </nav>
    </div>
@endsection


@section('script')
@endsection
