@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

            <div class="card">
                <div class="card-body">


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="container">
                        <h1>List Of Results For Admin Approval</h1>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                        @if ($notApprovedResults->isEmpty())
                            <p>No Results.</p>
                        @else
                            <div class=" mt-3 table-container">
                        
                                <table  class="table table-striped">
                                    <thead>
                                    <tr >

                                        <th>Result</th>
                                        
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Approve</th>
                                        
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($notApprovedResults as $result)
                                        <tr>

                                            <td>Result for   {{ $result->sample->patient->name }}</td>
                                            

                            
                                          
                                            <td>
                                                {{$result->title}}
                                            </td>
                                            <td>
                                                {{$result->body}}
                                            </td>
                                            <td>
                                                <form action="{{ route('results.admin_approve', ['id'=>$result['id']]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Approve</button>
                                                    </form>
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