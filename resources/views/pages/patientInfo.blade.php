@extends('welcome')
@section('content')
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1">
            <div class="p-6">
                <div class="card">
                    <a href="{{ url('/patient-information') }}" style="float:right;" class="underline text-gray-900 dark:text-gray-900">
                        <i class="fa-solid fa-circle-left"></i> Back
                    </a>
                    <div class="card-body">                        
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ asset('img/avatar.png') }}" class="rounded float-start" alt="...">
                            </div>
                            <div class="col-8">
                                <label for="hospitalNumber">Hospital Number:</label>
                                <input type="number" value="{{ $patient->hospitalNumber }}" placeholder="Hospital Number" class="form-control" readonly><br>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="firstname">First Name:</label>
                                        <input type="text" name="firstname" id="firstname" value="{{ $patient->firstname }}" placeholder="First Name" class="form-control" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label for="middlename">Middle Name:</label>
                                        <input type="text" name="middlename" id="middlename" value="{{ $patient->middlename }}" placeholder="Middle Name" class="form-control" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label for="lastname">Last Name:</label>
                                        <input type="text" name="lastname" id="lastname" value="{{ $patient->lastname }}" placeholder="Last Name" class="form-control" readonly>
                                    </div>
                                </div>
                                <label for="suffix">Suffix:</label>
                                <select name="suffix" id="suffix" class="form-control" readonly>
                                    <option value="N/A" <?php if($patient->suffix == 'N/A'){echo 'selected';} ?>>N/A</option>
                                    <option value="Jr." <?php if($patient->suffix == 'Jr.'){echo 'selected';} ?>>Jr.</option>
                                    <option value="Sr." <?php if($patient->suffix == 'Sr.'){echo 'selected';} ?>>Sr.</option>
                                    <option value="II" <?php if($patient->suffix == 'II'){echo 'selected';} ?>>II</option>
                                    <option value="III" <?php if($patient->suffix == 'III'){echo 'selected';} ?>>III</option>
                                    <option value="IV" <?php if($patient->suffix == 'IV'){echo 'selected';} ?>>IV</option>
                                </select>
                                <label for="bday">Birthday:</label>
                                <input type="date" name="bday" id="bday" value="{{ $patient->bday }}" placeholder="Birthday" class="form-control"><br>
                                <label for="address">Address:</label>
                                <textarea name="address" id="address" class="form-control">{{ $patient->address }}</textarea><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
