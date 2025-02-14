@extends('welcome')
@section('content')
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1">
            <div class="p-6">
                    <a href="{{ url('/') }}">
                        <i class="fa-solid fa-circle-left"></i> Back
                    </a>
                    &nbsp; | &nbsp;
                    <a href="{{ route('patient-information') }}">
                        <i class="fa-solid fa-users-viewfinder"></i> View Patient List
                    </a>
                <br>    
                <div class="card">
                    <div class="card-body">
                        <form id="patientForm">
                            @csrf
                            <input type="hidden" class="form-control" id="isDeleted" value="no" name="isDeleted">
                            <div class="row">
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label for="firstname" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label for="middlename" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middlename" placeholder="Middle Name" name="middlename">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label for="lastname" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="mb-3">
                                        <label for="suffix" class="form-label">Suffix</label>
                                        <select name="suffix" id="suffix" class="form-control" name="suffix">
                                            <option value="N/A">N/A</option>
                                            <option value="Jr.">Jr.</option>
                                            <option value="Sr.">Sr.</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="bday" class="form-label">Birthday</label>
                                        <input type="date" class="form-control" id="bday" placeholder="Birthday" name="bday">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea id="address" class="form-control" name="address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fa-regular fa-floppy-disk"></i> Save Information
                            </button>
                        </form>                
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
