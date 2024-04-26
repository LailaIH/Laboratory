@extends('common')
@section('content')

<div class="container mt-n5">




        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <div class="card">
        <div class="card-header">Edit Test-Result  Attachment</div>
        <div class="card-body">


        <form action="{{ route('test_results.update',['id'=>$testResult['id']]) }}" method="POST" >
                @csrf
                @method('PUT')
               
                <div class="row gx-3 mb-3">

              

                <div class="col-md-6">
                <label for="test_id" class="small mb-1">Test</label>
                <select name="test_id" id="test_id" class="form-control form-control-solid" aria-label="Default select example" required>
                    <option value="">Select a Test</option>
                    @foreach ($tests as $test)
                        <option value="{{ $test->id }}" @if($testResult->test_id==$test->id) selected @endif>{{ $test->name }}</option>
                    @endforeach
                </select>
                @error('test_id')
                    {{$message}}
                @enderror
                </div>
          
                <div class="col-md-6">
                    <label for="thirdparty_id" class="small mb-1">Result</label>
                    <input name="result" id="result" class="form-control" value="{{$testResult->result}}" required/>
                @error('result')
                    {{$message}}
                @enderror
                </div></div>


                


    
                <div class="col-12">
                    
                <button type="submit" class="btn btn-primary btn-sm">Edit Result</button>
                </div>
            </form>









        </div>
   
</div>
</div>


@endsection