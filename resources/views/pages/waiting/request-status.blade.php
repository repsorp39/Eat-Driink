@extends("layout.base")

@section("header")
    @include("components.header")
@endsection

@section("content")
    <x-status-component :info="$info" />
@endsection
