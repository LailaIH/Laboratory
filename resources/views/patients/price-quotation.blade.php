@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

           


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">Quotation Price</div>
                    <div class="card-body">

                        @if ($samples->isEmpty())
                            <p>No Quotation List.</p>
                        @else
                            <div class=" mt-3 table-container">
                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <div class="card-body">
                                <table  class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;" >

                                        <th>Patient Name</th>
                                        <th>Patient Age</th>
                                        <th>Sample Institute</th>
                                        <th>Test Name</th>
                                        <th>Original Test Discount</th>
                                        <th>Sample Extra Discount</th>
                                        <th>Patient's Notes</th>
                                    
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($samples as $sample)
                                        <tr style="white-space: nowrap; font-size: 14px;">

                                            <td style="color: black;"><b>{{ $patient->name }}</b></td>
                                            <td style="color: blue;">{{ $patient->age }}</td>
                                            <td>{{ $sample->institu->name }}</td>
                                            <td>{{ $sample->test->name }}</td>
                                            <td style="color: blue;">{{ $sample->test->campaign->name }}</td>
                                            <td style="color: blue;">{{ $sample->campaign->name }}</td>
                                            
                                            <td>{{ \Illuminate\Support\Str::limit($sample->pation_note, 35) }}</td>

                                     

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>



                            </div>
                        @endif
                            
                     
                    </div>
                </div>



@endsection