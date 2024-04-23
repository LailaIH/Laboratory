@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">



                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List Of Samples</div>
                    <div class="card-body">

                    @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                        @if ($samples->isEmpty())
                        <div class="card-body">
                         <form method="GET" action="{{route('samples.create')}}">
                             <div class="col-md-6">
                             <label class="small mb-1 mr-5" for="max_products">No Samples</label>
                             <button type="submit" class="btn btn-primary btn-xs">Add Sample</button>
                             </div>
                         </form>
                         </div>
                        @else
                            
                           
                            <div class="card-body">
                                <table  class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 12px;" >

                                        <th>Sample</th>
                                        <th>Test</th>
                                        <th>Is Online?</th>
                                        <th></th>
                                        <th>Extra Discount For This Sample</th>
                                        <th>Test's Original Discount</th>
                                        <th>Actions</th>
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($samples as $sample)
                                        <tr style="white-space: nowrap; font-size: 12px;">

                                            <td>Sample for   <b>{{ $sample->patient->name }}</b></td>
                                            <td>{{$sample->test->name}}</td>
                                            

                                            <td>
                                            <span class="badge {{ $sample->is_online ? 'badge-green' : 'badge-red' }}">
                                          {{ $sample->is_online ? 'Online' : 'Offline' }}
                                             </span>
                 
                                            </td>
                                            <td>
                                            <form method="POST" action="{{ route('samples.updateStatus', $sample) }}">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-danger btn-xs">Change Status</button>

                                                </form> 
                                            </td>
                                            <td>{{$sample->campaign->name}}</td>
                                            <td>{{$sample->test->campaign->name}}</td>
                                            <td>
                                                <a href="{{ route('samples.edit',  ['id'=>$sample['id']]) }}" class="btn btn-primary btn-xs">Edit</a>
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