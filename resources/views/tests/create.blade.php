@extends('common')
@section('content')

<div class="container mt-n5">




        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <div class="card">
        <div class="card-header">Create A New Test</div>
        <div class="card-body">


        <form action="{{ route('tests.store') }}" method="POST" >
                @csrf
                
                <div class="row gx-3 mb-3">

                <div class="col-md-6">
               <label class="small mb-1" for="name" class="form-label">  Name </label>
                <input type="text" id="name" name="name" placeholder="name" class="form-control" value="{{old('name')}}" required />
                @error('name')
                   {{$message}}
                    @enderror
            </div>

                <div class="col-md-6">
                <label class="small mb-1" for="department_id" class="form-label">Department</label>
                <select name="department_id" id="department_id" class="form-select" class="form-control form-control-solid" aria-label="Default select example" required>
                    <option value="">Select a Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                    @error('department_id')
                         {{$message}}
                    @enderror
                </select>
                </div> </div>

                <div class="row gx-3 mb-3">

                <div class="col-md-6">
                <label class="small mb-1" for="group_id" class="form-label">Group</label>
                <select name="group_id" id="group_id" class="form-select" class="form-control form-control-solid" aria-label="Default select example" required>
                    <option value="">Select a Group</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                    @error('group_id')
                         {{$message}}
                    @enderror
                </select>
                </div>


                <div class="col-md-6">
                <label for="price" class="small mb-1">Total Price</label>
                <input class="form-control" id="price" name="price" type="number"  value="{{ old('price') }}" required>
                @error('price')
                         {{$message}}
                    @enderror
            </div></div> 

            <div class="col-12">
                <label class="small mb-1" for="campaign_id" class="form-label">Campaign</label>
                <select name="campaign_id" id="campaign_id" class="form-select" class="form-control form-control-solid" aria-label="Default select example" required>
                    <option value="">Select a Campaign</option>
                    @foreach ($campaigns as $campaign)
                        <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                    @endforeach
                    @error('campaign_id')
                         {{$message}}
                    @enderror
                </select>
                </div>





                <div class="col-12 mt-3">
                
                <button type="submit" class="btn btn-primary btn-sm">Create Test</button></div>
            </form>









       
    </div>
</div>
</div>









@endsection