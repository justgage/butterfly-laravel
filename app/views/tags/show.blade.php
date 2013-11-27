@extends('layout.main')

@section('content')
<h2>{{ $title }}</h2>

<?php 
$oils = $tag->oils;
?>

@include('oils.include.oil_grid', ["oils" => $oils])
@stop

@section('script')
@include('oils.include.cart_js');
@stop
