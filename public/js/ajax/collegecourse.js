// function updateCollegePreferences(campus) {
//     $.ajax({
//         url: collegeRoute + '?campus=' + campus,
//         type: 'GET',
//         success: function(data) {
//             updateOptions('studCollege', data.college);
//         },
//         error: function() {
//             console.error('Error fetching college');
//         }
//     });
// }

// function updateOptions(selectName, options) {
//     const select = $('select[name=' + selectName + ']');
//     select.empty();
//     select.append('<option value="">Select College</option>');
//     $.each(options, function(key, value) {
//         select.append('<option value="' + value.college_abbr + '">' + value.college_name + '</option>');
//     });
// }

// $('#campus').change(function() {
//     const selectedCampus = $(this).val();
//     updateCollegePreferences(selectedCampus);
// });


