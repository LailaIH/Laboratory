@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">
        @if (session('warning'))

        <div class="alert alert-warning m-3" role="alert">{{ session('warning') }}</div>
        @endif

            <div class="card">
            <div class="card-header">Reason For Cancek Request</div>
                


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="container">
                    <div class="card-body">
                    <form action="{{ route('invoices.store_cancel_reason' , ['id'=>$invoice['id']]) }}" method="POST">
                            @csrf
                            <div class="row">
                            <div class="col-md-6">
                            <input class="form-control" type="text" id='cancel_reason' name="cancel_reason" placeholder="Invoice canceling reason" value="{{old('cancel_reason')}}" required>
                                    @error('total_invoice')
                                     {{$message}}
                                    @enderror</div>
                                 <div class="col-md-6">
                                    
                            <button class="btn btn-success" type="submit">Submit</button></div></div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection