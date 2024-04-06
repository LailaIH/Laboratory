@extends('common')
@section('content')

<div class="container mt-n5">

<div class="card">
    <div class="card-body">


        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <div class="container">
        @if ($errors->has('fail'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('fail') }}
                                </div>
        @endif


        <form action="{{ route('results.find_samples') }}" method="POST" class="row g-3">
                @csrf
                <p>Enter The Patient Name To find Their Sample/s</p>
                <div class="col-md-6">
               <label for="search" class="form-label"> Patient Name </label>
                <input type="text" id="search" name="search" placeholder="Search" class="form-control" value="{{old('search')}}" />
                </div>




                
                <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Find Samples</button></div>
            </form>

            @if(isset($samples) && $samples->isNotEmpty())
            @foreach($samples as $sample)
            <br>
                <a href="{{ route('results.create', ['id' => $sample->id]) }}">
                    Enter Machine Results For Sample {{ $sample->group->name }} Of Patient {{ $sample->patient->name }}
                </a>
            @endforeach
            @else
            <p>Results of the samples of this patient have been entered</p>
            @endif






        </div>
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