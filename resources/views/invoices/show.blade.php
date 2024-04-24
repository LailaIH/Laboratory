@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

           


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">Invoices List For {{$patient->name}}</div>
                    @if (session('success'))

                    <div class="alert alert-success m-3" role="alert">{{ session('success') }}</div>
                    @endif
                    @if ($errors->has('fail'))
                        <div class="alert alert-danger m-3">
                            {{ $errors->first('fail') }}
                        </div>
                    @endif

                      
                        <div class="card-body">
                          
                                <table  class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;">
                                    

                                        <th>Patient</th>
                                        <th>Invoice For Sample</th>
                                        <th>Invoice </th>
                                        
                                    
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoices as $invoice)
                                        <tr style="white-space: nowrap; font-size: 14px;">

                                            <td style="color: black;"><b>{{$patient->name}}</b></td>
                                            
                                            @if($invoice->sample_id !=null)
                                            <td>{{$invoice->sample->test->name }}</td>
                                            @else
                                            <td>No Sample Attached (invoice added by admin)</td>
                                            @endif
                                            <td style="color:green;">{{$invoice->total_invoice}}</td>

                                        </tr>
                                        @endforeach
                                   
                                    </tbody>
                                </table>

                     <h4 style="color: green;">Total : {{$total}}</h4>



                            </div>
                        
                            
                     
                    </div>
                </div>





@endsection