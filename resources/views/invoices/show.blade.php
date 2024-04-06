@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

           


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">Invoice</div>
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
                                    <tr >

                                        <th>Total Invoice For Samples</th>
                                        <th>Total Debits</th>
                                    
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr>

                                            <td>{{$totalSamples }}</td>
                                            

                      
                                            
                                            <td>{{$totalDebits }}</td>
                                            

                                        </tr>
                                   
                                    </tbody>
                                </table>

                                @if(!$debits->isEmpty())
                                <br>
                                <div ><b>Patient's Debits :</b></div>
                                <br>
                                <ul>
                                @foreach($debits as $debit)
                                <il>
                                    <a href="{{route('debits.pay_form' , ['id'=>$debit['id']])}}" >
                               <p> {{$debit->description}}</p></il>
                                   </a>
                                @endforeach
                                </ul>

                                @endif



                            </div>
                        
                            
                     
                    </div>
                </div>





@endsection