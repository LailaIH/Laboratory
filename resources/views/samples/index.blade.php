@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

            <div class="card">
                <div class="card-body">


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="container">
                        <h1>List Of Samples</h1>

                        @if ($samples->isEmpty())
                            <p>No Samples.</p>
                        @else
                            <div class=" mt-3 table-container">
                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                                <table  class="table table-striped">
                                    <thead>
                                    <tr >

                                        <th>Sample</th>
                                        <th>Is Online?</th>
                                        <th></th>
                                        <th>Actions</th>
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($samples as $sample)
                                        <tr>

                                            <td>Sample for   {{ $sample->patient->name }}</td>
                                            

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