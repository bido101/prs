$(document).ready(function () {
    $('#loginForm').submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        $.ajax({
            url: "./login",
            type: "POST",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                alert(response.message);
                if (response.status === "success") {
                    window.location.href = response.redirect;
                }
            },
            error: function (xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    });

    $('#logoutButton').click(function () {
        $.ajax({
            url: "./logout",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                alert('Successfuly Logout user');
                window.location.href = response.redirect;
            }
        });
    });
});

$(document).ready(function() {
    setTimeout(function() {
        $("#alert").fadeOut(1000); // Fade out over 1 second
    }, 3000); // Start fading out after 5 seconds
});

$(document).ready(function(){
    $("#patientForm").on("submit", function(e){
        e.preventDefault();
        
        let formData = {
            firstname: $("#firstname").val(),
            middlename: $("#middlename").val(),
            lastname: $("#lastname").val(),
            suffix: $("#suffix").val(),
            bday: $("#bday").val(),
            address: $("#address").val(),
            isDeleted: $("#isDeleted").val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: "./patients-store",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                alert(response.success);
                $("#patientForm")[0].reset();
            },
            error: function(response) {
                alert("Error: " + JSON.stringify(response.responseJSON.errors));
            }
        });
    });
});

$(document).ready(function(){
    // Function to fetch and display all patients
    function fetchPatients() {
        $.ajax({
            url: "./patientsrecord",
            type: "GET",
            success: function(response) {
                let rows = "";
                let num = 1;
                    response.forEach(function(patient) {
                        rows += `
                            <tr>
                                <td>${num++}.</td>
                                <td>${patient.hospitalNumber}</td>
                                <td>${patient.firstname} ${patient.lastname}</td>
                                <td>${patient.bday}</td>
                                <td>${patient.address}</td>
                                <td>
                                    <a href="./view-patient-info/${patient.hospitalNumber}" class="btn btn-primary btn-xs view-btn"><i class="fa-regular fa-eye"></i></a>
                                    <button class="btn btn-info btn-xs edit-btn" data-id="${patient.hospitalNumber}" data-bs-toggle="modal" data-bs-target="#editPatient"><i class="fa-regular fa-pen-to-square"></i></button>
                                    <button class="btn btn-danger btn-xs delete-btn" data-did="${patient.hospitalNumber}" data-bs-toggle="modal" data-bs-target="#deletePatient"><i class="fa-regular fa-trash-can"></i></button>
                                </td>
                            </tr>
                        `;
                    });
                $("#patientsTable").html(rows);
            }
        });
    }
    // Fetch all patients on page load
    fetchPatients();

    $('#search').on('keyup', function() {
        let query = $(this).val().trim();
        if (query.length > 1) {
            $.ajax({
                url: "./search",
                type: "GET",
                data: { query: query },
                success: function(data) {
                    console.log(data)
                    let output = '';
                    let num = 1;
                    if (data.length > 0) {
                        data.forEach(function(patient) {
                            output += `
                                <tr>
                                    <td>${num++}.</td>
                                    <td>${patient.hospitalNumber}</td>
                                    <td>${patient.firstname} ${patient.lastname}</td>
                                    <td>${patient.bday}</td>
                                    <td>${patient.address}</td>
                                    <td>
                                        <a href="./view-patient-info/${patient.hospitalNumber}" class="btn btn-primary btn-xs view-btn"><i class="fa-regular fa-eye"></i></a>
                                        <button class="btn btn-info btn-xs edit-btn" data-id="${patient.hospitalNumber}" data-bs-toggle="modal" data-bs-target="#editPatient"><i class="fa-regular fa-pen-to-square"></i></button>
                                        <button class="btn btn-danger btn-xs delete-btn" data-did="${patient.hospitalNumber}" data-bs-toggle="modal" data-bs-target="#deletePatient"><i class="fa-regular fa-trash-can"></i></button>
                                    </td>
                                </tr>
                            `;
                        });
                    } else {
                        output = `
                            <tr>
                                <td colspan="12" style="text-align: center;">No Record Found</td>
                            </tr>
                        `;
                    }
                    $('#patientsTable').html(output);
                }
            });
        } else {
            fetchPatients();
        }
    });

    // Function to fetch and display all patients
    $('#advanceSPatientForm').on('submit', function(event) {
        event.preventDefault();

        let formDataSA = {
            hospitalNumber: $("#s_hospitalNumber").val(),
            firstname: $("#s_firstname").val(),
            middlename: $("#s_middlename").val(),
            lastname: $("#s_lastname").val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: "./searchAdvanced",
            type: "POST",
            data: formDataSA,
            dataType: "json",
            success: function(response) {
                let rows = "";
                let num = 1;
                let patients = response.patient;
                if(response.patient.length != 0){
                    patients.forEach(function(patient) {
                        rows += `
                            <tr>
                                <td>${num++}.</td>
                                <td>${patient.hospitalNumber}</td>
                                <td>${patient.firstname} ${patient.lastname}</td>
                                <td>${patient.bday}</td>
                                <td>
                                    <a href="./view-patient-info/${patient.hospitalNumber}" class="btn btn-primary btn-xs view-btn"><i class="fa-regular fa-eye"></i></a>
                                    <button class="btn btn-info btn-xs edit-btn" data-id="${patient.hospitalNumber}" data-bs-toggle="modal" data-bs-target="#editPatient"><i class="fa-regular fa-pen-to-square"></i></button>
                                    <button class="btn btn-danger btn-xs delete-btn" data-did="${patient.hospitalNumber}" data-bs-toggle="modal" data-bs-target="#deletePatient"><i class="fa-regular fa-trash-can"></i></button>
                                </td>
                            </tr>
                        `;
                    });
                    $("#tbodyAdvancedSearch").html(rows);
                }else{
                    alert("No Record Fount!!!")
                }
            }
        });
    });

    $('#editPatientForm').on('submit', function(event) {
        event.preventDefault();
        
        let formData = {
            hospitalNumber: $("#hospitalNumber").val(),
            firstname: $("#firstname").val(),
            middlename: $("#middlename").val(),
            lastname: $("#lastname").val(),
            suffix: $("#suffix").val(),
            bday: $("#bday").val(),
            address: $("#address").val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };
    
        $.ajax({
            url: './patients/update',
            type: 'POST',
            data: formData,
            dataType: "json",
            success: function(response) {
                if(response.success){
                    alert(response.message);
                    $('#editPatient').modal('hide');
                    fetchPatients();
                }else if(response.error){
                    alert(response.error);
                }
            },
            error: function(xhr) {
                alert("Error:", xhr.responseText);
            }
        });
    });

    $(document).on('click', '.delete-btn', function() {
        let hospitalNumber = $(this).data('did');
        $.ajax({
            url: './deleteshowpatient/' + hospitalNumber,
            type: 'GET',
            success: function(response) {
                $('#hnDeletion').val(response.hospitalNumber);
                $('#hospitalNumberLabel').html(response.hospitalNumber);
                $('#firstnameLabel').html(response.firstname +' '+ response.lastname);
            },
            error: function(xhr) {
                console.log("Error:", xhr.responseText);
            }
        });
    });

    $('#deletePatientForm').on('submit', function(event) {
        event.preventDefault();
        
        let formData = {
            hospitalNumber: $("#hnDeletion").val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };
    
        $.ajax({
            url: './patients/delete',
            type: 'POST',
            data: formData,
            dataType: "json",
            success: function(response) {
                if(response.success){
                    alert(response.message);
                    $('#deletePatient').modal('hide');
                    fetchPatients();
                }else if(response.error){
                    alert(response.error);
                }
            },
            error: function(xhr) {
                alert("Error:", xhr.responseText);
            }
        });
    });

});

$(document).on('click', '.edit-btn', function() {
    let hospitalNumber = $(this).data('id');
    $.ajax({
        url: './editpatient/' + hospitalNumber,
        type: 'GET',
        success: function(response) {
           $('#hospitalNumber').val(response.hospitalNumber);
           $('#firstname').val(response.firstname);
           $('#middlename').val(response.middlename);
           $('#lastname').val(response.lastname);
           $('#suffix').val(response.suffix);
           $('#bday').val(response.bday);
           $('#address').val(response.address);
        },
        error: function(xhr) {
            console.log("Error:", xhr.responseText);
        }
    });
});