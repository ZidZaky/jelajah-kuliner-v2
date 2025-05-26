@extends('layouts.layout2')

@section('title', 'LIST ACCOUNT')

@section('isiAlert')
    @if((session('alert'))!=null)
        
            @php echo session('alert'); @endphp
    @endif
@endsection

@section('main')

<div class="container mt-5 ">
    <h1 class="text-center">List of Accounts</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($account as $acc)
                    <tr>
                        <td>{{ $acc->id }}</td>
                        <td>{{ $acc->nama }}</td>
                        <td>{{ $acc->email }}</td>
                        <td>{{ $acc->nohp }}</td>
                        <td>{{ $acc->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<!--
gak dipake, gajadi dipake -->
