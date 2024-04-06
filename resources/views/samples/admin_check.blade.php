@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

            <div class="card">
                <div class="card-body">


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="container">
                        <h1>List Of Samples</h1>

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
                            <div class=" mt-3 table-container">

                        


                                <table  class="table table-striped">
                                    <thead>
                                    <tr >

                                        <th>Sample ID</th>
                                        <th>Patient Name</th>
                                        <th>Discount Reason</th>
                                        <th>Approve</th>
                                        <th>Reject</th>
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($waitingSamples as $sample)
                                        <tr>
                                            <td>{{$sample->id}}</td>
                                            <td>{{ $sample->patient->name }}</td>
                                            <td>{{ $sample->discount_reason }}</td>
                                            
                                <td>
                                            <form class="d-inline" action="{{ route('samples.approve_discount_reason', ['id'=>$sample['id']]) }}" method="post">
                                                @csrf
                                                <select name="campaign_id" id="campaign_id" class="form-select">
                                                    <option value="">Select a campaign</option>
                                                    @foreach ($campaigns as $campaign)
                                                        <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button class="btn btn-success" type="submit">Approve</button>
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