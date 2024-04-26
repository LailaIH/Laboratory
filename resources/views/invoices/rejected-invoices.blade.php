@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

           


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List of Rejected Patients Invoices Canceling</div>
                    @if (session('success'))

                    <div class="alert alert-success m-3" role="alert">{{ session('success') }}</div>
                    @endif
                    @if ($errors->has('fail'))
                        <div class="alert alert-danger m-3">
                            {{ $errors->first('fail') }}
                        </div>
                    @endif

                        @if ($invoices->isEmpty())
                        <div class="card-body">
                            No Rejected Invoices.
                        </div>
                        @else
                        <div class="card-body">
                          
                                <table  class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;" >

                                        <th>Patient</th>
                                        <th>Invoices</th>
                                        <th>Cancel Reason</th>

                                    
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr style="white-space: nowrap; font-size: 14px;">

                                            <td style="color: black;"><b>{{$invoice->patient->name }}</b></td>
                                            

                      
                                            <td style="color: blue;">
                                                {{$invoice->total_invoice}}
                                            </td>
                                            <td>{{\Illuminate\Support\Str::limit($invoice->cancel_reason, 35)}}</td>

                                          


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>



                            </div>
                        @endif
                            
                     
                    </div>
                </div>




@endsection