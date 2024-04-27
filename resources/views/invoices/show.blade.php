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

                    @if (session('warning'))

                    <div class="alert alert-warning m-3" role="alert">{{ session('warning') }}</div>
                    @endif

                    @if ($errors->has('fail'))
                        <div class="alert alert-danger m-3">
                            {{ $errors->first('fail') }}
                        </div>
                    @endif

                      
                        <div class="card-body">
                          
                                <table  class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 12px;">
                                    

                                        <th>Patient</th>
                                        <th>Invoice For Sample</th>
                                        <th>Invoice </th>
                                        <th>Paid Amount</th>
                                        <th>Remaining Amount</th>
                                        <th>Paying Status</th>
                                        <th>Is Online</th>
                                        <th></th>
                                        
                                    
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoices as $invoice)
                                        <tr style="white-space: nowrap; font-size: 12px;">

                                            <td style="color: black;"><b>{{$patient->name}}</b></td>
                                            
                                            @if($invoice->sample_id !=null)
                                            <td>{{$invoice->sample->test->name }}</td>
                                            @else
                                            <td>No Sample Attached(Debit)</td>
                                            @endif
                                            <td style="color:green;">{{$invoice->total_invoice}}</td>
                                            <td style="color:green;">{{$invoice->paid_amount}}</td>
                                            <td style="color:green;">{{$invoice->remaining_amount}}</td>
                                            <td style="color:green;">{{$invoice->paying_status}}</td>
                                            <td>
                                            <span class="badge {{ $invoice->is_online ? 'badge-green' : 'badge-red' }}">
                                          {{ $invoice->is_online ? 'Online' : 'Offline' }}
                                             </span>
                 
                                            </td>
                                            <td>
                                            @if($invoice->is_online)
                                            <a href="{{ route('invoices.cancel_request',  ['id'=>$invoice['id']]) }}" class="btn btn-primary btn-xs">Request Invoice Cancel</a>
                                            <a href="{{ route('invoices.pay_form',  ['id'=>$invoice['id']]) }}" class="btn btn-primary btn-xs ml-5">Pay For Invoice</a>
                                            <a href="#" class="btn btn-primary btn-xs ml-5">Edit</a>
                                            @endif

                                            </td>
                                            <td>

                                            </td>
                                            

                                            

                                        </tr>
                                        @endforeach
                                   
                                    </tbody>
                                </table>

                     <h4 style="color: green;">Total : {{$total}}</h4>



                            </div>
                        
                            
                     
                    </div>
                </div>





@endsection