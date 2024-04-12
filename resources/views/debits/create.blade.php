@extends('common')
@section('content')

<div class="container mt-n5">


@if (session('warning'))
    <div class="alert alert-warning">{{ session('warning') }}</div>
@endif

        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <div class="card">
        <div class="card-header">Create A New Debit</div>
        <div class="card-body">


        <form action="{{ route('debits.store') }}" method="POST">
                @csrf
               
                <div class="row gx-3 mb-3">

                <div class="col-md-6">
                <label for="search" class="small mb-1"> Patient Name </label>
                <input type="text" id="search" name="search" placeholder="Search" class="form-control" value="{{old('search')}}" />
                @error('search')
                    {{$message}}
                @enderror
            </div>

                <div class="col-md-6">
                <label for="debit" class="small mb-1"> Debit Amount </label>
                
                <input type="number" id="debit" name="debit"  class="form-control" value="{{old('search')}}" />
                @error('debit')
                    {{$message}}
                @enderror
            </div> </div>

                <br>
                <div class="col-12">
                    <label for="description" class="small mb-1">Debit Description</label>
                    <textarea class="form-control" id="description" name="description"  value="{{old('body')}}"> 

                    </textarea>
                 </div>  

                

                
                <div class="col-12">
                    <br>
                <button type="submit" class="btn btn-primary">Create Debit</button></div>
            </form>




        
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