@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

          


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List Of Results For Doctor Approval</div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if ($errors->has('fail'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('fail') }}
                                </div>
                            @endif

                        @if ($notApprovedResults->isEmpty())
                            <p>No Results.</p>
                        @else
                           
                       
                                <table  class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;" >

                                        <th>Result</th>
                                        
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Approve</th>
                                        
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($notApprovedResults as $result)
                                        <tr style="white-space: nowrap; font-size: 14px;">

                                            <td>Result for   {{ $result->sample->patient->name }}</td>
                                            

                            
                                          
                                            <td>
                                                {{$result->title}}
                                            </td>
                                            <td>
                                                {{$result->body}}
                                            </td>
                                            <td>
                                                <form action="{{ route('results.doctor_approve', ['id'=>$result['id']]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Approve</button>
                                                    </form>
                                            </td>

                                            <td>
                                                    <form action="{{ route('results.doctor_reject', ['id'=>$result['id']]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <div class="row gx-3 mb-3">
                                                        <div class="col-md-6">
                                                        <textarea class="form-control" placeholder="enter rejection reason" name="reason"></textarea>
                                                        @error('reason')
                                                            {{$message}}
                                                        @enderror</div>
                                                        <div class="col-md-6">
                                                        <button type="submit" class="btn btn-danger">Reject</button></div></div>
                                                    </form> </td>

                     

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>



                            </div>
                        @endif
                            
                     
                    </div>
                </div>

@endsection