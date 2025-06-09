<div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog" aria-labelledby="uploadFileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadFileModalLabel">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" method="POST" action="{{ route('fileCreate', ['id' => request('id')]) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="patient_id" id="" value="{{ request('id') }}">
                    <div class="form-group">
                        <label for="file">Choose File:</label>
                        <input type="file" class="form-control-file" accept=".pdf" id="file" name="file" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        
                    <button type="button" onclick="validateAndSubmit()" class="btn btn-success float-right"><i class="fas fa fa-upload"></i> Upload File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function validateAndSubmit() {
        var fileInput = document.getElementById('file');
        var file = fileInput.files[0];

        if (file) {
            if (file.type !== 'application/pdf') {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    'positionClass': 'toast-bottom-right'
                }
                toastr.error("Only PDF files are allowed.");
                return; 
            }

            // if (file.size > 5 * 1024 * 1024) {
            //     toastr.options = {
            //         "closeButton": true,
            //         "progressBar": true,
            //         'positionClass': 'toast-bottom-right'
            //     }
            //     toastr.error("File size must be less than or equal to 5 MB.");
            //     return;
            // }

            document.getElementById('uploadForm').submit();
        }
    }
</script>