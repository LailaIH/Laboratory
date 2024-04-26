@extends('common')
@section('content')

<div class="container mt-n5">

@if (session('warning'))
    <div class="alert alert-warning">{{ session('warning') }}</div>
@endif


        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <div class="card">
        <div class="card-header">Paying Debit</div>
        <div class="card-body">


        <form action="{{ route('debits.pay_debit',['id'=>$debit['id']]) }}" method="POST">
                @csrf
               
                <div class="row gx-3 mb-3">

                <div class="col-md-6">
                <label for="debit" class="small mb-1"> Debit Amount </label>
                
                <input type="number" id="debit" name="debit"  class="form-control" value="{{$debit->debit}}" readonly />
                </div> 


                <div class="col-md-6">
                <label for="new_debit" class="small mb-1">  Amount You Want To Pay </label>
                
                <input type="number" id="new_debit" name="new_debit"  class="form-control" value="{{old('new_debit')}}" required/>
                @error('new_debit')
                    {{$message}}
                @enderror
            </div> </div>



                
                <div class="col-12">
                    <br>
                <button type="submit" class="btn btn-primary btn-sm">Pay Debit</button></div>
            </form>




        
    </div>
</div>
</div>



   
@endsection