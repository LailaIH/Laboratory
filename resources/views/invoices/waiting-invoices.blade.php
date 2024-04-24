@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

           


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List of waiting invoices</div>
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
                            No Waiting Invoices
                        </div>
                        @else
                        <div class="card-body">
                          
                                <table  class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;" >

                                        <th>Patient</th>
                                        <th>Invoices</th>
                                        <th>Cancel Reason</th>
                                        <th></th>
                                        <th></th>

                                    
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr style="white-space: nowrap; font-size: 14px;">

                                            <td style="color: black;"><b>{{$invoice->patient->name }}</b></td>
                                            

                      
                                            <td>
                                                {{$invoice->total_invoice}}
                                            </td>
                                            <td>{{$invoice->cancel_reason}}</td>

                                            <td>
                                                <button class="no-button-style" onclick="return confirm('Are you sure you want to cancel this invoice?')">
                                            <a href="{{ route('invoices.cancel',  ['id'=>$invoice['id']]) }}" class="btn btn-success btn-xs">Cancel Invoice</a>
                                                </button>
                                            </td>

                                            <td>
                                            <a href="{{ route('invoices.reject',  ['id'=>$invoice['id']]) }}" class="btn btn-danger btn-xs">Reject Invoice</a>

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