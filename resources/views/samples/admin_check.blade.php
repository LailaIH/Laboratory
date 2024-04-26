@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

            


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List Of Waiting Samples</div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('warning'))
                            <div class="alert alert-warning">{{ session('warning') }}</div>
                            @endif

                            @if ($errors->has('fail'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('fail') }}
                                </div>
                            @endif

                        @if ($waitingSamples->isEmpty())
                            <p>No Waiting Samples.</p>
                        @else
                            

                                <table  class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;" >

                                        <th>Sample ID</th>
                                        <th>Patient Name</th>
                                        <th>Discount Reason</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($waitingSamples as $sample)
                                        <tr style="white-space: nowrap; font-size: 14px;">
                                            <td>{{$sample->id}}</td>
                                            <td>{{ $sample->patient->name }}</td>
                                            <td>{{ $sample->discount_reason }}</td>
                                            
                                <td>
                                
                                         
                                            <form class="d-inline" action="{{ route('samples.approve_discount_reason', ['id'=>$sample['id']]) }}" method="post">
                                                @csrf
                                                
                                                
                                                
                                                <select name="campaign_id" id="campaign_id" class="form-select" >
                                                    <option value="">Select a campaign</option>
                                                    @foreach ($campaigns as $campaign)
                                                        <option value="{{ $campaign->id }}" @if ($sample->test->campaign_id == $campaign->id) selected @endif>{{ $campaign->name }}</option>
                                                    @endforeach
                                                </select></td>
                                                <td>
                                                
                                                <button class="btn btn-success btn-sm" type="submit">Approve</button>
                                                
                                            </form></td>
                                            
                                            <td>
                                            <form action="{{ route('samples.reject_discount_reason', ['id'=>$sample['id']]) }}" method="post">
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type="submit">Reject</button>
                                            </form></td>
                                        
                                
                                         


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>



                            </div>
                        @endif
                            
                     
                    </div>
                </div>










@endsection