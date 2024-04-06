@extends('common')
@section('content')


        <!-- Main page content-->
        <div class="container mt-n5">

            <div class="card">
                <div class="card-body">


                    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

                    <div class="container">
                    <form action="{{ route('samples.store_reason' , ['id'=>$sample['id']]) }}" method="POST">
                            @csrf
                            
                            <input class="form-control" type="text" name="discount_reason" placeholder="Discount Reason">
                            <br>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection