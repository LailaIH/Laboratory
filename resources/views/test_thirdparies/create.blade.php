@extends('common')
@section('content')

<div class="container mt-n5">




        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <div class="card">
        <div class="card-header">Create A New Test-Third Party Attachment</div>
        <div class="card-body">


        <form action="{{ route('test_thirdparies.store') }}" method="POST" >
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
                    <label for="thirdparty_id" class="small mb-1">Third Party</label>
                    <select name="thirdparty_id" id="thirdparty_id" class="form-control form-control-solid" aria-label="Default select example" required>
                    <option value="">Select a Third Party</option>
                    @foreach ($thirdparties as $thirdparty)
                        <option value="{{ $thirdparty->id }}">{{ $thirdparty->name }}</option>
                    @endforeach
                 
                </select>
                @error('thirdparty_id')
                    {{$message}}
                @enderror
                </div></div>


                <div class="col-12">
               <label for="given_time" class="small mb-1"> Given Time </label>
                <input type="text" id="given_time" name="given_time" placeholder="given time" class="form-control" value="{{old('given_time')}}" />
                @error('given_time')
                    {{$message}}
                @enderror
            
            </div>


    
                <div class="col-12 mt-3">
                    
                <button type="submit" class="btn btn-primary btn-sm">Create Attachment</button>
                </div>
            </form>









        </div>
   
</div>
</div>










@endsection