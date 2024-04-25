@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">



                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List Of Tests Results</div>
                    <div class="card-body">

                    @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
     

                        @if ($results->isEmpty())
                        <div class="card-body">
                            No Tests Results
                         </div>
                        @else
                            
                           <div >
                            <div class="card-body">
                                <table  class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;" >

                                        <th>Test</th>
                                        <th>Result</th>
                                         <th>Actions</th>
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($results as $result)
                                        <tr style="white-space: nowrap; font-size: 14px;">

                                            <td>Result for test  <b>{{ $result->test->name }}</b></td>
                                            <td>{{$result->result}}</td>
                                            

                            
                                            
                                            <td>
                                                
                                                
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