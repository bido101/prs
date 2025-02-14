@extends('welcome')
@section('content')
    <style>
        .input-group-icon, .search-input {
            border: none;
            border-bottom: 2px solid var(--bs-info); /* Default Bootstrap primary color */
            border-radius: 0;
            outline: none;
            box-shadow: none;
            background-color: transparent;
            padding: 5px;
        }
        
        .search-input:focus {
            border-bottom: 2px solid var(--bs-info); /* Custom darker blue on focus */
            box-shadow: none;
        }       
    </style>
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1">
            <div class="p-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table caption-top">
                            <caption>
                                <div style="float:left;">
                                    <i class="fa-solid fa-hospital-user"></i> List of Patient
                                    <div class="input-group mb-3">
                                        <span class="input-group-icon" id="basic-addon1">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </span>
                                        <input type="text" placeholder="Search..." class="search-input" aria-label="Search..." id="search">
                                        <button class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#advanceSearch">
                                            <i class="fa-solid fa-sort"></i> Addvanced
                                        </button>
                                    </div>
                                </div>
                                <a href="{{ url('/') }}" style="float:right;" class="underline text-gray-900 dark:text-gray-900">
                                    <i class="fa-solid fa-circle-left"></i> Back
                                </a>
                            </caption>
                            <thead>
                                <tr>
                                    <th scope="col">#</th> 
                                    <th scope="col">Hospital #</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Birthday</th>
                                    <th scope="col">Address</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="patientsTable"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit Patient -->
    <div class="modal fade" id="editPatient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPatientForm">
                        <label for="hospitalNumber">Hospital Number:</label>
                        <input type="number" name="hospitalNumber" id="hospitalNumber" placeholder="Hospital Number" class="form-control"><br>
                        <label for="firstname">First Name:</label>
                        <input type="text" name="firstname" id="firstname" placeholder="First Name" class="form-control"><br>
                        <label for="middlename">Middle Name:</label>
                        <input type="text" name="middlename" id="middlename" placeholder="Middle Name" class="form-control"><br>
                        <label for="lastname">Last Name:</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Last Name" class="form-control"><br>
                        <label for="suffix">Suffix:</label>
                        <select name="suffix" id="suffix" class="form-control">
                            <option value="N/A">N/A</option>
                            <option value="Jr.">Jr.</option>
                            <option value="Sr.">Sr.</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                        </select>
                        <label for="bday">Birthday:</label>
                        <input type="date" name="bday" id="bday" placeholder="Birthday" class="form-control"><br>
                        <label for="address">Address:</label>
                        <textarea name="address" id="address" class="form-control"></textarea><br>
                        <button type="submit" class="btn btn-primary form-control" >Update Information</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Patient -->
    <div class="modal fade" id="deletePatient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="deletePatientForm">
                        <input type="hidden" id="hnDeletion" name="hospitalNumber">
                        <h5>Are you sure you want to delete this patient ?</h5>
                        <label for="hospitalNumberLabel">Hospital Number: <div id="hospitalNumberLabel"></div></label><br>
                        <label for="nameLabel">Name: <div id="firstnameLabel"></div><div id="lastnameLabel"></div></label><br> 
                        <button type="submit" class="btn btn-danger" style="float: right;">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Advanced Search -->
    <div class="modal fade" id="advanceSearch" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-magnifying-glass"></i> Advance Search</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <form id="advanceSPatientForm" style="border: 1px solid black;padding: 10px;border-radius: 10px;">
                                <label for="s_hospitalNumber">Hospital Number:</label>
                                <input type="number" name="s_hospitalNumber" id="s_hospitalNumber" placeholder="Hospital Number" class="form-control"><br>
                                <label for="s_firstname">First Name:</label>
                                <input type="text" name="s_firstname" id="s_firstname" placeholder="First Name" class="form-control"><br>
                                <label for="s_middlename">Middle Name:</label>
                                <input type="text" name="s_middlename" id="s_middlename" placeholder="Middle Name" class="form-control"><br>
                                <label for="s_lastname">Last Name:</label>
                                <input type="text" name="s_lastname" id="s_lastname" placeholder="Last Name" class="form-control"><br>
                                <button type="submit" class="btn btn-primary form-control" >
                                    <i class="fa-solid fa-magnifying-glass"></i> Search
                                </button>
                            </form>
                        </div>
                        <div class="col-8">
                            <table class="table table-striped">
                                <thead> 
                                    <th scope="col">#</th> 
                                    <th scope="col">Hospital #</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Birthday</th>
                                    <th scope="col"></th>
                                </thead>
                                <tbody id="tbodyAdvancedSearch"></tbody>                              
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
