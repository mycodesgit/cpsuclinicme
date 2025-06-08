$(function () {
    $('#addPatient').validate({
        rules: {
            fname: {
                required: true
            },
            mname: {
                required: true
            },
            lname: {
                required: true
            },
            category: {
                required: true
            },
            birthdate: {
                required: true
            },
            age: {
                required: true
            },
            sex: {
                required: true
            },
            home_region: {
                required: true
            },
            home_province: {
                required: true
            },
            home_city: {
                required: true
            },
            home_brgy: {
                required: true
            },
            guardian_region: {
                required: true
            },
            guardian_province: {
                required: true
            },
            guardian_city: {
                required: true
            },
            guardian_brgy: {
                required: true
            },
            contact: {
                required: true
            },
            stud_nation: {
                required: true
            },
            stud_religion: {
                required: true
            },
            c_status: {
                required: true
            },
            guardian: {
                required: true
            },
            guardian_occup: {
                required: true
            },
            guardian_contact: {
                required: true
            },
            guardian_add: {
                required: true
            },
            height_cm: {
                required: true
            },
            height_ft: {
                required: true
            },
            weight_kg: {
                required: true
            },
            weight_lb: {
                required: true
            },
        },
        messages: {
            fname: {
                required: "Please enter a First Name"
            },
            mname: {
                required: "Please enter a Middle Name"
            },
            lname: {
                required: "Please enter a Last Name"
            },
            category: {
                required: "Please select Category"
            },
            birthdate: {
                required: "Please enter a Birthdate"
            },
            age: {
                required: "Please enter an Age"
            },
            sex: {
                required: "Please select a Gender"
            },
            home_region: {
                required: "Please select region"
            },
            home_province: {
                required: "Please select province"
            },
            home_city: {
                required: "Please select city"
            },
            home_brgy: {
                required: "Please select barangay"
            },
            guardian_region: {
                required: "Please select region"
            },
            guardian_province: {
                required: "Please select province"
            },
            guardian_city: {
                required: "Please select city"
            },
            guardian_brgy: {
                required: "Please select barangay"
            },
            contact: {
                required: "Please enter a Contact Number"
            },
            stud_nation: {
                required: "Please enter a Nationality"
            },
            stud_religion: {
                required: "Please enter a Religion"
            },
            c_status: {
                required: "Please select a Civil Status"
            },
            guardian: {
                required: "Please enter a Guardian Name"
            },
            guardian_occup: {
                required: "Please enter a Guardian Occupation"
            },
            guardian_contact: {
                required: "Please enter a Guardian Contact Number"
            },
            height_cm: {
                required: "Please enter a height(cm)"
            },
            height_ft: {
                required: "Please enter a height(ft)"
            },
            weight_kg: {
                required: "Please enter a weight(kg)"
            },
            weight_lb: {
                required: "Please enter a weight(lb)"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-12, .col-md-6, .col-md-4, .col-md-3').append(error);        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});