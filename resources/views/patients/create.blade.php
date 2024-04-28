@extends('common')
@section('content')

<div class="container mt-n5">




        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <div class="card">
        <div class="card-header">Create A New Patient</div>
        <div class="card-body">


        <form action="{{ route('patients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
               
                <div class="row gx-3 mb-3">

                <div class="col-md-6">
                <label for="name" class="small mb-1"> Patient Name </label><span style="color: red; margin:5px;">*</span>
                <input type="text" id="name" name="name"  class="form-control" value="{{old('name')}}" required />

                
                @error('name')
                    {{$message}}
                @enderror
            </div>

                <div class="col-md-6">
                <label for="birth" class="small mb-1"> Date Of Birth </label><span style="color: red; margin:5px;">*</span>
                
                <input type="date" id="birth" name="birth"  class="form-control" value="{{old('birth')}}" required />
                @error('birth')
                    {{$message}}
                @enderror
            </div> </div>

              
            <div class="row gx-3 mb-3">
            <div class="col-4">
            <label for="gender">Gender</label><span style="color: red; margin:5px;">*</span><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}  required>
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>


            <div class="col-4">
                <label for="city" class="small mb-1"> City </label>
                <input type="text" id="city" name="city"  class="form-control" value="{{old('city')}}"  />
                @error('city')
                    {{$message}}
                @enderror
            </div>

            <div class="col-4">
                <label for="village" class="small mb-1"> Village </label>
                <input type="text" id="village" name="village"  class="form-control" value="{{old('village')}}"  />
                @error('village')
                    {{$message}}
                @enderror
            </div></div>

            <div class="row gx-3 mb-3">
            <div class="col-md-6">
            <label for="work_address" class="small mb-1"> Work Address </label>
                <input type="text" id="work_address" name="work_address"  class="form-control" value="{{old('work_address')}}"  />
                @error('work_address')
                    {{$message}}
                @enderror

            </div>
            <div class="col-md-6">

            <label for="phone_number" class="small mb-1"> Phone Number </label>
                <input type="text" id="phone_number" name="phone_number"  class="form-control" value="{{old('phone_number')}}"  />
                @error('phone_number')
                    {{$message}}
                @enderror
            </div></div>

            <div class="row gx-3 mb-3">
            <div class="col-md-6">
            <label for="whatsapp_number" class="small mb-1"> Whats app Number </label>
                <input type="text" id="whatsapp_number" name="whatsapp_number"  class="form-control" value="{{old('whatsapp_number')}}"  />
                @error('whatsapp_number')
                    {{$message}}
                @enderror
            </div>

            <div class="col-md-6">
            <label for="email" class="small mb-1"> Email </label>
                <input type="email" id="email" name="email"  class="form-control" value="{{old('email')}}"  />
                @error('email')
                    {{$message}}
                @enderror
            </div></div>

            <div class="row gx-3 mb-3">
            <div class="col-md-6">
            <label for="id_number" class="small mb-1"> ID Number </label>
                <input type="text" id="id_number" name="id_number"  class="form-control" value="{{old('id_number')}}"  />
                @error('id_number')
                    {{$message}}
                @enderror
            </div>

            <div class="col-md-6">
            <label for="online_portal_information" class="small mb-1"> Online Portal Information </label>
                <input type="text" id="online_portal_information" name="online_portal_information"  class="form-control" value="{{old('online_portal_information')}}"  />
                @error('online_portal_information')
                    {{$message}}
                @enderror
                
                </div></div>

                <div class="row gx-3 mb-3">
                <div class="col-md-6">

                <label for="facebook" class="small mb-1"> Facebook </label>
                <input type="text" id="facebook" name="facebook"  class="form-control" value="{{old('facebook')}}"  />
                @error('facebook')
                    {{$message}}
                @enderror
                </div>
                <div class="col-md-6">

                <label for="instagram" class="small mb-1"> Instagram </label>
                <input type="text" id="instagram" name="instagram"  class="form-control" value="{{old('instagram')}}"  />
                @error('instagram')
                    {{$message}}
                @enderror
                </div></div>

                <div class="row gx-3 mb-3">
                <div class="col-md-6">
                <label for="patient_notes" class="small mb-1"> Patient Notes </label>
                <textarea type="text" id="patient_notes" name="patient_notes"  class="form-control"  >{{old('patient_notes')}}</textarea>
                @error('patient_notes')
                    {{$message}}
                @enderror
                </div>

                <div class="col-md-6">

                <label for="address_on_map" class="small mb-1"> Address On Map </label>
                <input type="text" id="address_on_map" name="address_on_map"  class="form-control" value="{{old('address_on_map')}}"  />
                @error('address_on_map')
                    {{$message}}
                @enderror
                </div></div>

                <div class="row gx-3 mb-3">
                <div class="col">
                <label for="img" class="btn btn-primary btn-sm">
                        Upload Patient Image
                        <input type="file" id="img" name="img" accept="image/*" onchange="previewImage(event)" style="display: none;">
                </label>
            </div>
                <div class="col" >
                <img id="image-preview" src="#" alt="Selected Image" style="display: none; max-width: 200px;">
                </div></div>
               




                
                <div class="col-12">
                   <br>
                <button type="submit" class="btn btn-primary btn-sm">Create Patient</button></div>
            </form>




        
    </div>
</div>
</div>

<script>
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function() {
            var imgElement = document.getElementById('image-preview');
            imgElement.src = reader.result;
            imgElement.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>


@endsection