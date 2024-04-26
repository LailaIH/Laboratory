@extends('common')
@section('content')

<div class="container mt-n5">


    @if (session('warning'))
     <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif




        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <div class="card">
        <div class="card-header">Create A New Result</div>
        <div class="card-body">
        @if($warningMessage)
    <div class="alert alert-warning">
        {{ $warningMessage }} <a href="{{route('test_results.create')}}"> here</a>
    </div>
@endif

        <form action="{{ route('results.store' , ['id'=>$sample['id']]) }}" method="POST" class="row g-3">
                @csrf
                
                <p>Create A New Result For {{$sample->patient->name}} Of the test {{$sample->test->name}}</p>
                <div class="row gx-3 mb-3">
                <div class="col-md-6">
               <label for="title" class="form-label"> Title </label>
                <input type="text" id="title" name="title" placeholder="result title" class="form-control" value="{{old('title')}}" />
                </div>


                <div class="col-md-6">
                    <label for="body" class="form-label">Result</label>
                    <select name="body" id="body" class="form-select" required>
                    <option value="">Select a Result</option>
                    @foreach ($results as $result)
                        <option value="{{ $result->result }}">{{ $result->result }}</option>
                    @endforeach
                </select>
                @error('body')
                    {{$message}}
                @enderror
                </div> </div>

                <div class="row gx-3 mb-3">
                    <div class="col-12">
                 <label for="status" class="form-label"> Status </label>
                <input type="text" id="status" name="status" placeholder="result status" class="form-control" value="{{old('status')}}" required />
                @error('status')
                    {{$message}}
                @enderror
            </div></div>


    
            <div class="col-12">
                            <label for="is_online">Is Online</label>
                            <input class="ml-4" name="is_online" id="is_online" type="checkbox">

                               
                        </div>


                
                <div class="col-12">
                <button type="submit" class="btn btn-primary btn-sm">Submit Result</button></div>
            </form>




        
    </div>
</div>
</div>



@endsection