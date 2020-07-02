@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Glasses
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Glass Type</th>
                            <th scope="col">Vendor</th>
                            <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($glasses as $glass)
                                <tr>
                                <th scope="row">{{ $glass->glassType }}</th>
                                <td>{{ $glass->glassVendor}}</td>
                                <td>
                                    <a href="/glasses/view/{{$glass->id}}" class="btn btn-primary" role="button" style="width:100%">View</a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
