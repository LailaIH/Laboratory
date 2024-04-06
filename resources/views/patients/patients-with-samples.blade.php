@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

           


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">Quotation List</div>
                    <div class="card-body">

                        @if ($patientsWithSamples->isEmpty())
                            <p>No List.</p>
                        @else
                            <div class=" mt-3 table-container">
                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <div class="card-body">
                                <table  class="table small-table-text">
                                    <thead>
                                    <tr >

                                        <th>Patient Name</th>
                                        <th>Quotation List</th>
                                    
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($patientsWithSamples as $patient)
                                        <tr>

                                            <td>{{ $patient->name }}</td>
                                            

                                            <td>
                                        <a href="{{route('patients.price_quotation',['id'=>$patient['id']])}}" class="btn btn-success">Show Price Quotation List</a>
                 
                                            </td>
                                            
                               
                          

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>



                            </div>
                        @endif
                            
                     
                    </div>
                </div>



@endsection