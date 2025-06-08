<script>
    $(document).ready(function() {
        // Set up CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        // AJAX request to get provinces based on selected region
        $('#region').change(function() {
            var regionId = $(this).val();
            if (regionId) {
                $.ajax({
                    url: "{{ route('getProvinces', ['regionId' => ':regionId']) }}".replace(':regionId', regionId),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#province').empty();
                        $('#province').append('<option value="">Select Province</option>');
                        $.each(data, function(key, value) {
                            let patientId = "{{ request()->is('patient/moreinfo/*') ? $patients->id : '' }}";
                            $('#province').append(
                                '<option value="' + value.province_id + 
                                '" data-column-id="' + patientId + 
                                '" data-column-name="home_province">' + 
                                value.name + '</option>'
                            );
                        });
                        $('#province').prop('disabled', false);
                    },
                    error: function() {
                        $('#province').empty();
                        $('#province').append('<option value="">Select Province</option>');
                        $('#province').prop('disabled', true);
                    }
                });
            } else {
                $('#province').empty();
                $('#province').append('<option value="">Select Province</option>');
                $('#province').prop('disabled', true);
            }
        });
    
        // AJAX request to get cities based on selected province
        $('#province').change(function() {
            var provinceId = $(this).val();
            if (provinceId) {
                $.ajax({
                    url: "{{ route('getCities', ['provinceId' => ':provinceId']) }}".replace(':provinceId', provinceId),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#city').empty();
                        $('#city').append('<option value="">Select City</option>');
                        $.each(data, function(key, value) {
                            let patientId = "{{ request()->is('patient/moreinfo/*') ? $patients->id : '' }}";
                            $('#city').append(
                                '<option value="' + value.city_id + 
                                '" data-column-id="' + patientId + 
                                '" data-column-name="home_city">' + 
                                value.name + '</option>'
                            );
                        });
                        $('#city').prop('disabled', false);
                    },
                    error: function() {
                        $('#city').empty();
                        $('#city').append('<option value="">Select City</option>');
                        $('#city').prop('disabled', true);
                    }
                });
            } else {
                $('#city').empty();
                $('#city').append('<option value="">Select City</option>');
                $('#city').prop('disabled', true);
            }
        });
    
        // AJAX request to get barangays based on selected city
        $('#city').change(function() {
            var cityId = $(this).val();
            if (cityId) {
                $.ajax({
                    url: "{{ route('getBarangays', ['cityId' => ':cityId']) }}".replace(':cityId', cityId),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#barangay').empty();
                        $('#barangay').append('<option value="">Select Barangay</option>');
                        $.each(data, function(key, value) {
                            let patientId = "{{ request()->is('patient/moreinfo/*') ? $patients->id : '' }}";
                            $('#barangay').append(
                                '<option value="' + value.id + 
                                '" data-column-id="' + patientId + 
                                '" data-column-name="home_brgy">' + 
                                value.name + '</option>'
                            );
                        });
                        $('#barangay').prop('disabled', false);
                    },
                    error: function() {
                        $('#barangay').empty();
                        $('#barangay').append('<option value="">Select Barangay</option>');
                        $('#barangay').prop('disabled', true);
                    }
                });
            } else {
                $('#barangay').empty();
                $('#barangay').append('<option value="">Select Barangay</option>');
                $('#barangay').prop('disabled', true);
            }
        });
    
    
        // AJAX request to get provinces based on selected region
        $('#region1').change(function() {
            var regionId = $(this).val();
            if (regionId) {
                $.ajax({
                    url: "{{ route('getProvinces', ['regionId' => ':regionId']) }}".replace(':regionId', regionId),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#province1').empty();
                        $('#province1').append('<option value="">Select Province</option>');
                        $.each(data, function(key, value) {
                            let patientId = "{{ request()->is('patient/moreinfo/*') ? $patients->id : '' }}";
                            $('#province1').append(
                                '<option value="' + value.province_id + 
                                '" data-column-id="' + patientId + 
                                '" data-column-name="guardian_province">' + 
                                value.name + '</option>'
                            );
                        });
                        $('#province1').prop('disabled', false);
                    },
                    error: function() {
                        $('#province1').empty();
                        $('#province1').append('<option value="">Select Province</option>');
                        $('#province1').prop('disabled', true);
                    }
                });
            } else {
                $('#province1').empty();
                $('#province1').append('<option value="">Select Province</option>');
                $('#province1').prop('disabled', true);
            }
        });
    
        // AJAX request to get cities based on selected province
        $('#province1').change(function() {
            var provinceId = $(this).val();
            if (provinceId) {
                $.ajax({
                    url: "{{ route('getCities', ['provinceId' => ':provinceId']) }}".replace(':provinceId', provinceId),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#city1').empty();
                        $('#city1').append('<option value="">Select City</option>');
                        $.each(data, function(key, value) {
                            let patientId = "{{ request()->is('patient/moreinfo/*') ? $patients->id : '' }}";
                            $('#city1').append(
                                '<option value="' + value.city_id + 
                                '" data-column-id="' + patientId + 
                                '" data-column-name="guardian_city">' + 
                                value.name + '</option>'
                            );
                        });
                        $('#city1').prop('disabled', false);
                    },
                    error: function() {
                        $('#city1').empty();
                        $('#city1').append('<option value="">Select City</option>');
                        $('#city1').prop('disabled', true);
                    }
                });
            } else {
                $('#city1').empty();
                $('#city1').append('<option value="">Select City</option>');
                $('#city1').prop('disabled', true);
            }
        });
    
        // AJAX request to get barangays based on selected city
        $('#city1').change(function() {
            var cityId = $(this).val();
            if (cityId) {
                $.ajax({
                    url: "{{ route('getBarangays', ['cityId' => ':cityId']) }}".replace(':cityId', cityId),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#barangay1').empty();
                        $('#barangay1').append('<option value="">Select Barangay</option>');
                        $.each(data, function(key, value) {
                            let patientId = "{{ request()->is('patient/moreinfo/*') ? $patients->id : '' }}";
                            $('#barangay1').append(
                                '<option value="' + value.id + 
                                '" data-column-id="' + patientId + 
                                '" data-column-name="guardian_brgy">' + 
                                value.name + '</option>'
                            );
                        });
                        $('#barangay1').prop('disabled', false);
                    },
                    error: function() {
                        $('#barangay1').empty();
                        $('#barangay1').append('<option value="">Select Barangay</option>');
                        $('#barangay1').prop('disabled', true);
                    }
                });
            } else {
                $('#barangay1').empty();
                $('#barangay1').append('<option value="">Select Barangay</option>');
                $('#barangay1').prop('disabled', true);
            }
        });
    });
</script>

<script>
    // Function to get BMI category based on BMI value
    function getBMICategory(bmi) {
        if (bmi < 16.0) {
            document.getElementById('bmi_cat').value = "Severely Underweight";    
        } else if (bmi >= 16.0 && bmi <= 18.4) {
            document.getElementById('bmi_cat').value = "Underweight";
        } else if (bmi >= 18.5 && bmi <= 24.9) {
            document.getElementById('bmi_cat').value = "Normal";
        } else if (bmi >= 25.0 && bmi <= 29.9) {
            document.getElementById('bmi_cat').value = "Overweight";
        } else if (bmi >= 30.0 && bmi <= 34.9) {
            document.getElementById('bmi_cat').value = "Moderately Obese";
        } else if (bmi >= 35.0 && bmi <= 39.9) {
            document.getElementById('bmi_cat').value = "Severely Obese";
        } else if (bmi >= 40.0) {
            document.getElementById('bmi_cat').value = "Morbidly Obese";
        } else {
            document.getElementById('bmi_cat').value = ''; 
        }
    }

    $(document).ready(function() {
        setInterval(function() {
            const bmiValue = parseFloat(document.getElementById('bmi').value); 
            getBMICategory(bmiValue);
        }, 100); 
    });
</script>
<script>
    // Function to calculate BMI
    function calculateBMI(weightKg, heightM) {
        if (weightKg && heightM) {
            var bmi = weightKg / (heightM * heightM);
            return bmi.toFixed(1); // Round BMI to one decimal point
        } else {
            return ""; // Return empty string if either value is missing
        }
    }
    
    // Convert height from centimeters to feet and inches
    function convertHeight() {
        var cm = parseFloat(document.getElementById('height_cm').value);
        if (!isNaN(cm)) {
            var totalInches = cm / 2.54;
            var feet = Math.floor(totalInches / 12);
            var inches = Math.round(totalInches % 12); // Round inches to nearest whole number
            var formattedHeight = feet + "'" + inches + '"';
            document.getElementById('height_ft').value = formattedHeight;

            // Calculate BMI
            var weightKg = parseFloat(document.getElementById('weight_kg').value);
            var heightM = cm / 100; // Convert cm to meters for BMI calculation
            var bmi = calculateBMI(weightKg, heightM);
            document.getElementById('bmi').value = bmi; // Display BMI
        } else {
            document.getElementById('height_ft').value = '';
            document.getElementById('bmi').value = ''; // Clear BMI if height is N/A
        }
    }

    // Convert height from feet and inches to centimeters
    function convertHeightToFtIn() {
        var heightFt = document.getElementById('height_ft').value;
        if (heightFt) {
            var feet = parseFloat(heightFt.split("'")[0]);
            var inches = parseFloat(heightFt.split("'")[1].replace('"', ''));
            var totalInches = feet * 12 + inches;
            var cm = totalInches * 2.54;
            document.getElementById('height_cm').value = Math.round(cm); // Round cm to nearest whole number

            // Calculate BMI
            var weightKg = parseFloat(document.getElementById('weight_kg').value);
            var heightM = cm / 100; // Convert cm to meters for BMI calculation
            var bmi = calculateBMI(weightKg, heightM);
            document.getElementById('bmi').value = bmi; // Display BMI
        } else {
            document.getElementById('height_cm').value = '';
            document.getElementById('bmi').value = ''; // Clear BMI if height is N/A
        }
    }

    // Event listener for height in centimeters
    document.getElementById('height_cm').addEventListener('input', function() {
        convertHeight();
    });

    // Event listener for height in feet and inches
    document.getElementById('height_ft').addEventListener('input', function() {
        convertHeightToFtIn();
    });

    // Event listener for weight in kilograms
    document.getElementById('weight_kg').addEventListener('input', function() {
        var weightKg = parseFloat(this.value);
        if (!isNaN(weightKg)) {
            var weightLb = weightKg * 2.20462;
            document.getElementById('weight_lb').value = Math.round(weightLb); // Round weight in pounds
        } else {
            document.getElementById('weight_lb').value = '';
        }

        // Calculate BMI
        var heightCm = parseFloat(document.getElementById('height_cm').value);
        var bmi = calculateBMI(weightKg, heightCm / 100); // Convert cm to meters for BMI calculation
        document.getElementById('bmi').value = bmi; // Display BMI
    });

    // Event listener for weight in pounds
    document.getElementById('weight_lb').addEventListener('input', function() {
        var weightLb = parseFloat(this.value);
        if (!isNaN(weightLb)) {
            var weightKg = weightLb / 2.20462;
            document.getElementById('weight_kg').value = Math.round(weightKg); // Round weight in kilograms
        } else {
            document.getElementById('weight_kg').value = '';
        }

        // Calculate BMI
        var heightCm = parseFloat(document.getElementById('height_cm').value);
        var bmi = calculateBMI(weightKg, heightCm / 100); // Convert cm to meters for BMI calculation
        document.getElementById('bmi').value = bmi; // Display BMI
    });

    // Initial conversion on page load
    convertHeight();
</script>