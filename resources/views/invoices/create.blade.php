@extends('common')
@section('content')

<div class="container mt-n5">




        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <div class="card">
        <div class="card-header">Create A New Invoice</div>
        <div class="card-body">


        <form action="{{ route('invoices.store') }}" method="POST">
                @csrf
               
                <div class="row gx-3 mb-3">

                <div class="col-md-6">
                <label for="total_invoice" class="small mb-1"> Patient Name </label>

                <select name="patient_id" id="patient_id" class="form-control form-control-solid" aria-label="Default select example" required>
                    <option value="">Select a Patient</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                    @endforeach
                </select>
                @error('patient_id')
                    {{$message}}
                @enderror
            </div>

                <div class="col-md-6">
                <label for="total_invoice" class="small mb-1"> Invoice </label>
                
                <input type="number" id="total_invoice" name="total_invoice"  class="form-control" value="{{old('total_invoice')}}" required />
                @error('total_invoice')
                    {{$message}}
                @enderror
            </div> </div>

              
                
                

                
                <div class="col-12">
                   
                <button type="submit" class="btn btn-primary btn-sm">Create Invoice</button></div>
            </form>




        
    </div>
</div>
</div>



@endsection