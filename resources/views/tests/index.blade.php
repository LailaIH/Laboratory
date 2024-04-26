@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

           


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="card">
                    <div class="card-header">List Of Tests</div>
                    <div class="card-body">

                        @if ($tests->isEmpty())
                        <div class="card-body">
                         
                            No Tests Yet
                        
                         
                        @else
                            <div class=" mt-3 table-container">
                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('warning'))
                            <div class="alert alert-warning">{{ session('warning') }}</div>
                            @endif
                            
                                <table id="myTable" class="table small-table-text">
                                    <thead>
                                    <tr style="white-space: nowrap; font-size: 14px;">

                                        <th>Test</th>
                                        <th>Campaign</th>
                                        
                                        <th>Original Price</th>
                                        <th>Group</th>
                                        <th>Department</th>
                                       

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($tests as $test)
                                        <tr style="white-space: nowrap; font-size: 14px;">

                                            <td><b>{{ $test->name }}</b></td>
                                            <td style="color: green;"><b>{{ $test->campaign->name}}</b></td>
                                            <td style="color: blue;">{{ $test->price }}</td>
                                            <td>{{ $test->group->name }}</td>
                                            <td>{{ $test->department->name }}</td>
                                

                                              
                                      

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