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
                                    <tr style="white-space: nowrap; font-size: 12px;" >

                                        <th>Sample ID</th>
                                        <th>Patient Name</th>
                                        <th>Discount Reason</th>
                                        <th>Approve</th>
                                        <th>Reject</th>
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($waitingSamples as $sample)
                                        <tr style="white-space: nowrap; font-size: 12px;">
                                            <td>{{$sample->id}}</td>
                                            <td>{{ $sample->patient->name }}</td>
                                            <td>{{ $sample->discount_reason }}</td>
                                            
                                <td>
                                            <form class="d-inline" action="{{ route('samples.approve_discount_reason', ['id'=>$sample['id']]) }}" method="post">
                                                @csrf
                                                <div class="row gx-3 mb-3">

                                                <div class="col-md-6">
                                                <select name="campaign_id" id="campaign_id" class="form-select">
                                                    <option value="">Select a campaign</option>
                                                    @foreach ($campaigns as $campaign)
                                                        <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                                                    @endforeach
                                                </select></div>
                                                <div class="col-md-6">
                                                <button class="btn btn-success" type="submit">Approve</button></div>
                                            </form>
                                </td>
                                <td>
                                            <form action="{{ route('samples.reject_discount_reason', ['id'=>$sample['id']]) }}" method="post">
                                                @csrf
                                                <button class="btn btn-danger" type="submit">Reject</button>
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