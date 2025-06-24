<script>
    function calculateAge() {
        var birthday = document.getElementById('bday').value;
        var today = new Date();
        var birthDate = new Date(birthday);
        var age = today.getFullYear() - birthDate.getFullYear();

        if (today.getMonth() < birthDate.getMonth() || (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
            age--;
        }
        document.getElementById('age').value = age;
    }
</script>
<script>
    function updateCoursePreferences(studCollege) {
    $.ajax({
            url: '{{ route("getCourse") }}?studCollege=' + studCollege,
            type: 'GET',
            success: function(data) {
                updateCourseOptions('studCourse', data.course);
            },
            error: function() {
                console.error('Error fetching course');
            }
        });
    }

    function updateCourseOptions(selectName, options) {
        const select = $('select[name=' + selectName + ']');
        select.empty();
        select.append('<option value="">Select Course</option>');
        $.each(options, function(key, value) {
            select.append('<option value="' + value.progAcronym + '">' + value.progAcronym + ' - ' + value.progName +'</option>');
        });
    }

    $('#collegeSelect').change(function() {
        const selectedCollege = $(this).val();
        updateCoursePreferences(selectedCollege);
    });

</script>