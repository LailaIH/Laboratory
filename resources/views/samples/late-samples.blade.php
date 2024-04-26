@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">



                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List Of Late Samples</div>
                    <div class="card-body">

                    @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                        @if (empty($lateSamples))
                        
                       
                            
                           <p>  No Late Samples</p>
                             
                        
                         
                        @else
                            
                           
                            <div class="card-body">
                                <table  class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 12px;" >

                                        <th>Sample</th>
                                        <th>Test</th>
                                        <th>Is Online?</th>
                                       
                                        
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($lateSamples as $sample)
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
                                             </tr>
                                    @endforeach
                                    </tbody>
                                </table>



                            </div>
                        @endif
                            
                     
                    </div>
                </div>





@endsection