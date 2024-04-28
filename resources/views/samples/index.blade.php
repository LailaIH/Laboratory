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

                            @if (session('warning'))
                            <div class="alert alert-warning">{{ session('warning') }}</div>
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
                            
                           <div >
                            <div class="card-body">
                                <table id="myTable" class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 11.5px;" >

                                        <th>Sample</th>
                                        <th>Test</th>
                                        <th>Is Online?</th>
                                        
                                        <th>Extra Discount For This Sample</th>
                                        <th>Test's Original Discount</th>
                                        <th>Actions</th>
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($samples as $sample)
                                        <tr style="white-space: nowrap; font-size: 11.5px;">

                                            <td>Sample for   <b>{{ $sample->patient->name }}</b></td>
                                            <td>{{$sample->test->name}}</td>
                                            

                                            <td>
                                               
                                            <div class="sample-status">    
                                            <span class="badge {{ $sample->is_online ? 'badge-green' : 'badge-red' }}">
                                          {{ $sample->is_online ? 'Online' : 'Offline' }}
                                             </span>
                                             
                                             <form method="POST" action="{{ route('samples.updateStatus', $sample) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <span>
                                                    <button style="border: none;" type="submit" class="badge badge-red  ">Change</button>
                                                    </span>
                                                </form> </div>
                                            </td>
                                            
                                            <td style="color: green;"><b>{{$sample->campaign->name}}</b></td>
                                            <td style="color: green;"><b>{{$sample->test->campaign->name}}</b></td>
                                            
                                            <td>
                                                
                                                <a href="{{ route('samples.edit',  ['id'=>$sample['id']]) }}" class="btn btn-primary btn-xs">Edit</a>
                                                <a href="{{ route('samples.discount',  ['id'=>$sample['id']]) }}" class="btn btn-primary btn-xs">Request Extra Discount</a>
                                                <a href="{{ route('invoices.create_sample_invoice',  ['sampleId'=>$sample['id'] ,'patientId'=>$sample->patient->id] ) }}" class="btn btn-success btn-xs">Set Invoice</a>
                                                
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>



                            </div>
                        @endif
                            
                     
                    </div>
                </div>






<script>
    let table = new DataTable('#myTable');
</script>



@endsection