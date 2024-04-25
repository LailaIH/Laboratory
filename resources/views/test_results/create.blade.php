@extends('common')
@section('content')

<div class="container mt-n5">




        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <div class="card">
        <div class="card-header">Create A New Test-Result  Attachment</div>
        <div class="card-body">


        <form action="{{ route('test_results.store') }}" method="POST" >
                @csrf
               
                <div class="row gx-3 mb-3">

              

                <div class="col-md-6">
                <label for="test_id" class="small mb-1">Test</label>
                <select name="test_id" id="test_id" class="form-control form-control-solid" aria-label="Default select example" required>
                    <option value="">Select a Test</option>
                    @foreach ($tests as $test)
                        <option value="{{ $test->id }}">{{ $test->name }}</option>
                    @endforeach
                </select>
                @error('test_id')
                    {{$message}}
                @enderror
                </div>
          
                <div class="col-md-6">
                    <label for="thirdparty_id" class="small mb-1">Result</label>
                    <input name="result" id="result" class="form-control" value="{{old('result')}}" required/>
                @error('result')
                    {{$message}}
                @enderror
                </div></div>


                


    
                <div class="col-12">
                    <br>
                <button type="submit" class="btn btn-primary">Create Result</button>
                </div>
            </form>









        </div>
   
</div>
</div>


@endsection