@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Invalid Order Number
                </div>
                <div class="card-body">
                    <div>
                        <a href="/orders" class="btn btn-primary" role="button" style="width:100%">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
