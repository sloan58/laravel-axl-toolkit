@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Query History
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach($queryHistory as $query)
                <a class="dropdown-item" href="#" onclick="setStatement(this, '{{ $query }}' )">{{ $query }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row mb-5">
                <div class="col-md-8">    
                    <form method="POST" action="/sql">
                        @csrf
                        <div class="form-group">
                            <label>SQL Query</label>
                            <textarea class="form-control" name="statement" id="statement" rows="6"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(isset($rows))
    <div class="row justify-content-center">
        <div class="col-md-12">
            <hr>
            <table class="table display" id="sqlTable">
                <thead class="thead-dark">
                    <tr>
                        @foreach($headers as $header)
                        <th scope="col">{{ ucfirst($header) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                @foreach($rows as $row)
                    <tr>
                        @foreach($headers as $header)
                        <td>{{ $row->{$header} }}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#sqlTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel',
                    'pdf'
                ]
            });
        } );

        function setStatement(element, query) {
            $('#statement').val(query);
        }
    </script>
@endpush
