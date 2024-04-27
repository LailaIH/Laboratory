@extends('common')
@section('content')

<div class="container mt-n5">

@if (session('warning'))
    <div class="alert alert-warning">{{ session('warning') }}</div>
@endif


        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <div class="card">
        <div class="card-header">Paying An Invoice</div>
        <div class="card-body">


        <form action="{{ route('invoices.pay_invoice',['id'=>$invoice['id']]) }}" method="POST">
                @csrf
                @method('PUT')
               
                <div class="row gx-3 mb-3">

                <div class="col-md-6">
                <label for="total_invoice" class="small mb-1"> Invoice Amount </label>
                
                <input type="number" id="total_invoice" name="total_invoice"  class="form-control" value="{{$invoice->remaining_amount}}" readonly />
                </div> 


                <div class="col-md-6">
                <label for="new_invoice" class="small mb-1">  Amount You Want To Pay </label>
                
                <input type="number" id="new_invoice" name="new_invoice"  class="form-control" value="{{old('new_debit')}}" required/>
                @error('new_debit')
                    {{$message}}
                @enderror
            </div> </div>



                
                <div class="col-12">
                    <br>
                <button type="submit" class="btn btn-primary btn-sm">Pay Invoice</button></div>
            </form>




        
    </div>
</div>
</div>



   
@endsection