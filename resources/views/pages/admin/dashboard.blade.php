@extends("layout.base")

@section("title","Eat&Drink-Dashboard")

@section('header')
    @include("components.header")
@endsection
@section("content")
    @if($filter === "en attente")
        <x-entrepreneur-state  :filter="$filter" :requests="$waiting" />
    @endif
    @if($filter === "rejeté")
        <x-entrepreneur-state  :filter="$filter" :requests="$rejected" />
    @endif
    @if($filter === "approuvé")
        <x-entrepreneur-state :filter="$filter" :requests="$approved" />
    @endif
@endsection