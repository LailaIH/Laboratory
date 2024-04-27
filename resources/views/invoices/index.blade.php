@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

           


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List of patients invoices</div>
                    @if (session('success'))

                    <div class="alert alert-success m-3" role="alert">{{ session('success') }}</div>
                    @endif
                    @if ($errors->has('fail'))
                        <div class="alert alert-danger m-3">
                            {{ $errors->first('fail') }}
                        </div>
                    @endif

                        @if ($patients->isEmpty())
                        <div class="card-body">
                            No Patients Invoices.
                        </div>
                        @else
                        <div class="card-body">
                          
                                <table id="myTable" class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;" >

                                        <th>Patient</th>
                                        <th>Invoices</th>
                                    
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($patients as $patient)
                                        <tr style="white-space: nowrap; font-size: 14px;">

                                            <td style="color: black;"><b>{{$patient->name }}</b></td>
                                            

                      
                                            <td>
                                                <a href="{{ route('invoices.show',  ['id'=>$patient['id']]) }}" class="btn btn-success btn-xs">Show Invoices</a>

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