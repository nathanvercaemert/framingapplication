@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Foamcores
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Foamcore Type</th>
                            <th scope="col">Vendor</th>
                            <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($foamcores as $foamcore)
                                <tr>
                                <th scope="row">{{ $foamcore->foamcoreType }}</th>
                                <td>{{ $foamcore->foamcoreVendor }}</td>
                                <td>
                                    <a href="/foamcores/view/{{$foamcore->id}}" class="btn btn-primary" role="button" style="width:100%">View</a>
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
