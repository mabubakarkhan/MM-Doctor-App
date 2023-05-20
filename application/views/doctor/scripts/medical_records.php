<script>
$(".select2").select2();
$(document).on('change', 'select[name="patient_id"]', function(event) {
    event.preventDefault();
    $id = $(this).val();
    $("select[name='appointment_id']").html('<option value="">Please wait</option>');
    $.post('<?=BASEURL."xml-content/get-appointments-by-patient"?>', {id: $id}, function(resp) {
        resp = $.parseJSON(resp);
        if (resp.status == true) {
            $("select[name='appointment_id']").html(resp.html);
        }
        else{
            $("select[name='appointment_id']").html('<option value="">'+resp.html+'</option>');
        }
        nativeToast({
            message: resp.msg,
            edge: true,
            position: 'bottom',
            type: resp.type
        })
    });
});
$(document).on('submit', 'form.medical-records-form', function(event) {
    event.preventDefault();
    let form = $(this);
    ajaxBtnLoader(form.find(".doctor-submit-btn"));

    $.ajax({
        url: form.attr('action'),
        type: "POST",
        dataType: "json",
        data: form.serialize(),
        success: function(resp) {
            form.find(".doctor-submit-btn").html('Save');
            $(".medical-records-wrap").html(resp.html);
            $("#medical_records_form input[name='patient_id']").val($('select[name="patient_id"]').val());
            $("#medical_records_form input[name='appointment_id']").val($('select[name="appointment_id"]').val());
            nativeToast({
                message: resp.msg,
                edge: true,
                position: 'bottom',
                type: resp.type
            })
        },
        error: function(xhr, status, error) {
            errorCallback(error);
        }
    });//ajax

});




</script>

<div class="modal fade custom-modal custom-medicalrecord-modal" id="add_medical_records_modal" style="display: none;" data-select2-id="add_medical_records_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Medical Records</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="medical_records_form" action="post-medical-record" enctype="multipart/form-data" method="post">
                <input type="hidden" name="patient_id">
                <input type="hidden" name="appointment_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="detail" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Upload</label>
                                <div class="upload-medical-records">
                                    <input class="form-control" type="file" name="file" id="user_files_mr">
                                    <div class="upload-content dropzone">
                                        <div class="text-center">
                                            <div class="upload-icon mb-2"><img src="<?=IMG?>upload-icon.png" alt=""></div>
                                            <h5>Drag &amp; Drop</h5>
                                            <h6>or <span class="text-danger">Browse</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="dated" id="tratment_date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <div class="submit-section text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>