@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

           


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List Of Samples With No Results</div>
                    <div class="card-body">

                        @if ($samples->isEmpty())
                            <p>No Samples Without Results.</p>
                        @else
                            <div class=" mt-3 table-container">
                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            
                                <table id="myTable" class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;">

                                        <th>Sample For</th>
                                        <th>Test</th>
                                        <th></th>
                                        
                                        



                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($samples as $sample)
                                        <tr style="white-space: nowrap; font-size: 14px;">

                                            <td><b>{{ $sample->patient->name }}</b></td>
                                            

                                     
                                            <td>
                                                {{$sample->test->name}}
                                            </td>
                                            
                                            
                                            <td>
                                                <a href="{{ route('results.create', ['id' => $sample->id]) }}" class="btn btn-primary btn-sm">Add Result</a>

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