@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

        <div class="card">
        <div class="card-header">Reason For Extra Discount Request</div>
            

                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="container">
                    <div class="card-body">
                    <form action="{{ route('samples.store_reason' , ['id'=>$sample['id']]) }}" method="POST">
                            @csrf
                            
                            <div class="col-8">
                            <input class="form-control" type="text" name="discount_reason" placeholder="Discount Reason">
                            </div>
                            <div class="col-12 mt-3">
                            <button class="btn btn-primary btn-sm" type="submit">Submit</button></div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection