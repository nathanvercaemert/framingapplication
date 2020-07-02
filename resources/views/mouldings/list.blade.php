@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Mouldings
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Moulding Number</th>
                            <th scope="col">Vendor</th>
                            <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mouldings as $moulding)
                                <tr>
                                <th scope="row">{{ $moulding->mouldingNumber }}</th>
                                <td>{{ $moulding->mouldingVendor }}</td>
                                <td>
                                    <a href="/mouldings/view/{{$moulding->id}}" class="btn btn-primary" role="button" style="width:100%">View</a>
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
