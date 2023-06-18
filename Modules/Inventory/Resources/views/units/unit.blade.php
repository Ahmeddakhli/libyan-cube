@extends('8x.layouts.main')
@section('title', trans('inventory::inventory.unit').' '.$i_unit->unit_number)

@section('content')
    @include('inventory::units.unit-content-qv')
@endsection

@push('footer-scripts')
    @include('inventory::units.unit-scripts')
@endpush