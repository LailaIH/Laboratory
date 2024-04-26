@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">
        @if (session('warning'))

        <div class="alert alert-warning m-3" role="alert">{{ session('warning') }}</div>
        @endif

            <div class="card">
            <div class="card-header">Reason For Invoice Canceling Request</div>
                


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="container">
                    <div class="card-body">
                    <form action="{{ route('invoices.store_cancel_reason' , ['id'=>$invoice['id']]) }}" method="POST">
                            @csrf
                            
                            <div class="col-md-8">
                            <input class="form-control" type="text" id='cancel_reason' name="cancel_reason" placeholder="Invoice canceling reason" value="{{old('cancel_reason')}}" required>
                                    @error('total_invoice')
                                     {{$message}}
                                    @enderror</div>
                                 <div class="col-12 mt-3">
                                    
                            <button class="btn btn-danger btn-sm" type="submit">Submit</button></div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection