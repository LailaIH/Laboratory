@extends('common')
@section('content')

<div class="container mt-n5">




        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <div class="card">
        <div class="card-header">Create A New Sample</div>
        <div class="card-body">


        <form action="{{ route('samples.store') }}" method="POST" >
                @csrf
               
                <div class="row gx-3 mb-3">

                <div class="col-md-6">
               <label for="search" class="small mb-1"> Patient Name </label>
                <input type="text" id="search" name="search" placeholder="Search" class="form-control" value="{{old('search')}}"  required/>
                @error('search')
                    {{$message}}
                @enderror
            
            </div>

                <div class="col-md-6">
                <label for="branch_id" class="small mb-1">Branch</label>
                <select name="branch_id" id="branch_id" class="form-control form-control-solid" aria-label="Default select example" required>
                    <option value="">Select a Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
                @error('branch_id')
                    {{$message}}
                @enderror
                </div>
            </div> 
            <br> 

                <div class="row gx-3 mb-3">
                <br>
                <div class="col-md-6">
                    <label for="doctor" class="small mb-1">Doctor</label>
                    <select name="doctor_id" id="doctor_id" class="form-control form-control-solid" aria-label="Default select example" required>
                    <option value="">Select a Doctor</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                 
                </select>
                @error('doctor_id')
                    {{$message}}
                @enderror
                </div>


                <div class="col-md-6">
                    <label for="payment" class="small mb-1">Payment Type</label>
                    <select name="payment_id" id="payment_id" class="form-control form-control-solid" aria-label="Default select example" required>
                    <option value="">Select a Payment Type</option>
                    @foreach ($payments as $payment)
                        <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                    @endforeach
                </select>
                @error('payment_id')
                    {{$message}}
                @enderror
                </div></div>
                <br>
             <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <label for="institu_id" class="small mb-1">Institute</label>
                    <select name="institute_id" id="institu_id" class="form-control form-control-solid" aria-label="Default select example" required>
                    <option value="">Select an Institute</option>
                    @foreach ($institutes as $institute)
                        <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                    @endforeach
                </select>
                @error('institu_id')
                    {{$message}}
                @enderror
                </div>     

              

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
                </div> </div>

                <br>

                <div class="row gx-3 mb-3">
                <div class="col-md-4">
                    <label for="admission" class="small mb-1">Admission Date</label>
                    <input type="date" class="form-control" id="admission" name="admission" value="{{ old('admission') }}" required>
                    @error('test_id')
                    {{$message}}
                @enderror
                </div>   
                
                <div class="col-md-4">
                    <label for="period" class="small mb-1">Pregenant Women Only! enter last period date</label>
                    <input placeholder="yy-mm-dd" type="date" class="form-control" id="period" name="period" value="{{ old('period') }}">
                </div> 

                <div class="col-md-4">
                    <label for="today" class="small mb-1">Enter today's date</label>
                    <input placeholder="yy-mm-dd" type="date" class="form-control" id="today" name="today" value="{{ old('today') }}">
                </div> </div>

                <br>
                <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <label for="notes" class="small mb-1">Patient's Notes</label>
                    <textarea class="form-control" id="notes" name="notes"  value="{{old('notes')}}" required> 

                   
                </textarea>
                @error('notes')
                    {{$message}}
                @enderror
            </div>     
                 
                

                <div class="col-md-6">
                    <label for="gross_amount" class="small mb-1">Gross Amount</label>
    
                    <input class="form-control" id="gross_amount" name="gross_amount" type="number"  value="{{ old('gross_amount') }}" required>
                    @error('gross_amount')
                    {{$message}}
                @enderror
                
                </div>     </div>  
                
                <br>
                <div class="row gx-3 mb-3">
                <div class="col-md-6">
                    <label for="paid_amount" class="small mb-1">Paid Amount</label>
                    <input class="form-control" id="paid_amount" name="paid_amount" type="number"  value="{{ old('paid_amount') }}" required>
                    @error('paid_amount')
                    {{$message}}
                @enderror
                </div>   
                
                               

                <div class="col-md-6">
                    <label for="money_note" class="small mb-1">Money Notes</label>
                    <textarea class="form-control" id="money_note" name="money_note"  value="{{old('money_note')}}" required> 

                    </textarea>
                 
                    @error('money_note')
                    {{$message}}
                @enderror
                </div> </div>
              
           
                
                <div class="col-12">
                    <br>
                <button type="submit" class="btn btn-primary">Create Sample</button>
                </div>
            </form>









        </div>
   
</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>
    <script type="text/javascript">
        var route = "{{ url('autocomplete-search') }}";
        $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    </script>






@endsection