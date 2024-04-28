@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

           


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List Of Patients</div>
                    <div class="card-body">

                        @if ($patients->isEmpty())
                            <p>No Patients.</p>
                        @else
                            <div class=" mt-3 table-container">
                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            
                                <table id="myTable" class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;">

                                        <th>Patient</th>
                                        <th>Birth Date</th>

                                        <th>Is Online</th>
                                        <th></th>
                                        <th>Actions</th>
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($patients as $patient)
                                        <tr style="white-space: nowrap; font-size: 14px;">

                                            <td>{{$patient->name}}</td>
                                            <td>{{$patient->date_of_birth}}</td>
                                            

                                            <td>
                        <span class="badge {{ $patient->is_online ? 'badge-green' : 'badge-red' }}">
                            {{ $patient->is_online ? 'Online' : 'Offline' }}
                            </span>
                 
                                            </td>
                                            <td>
                                            <form method="POST" action="{{ route('patients.updateStatus', $patient) }}">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-danger btn-xs">Change </button>

                                                </form> 
                                            </td>
                                          
                                            
                                            <td>
                                                <a href="#" class="btn btn-primary btn-xs">Edit</a>

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>



                            </div>
                        @endif
                            
                     
                    </div>
                </div>


<script>
    let table = new DataTable('#myTable');
</script>

@endsection