@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

            


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                   
                    <div class="card">
                    <div class="card-header">List Of Rejected Results By Doctor </div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            
                        @if (session('warning'))
                            <div class="alert alert-success">{{ session('warning') }}</div>
                            @endif

                        @if ($rejectedResults->isEmpty())
                            <p>No Results.</p>
                        @else
                           
                        
                                <table  class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;" >

                                        <th>Result</th>
                                        
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th> Rejection Reason </th>
                                        <th> </th>
                                        
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($rejectedResults as $result)
                                        <tr style="white-space: nowrap; font-size: 14px;">

                                            <td>Result for   {{ $result->sample->patient->name }}</td>
                                            

                            
                                          
                                            <td>
                                                {{$result->title}}
                                            </td>
                                            <td>
                                                {{$result->body}}
                                            </td>
                                            <td>{{$result->doctor_reason}}</td>
                                            <td>
                                              <form action="{{ route('results.destroy', ['id'=>$result['id']]) }}" method="POST" class="d-inline">
                                              @csrf
                                              @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete And Re-enter Result</button>
                                                    </form> </td>
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