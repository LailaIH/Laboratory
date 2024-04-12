@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

           


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List Of Test And Third Parties Attachements</div>
                    <div class="card-body">

                        @if ($test_thirdparties->isEmpty())
                        <div class="card-body">
                         <form method="GET" action="{{route('test_thirdparies.create')}}">
                             <div class="col-md-6">
                             <label class="small mb-1 mr-8" for="max_products">No Attached Tests With Third Parties</label>
                             <div><br>
                             <button type="submit" class="btn btn-primary btn-xs">Attcah Test With A Third Party</button></div>
                             </div>
                         </form>
                         </div>
                        @else
                            <div class=" mt-3 table-container">
                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            
                                <table  class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 12px;">

                                        <th>Test</th>
                                        <th>Third Party</th>
                                        
                                        <th>Given Time</th>
                                       

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($test_thirdparties as $attachment)
                                        <tr style="white-space: nowrap; font-size: 12px;">

                                            <td>{{ $attachment->test->name }}</td>
                                            <td>{{ $attachment->thirdparty->name }}</td>
                                            <td>{{ $attachment->given_time }}</td>
                                

                                              
                                      

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>



                            </div>
                        @endif
                            
                     
                    </div>
                </div>




@endsection