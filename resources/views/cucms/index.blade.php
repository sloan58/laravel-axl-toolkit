@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="page-header">
            <h1>Ciso UCM Models</h1>
        </div>
    </div>
    @if(isset($cucms))
    <div class="row justify-content-center">
        <div class="col-md-12">
             <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>IP Address</th>
                        <th>Username</th>
                        <th>Version</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cucms as $cucm)
                    <tr>
                        <th scope="row">{{ $cucm->name }}</th>
                        <td>{{ $cucm->ip }}</td>
                        <td>{{ $cucm->user }}</td>
                        <td>{{ $cucm->version }}</td>
                        <td>
                            <a href="{{ route('cucms.edit', $cucm->id ) }}" class="btn btn-success" role="button">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
             </table> 
        </div>
    </div>
    @endif
</div>
@endsection
