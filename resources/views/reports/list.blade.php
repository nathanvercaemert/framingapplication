@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Reports
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Report Number</th>
                            <th scope="col">Created</th>
                            <th scope="col">Processed</th>
                            <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                                <tr>
                                <th scope="row">{{ $report->reportNumber }}</th>
                                <td>{{ substr($report->created_at, 0, 10) }}</td>
                                <td>{{ $report->isProcessed ? substr($report->processed_at, 0, 10) : 'Unprocessed'}}</td>
                                <td>
                                    <a href="/reports/view/{{$report->id}}" class="btn btn-primary" role="button" style="width:100%">View</a>
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
