@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

            <div class="card">
                <div class="card-body">


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="container">
                        <h1>List Of  Samples With No Discounts</h1>

                        @if ($noDiscountSamples->isEmpty())
                            <p>No Samples Without Discounts.</p>
                        @else
                            <div class=" mt-3 table-container">
                                <table  class="table table-striped">
                                    <thead>
                                    <tr >

                                        <th>Sample</th>
                                        <th>Is Online?</th>
                                        <th>Actions</th>
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($noDiscountSamples as $sample)
                                        <tr>

                                            <td> Sample for   {{ $sample->patient->name }}</td>
                                            

                           
                  
                                            <td>
                                                <a href="{{ route('samples.edit',  ['id'=>$sample['id']]) }}" class="btn btn-primary">
                                                    Edit
                                                </a>
                                                
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