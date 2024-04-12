@extends('common')
@section('content')

<div class="container mt-n5">




        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        
        @if ($errors->has('fail'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('fail') }}
                                </div>
        @endif

        <div class="card">
             <div class="card-header">Entering Results For Patient</div>
            <div class="card-body">


        <form action="{{ route('results.find_samples') }}" method="POST" class="row g-3">
                @csrf
                <div class="row gx-3 mb-3">
                    <br>
                <label for="search" class="form-label"> Enter The Patient Name To find Their Sample/s </label>

                <div class="col-md-6">
                <input type="text" id="search" name="search" placeholder="Search" class="form-control" value="{{old('search')}}" />
                </div>


                
                <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Find Samples</button></div></div>
            </form>

            @if(isset($samples) && $samples->isNotEmpty())
            @foreach($samples as $sample)
            <br>
                <a class="btn btn-success" href="{{ route('results.create', ['id' => $sample->id]) }}">
                    Enter Machine Results For Sample {{ $sample->test->name }} Test Of Patient {{ $sample->patient->name }}
                </a>
                <br>
            @endforeach
            @else
            @if(!$view)
            
            <div class="alert alert-warning" role="alert">
            Results of the samples of this patient have been entered
            </div>
            @endif
            @endif






        
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>
    <script type="text/javascript">
        var route = "{{ url('autocomplete-search') }}";
        $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    </script>



@endsection