@extends('common')
@section('content')

<div class="container mt-n5">

<div class="card">
    <div class="card-body">


        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <div class="container">


        <form action="{{ route('samples.store') }}" method="POST" class="row g-3">
                @csrf
                <p>Create A New Sample</p>
                <div class="col-md-6">
               <label for="search" class="form-label"> Patient Name </label>
                <input type="text" id="search" name="search" placeholder="Search" class="form-control" value="{{old('search')}}" />
                </div>

                <div class="col-md-6">
                <label for="branch_id" class="form-label">Branch</label>
                <select name="branch_id" id="branch_id" class="form-select">
                    <option value="">Select a Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
                </div>

                <div class="col-12">
                    <label for="doctor" class="form-label">Doctor</label>
                    <select name="doctor_id" id="doctor_id" class="form-select">
                    <option value="">Select a Doctor</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
                </div>


                <div class="col-12">
                    <label for="payment" class="form-label">Payment Type</label>
                    <select name="payment_id" id="payment_id" class="form-select">
                    <option value="">Select a Payment Type</option>
                    @foreach ($payments as $payment)
                        <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                    @endforeach
                </select>
                </div>

                <div class="col-md-6">
                    <label for="institu" class="form-label">Institute</label>
                    <select name="institute_id" id="institu_id" class="form-select">
                    <option value="">Select an Institute</option>
                    @foreach ($institutes as $institute)
                        <option value="{{ $institute->id }}">{{ $institute->name }}</option>
                    @endforeach
                </select>
                </div>     

                <div class="col-md-6">
                    <label for="group_id" class="form-label">Groups</label>
                    <select name="group_id" id="group_id" class="form-select">
                    <option value="">Select a Group</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
                </div> 

                <div class="col-md-6">
                    <label for="campaign_id" class="form-label">Campaigns</label>
                    <select name="campaign_id" id="campaign_id" class="form-select">
                    <option value="">Select a campaign</option>
                    @foreach ($campaigns as $campaign)
                        <option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
                    @endforeach
                </select>
                </div> 



                
                <div class="col-md-4">
                    <label for="admission" class="form-label">Admission Date</label>
                    <input type="date" class="form-control" id="admission" name="admission" value="{{ old('admission') }}">

                </div>   
                
                <div class="col-12">
                    <label for="period" class="form-label">For Pregenant Women Only! enter the date of the last period</label>
                    <input placeholder="yy-mm-dd" type="date" class="form-control" id="period" name="period" value="{{ old('period') }}">
                </div> 

                <div class="col-12">
                    <label for="today" class="form-label">Enter today's date</label>
                    <input placeholder="yy-mm-dd" type="date" class="form-control" id="today" name="today" value="{{ old('today') }}">
                </div>

                <div class="col-12">
                    <label for="notes" class="form-label">Patient's Notes</label>
                    <textarea id="notes" name="notes"  value="{{old('notes')}}"> 

                    </textarea>
                 </div>     
                 
                 <div class="col-md-6">
                    <label for="total_price" class="form-label">Total Price</label>
                    <input id="total_price" name="total_price" type="number"  value="{{ old('total_price') }}" required>
                </div> 

                <div class="col-md-6">
                    <label for="gross_amount" class="form-label">Gross Amount</label>
                    <input id="gross_amount" name="gross_amount" type="number"  value="{{ old('gross_amount') }}" required>
                </div>                   

                <div class="col-md-6">
                    <label for="paid_amount" class="form-label">Paid Amount</label>
                    <input id="paid_amount" name="paid_amount" type="number"  value="{{ old('paid_amount') }}" required>
                </div>   
                
                <div class="col-md-6">
                    <label for="remain_amount" class="form-label">Remaining Amount</label>
                    <input id="remain_amount" name="remain_amount" type="number"  value="{{ old('remain_amount') }}" required>
                </div>                   

                <div class="col-12">
                    <label for="money_note" class="form-label">Money Notes</label>
                    <textarea id="money_note" name="money_note"  value="{{old('money_note')}}"> 

                    </textarea>
                 </div> 
              
                 <div class="form-group">
                            <label for="is_approved">Is Approved by Admin</label>
                            <input name="is_approved" id="is_approved" type="checkbox">
                               
                        </div>

                        <div class="form-group">
                            <label for="is_approved_doctor	">Is Approved by Doctor</label>
                            <input name="is_approved_doctor	" id="is_approved_doctor" type="checkbox">
                               
                        </div>

                        <div class="form-group">
                            <label for="is_online">Is Online</label>
                            <input name="is_online" id="is_online" type="checkbox">
                               
                        </div>


                
                
                <button type="submit" class="btn btn-primary">Create Sample</button>
            </form>









        </div>
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