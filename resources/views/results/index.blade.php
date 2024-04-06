@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

            <div class="card">
                <div class="card-body">


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="container">
                        <h1>List Of Machine Results</h1>

                        @if ($results->isEmpty())
                            <p>No Results.</p>
                        @else
                            <div class=" mt-3 table-container">
                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                                <table  class="table table-striped">
                                    <thead>
                                    <tr >

                                        <th>Result</th>
                                        <th>Is Online</th>
                                        <th></th>
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Is Approved By Admin</th>
                                        <th>Is Approved By Doctor</th>
                                        <th>Actions</th>
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($results as $result)
                                        <tr>

                                            <td>Result for   {{ $result->sample->patient->name }}</td>
                                            

                                            <td>
                        <span class="badge {{ $result->is_online ? 'badge-green' : 'badge-red' }}">
                            {{ $result->is_online ? 'Online' : 'Offline' }}
                            </span>
                 
                                            </td>
                                            <td>
                                            <form method="POST" action="{{ route('results.updateStatus', $result) }}">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-danger btn-xs">Change Status</button>

                                                </form> 
                                            </td>
                                            <td>
                                                {{$result->title}}
                                            </td>
                                            <td>
                                                {{$result->body}}
                                            </td>
                                            <td>
                                                {{$result->is_approved?'YES':'NO'}}
                                            </td>
                                            <td>
                                                {{$result->is_approved_doctor?'YES':'NO'}}
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-xs">Edit</a>

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