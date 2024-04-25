@extends('common')
@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>


        <!-- Main page content-->
        <div class="container mt-n5">

           


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List of Patients Debits</div>
                    @if (session('success'))

                    <div class="alert alert-success m-3" role="alert">{{ session('success') }}</div>
                    @endif
                    @if ($errors->has('fail'))
                        <div class="alert alert-danger m-3">
                            {{ $errors->first('fail') }}
                        </div>
                    @endif

                        @if ($debits->isEmpty())
                        <div class="card-body">
                            <h4>No Patients Debits.</h4>
                        </div>
                        @else
                        <div class="card-body">
                          
                                <table id="myTable" class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;" >

                                        <th>Patient</th>
                                        <th>Debit</th>
                                        <th>Description</th>
                                        <th></th>
                                    
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($debits as $debit)
                                        <tr style="white-space: nowrap; font-size: 14px;">

                                            <td style="color: black;"><b>{{$debit->patient->name }}</b></td>
                                            

                      
                                            <td>
                                                    {{$debit->debit}}
                                            </td>
                                            <td>
                                                @if($debit->description)
                                                {{$debit->description}}
                                                @endif
                                            </td>
                                            <td>
                                            <a href="{{route('debits.pay_form' , ['id'=>$debit['id']])}}" class="btn btn-primary btn-sm">
                                            Pay For Debit {{$debit->debit}} </a>
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