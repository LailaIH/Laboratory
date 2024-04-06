@extends('common')
@section('content')

<div class="container mt-n5">

<div class="card">
    <div class="card-body">


        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <div class="container">


        <form action="{{ route('results.store' , ['id'=>$sample['id']]) }}" method="POST" class="row g-3">
                @csrf
                <p>Create A New Result</p>
                <div class="col-md-6">
               <label for="title" class="form-label"> Title </label>
                <input type="text" id="title" name="title" placeholder="result title" class="form-control" value="{{old('title')}}" />
                </div>


                <div class="col-12">
                    <label for="body" class="form-label">Body</label>
                    <textarea id="body" name="body" rows="4" cols="5" value="{{old('body')}}"> 

                    </textarea>
                 </div> 
                    <div class="col-12">
                 <label for="status" class="form-label"> Status </label>
                <input type="text" id="status" name="status" placeholder="result status" class="form-control" value="{{old('status')}}" />
                </div>


    
                        <div class="form-group">
                            <input name="is_online" id="is_online" type="checkbox">
                            <label for="is_online">Is Online</label>
                            
                               
                        </div>


                
                <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit Result</button></div>
            </form>




        </div>
    </div>
</div>
</div>



@endsection