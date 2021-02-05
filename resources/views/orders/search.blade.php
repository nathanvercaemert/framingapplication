@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Search Orders
                </div>
                <div class="card-body">
                    <search-component ref="searchComponent"></search-component>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
