@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

<div id="root">
    <input type="text" id="input" v-model="message">
</div>

<script>
    let data = {
        message: 'Hello World'
    };
    new Vue({
        el:'#root'
        data: data
    })
</script>
@endsection
