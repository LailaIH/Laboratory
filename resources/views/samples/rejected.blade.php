@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

           


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List Of Rejected Samples</div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if ($errors->has('fail'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('fail') }}
                                </div>
                            @endif

                        @if ($rejectedSamples->isEmpty())
                            <p>No Rejected Samples.</p>
                        @else
                           

                        


                                <table  class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;" >

                                        <th>Sample ID</th>
                                        <th>Patient Name</th>
                                        <th>Discount Reason</th>
                                        <th>Action</th>
                                        
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($rejectedSamples as $sample)
                                        <tr style="white-space: nowrap; font-size: 14px;">
                                            <td>{{$sample->id}}</td>
                                            <td>{{ $sample->patient->name }}</td>
                                            <td>{{ $sample->discount_reason }}</td>
                                            
                                <td>
                                <a href="{{ route('samples.discount',  ['id'=>$sample['id']]) }}" class="btn btn-primary btn-xs">Request Extra Discount</a>
  
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