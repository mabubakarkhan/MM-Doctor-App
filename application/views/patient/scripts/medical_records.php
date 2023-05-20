<script>
$(".select2").select2();
$(document).on('click', '.remove-record', function(event) {
    event.preventDefault();
    $this = $(this);
    ajaxBtnLoader($this);
    $.post('<?=BASEURL."patient/remove-record"?>', {id: $this.attr('data-id')}, function(resp) {
        resp = $.parseJSON(resp);
        if (resp.status == true) {
            $this.parent('td').parent('tr').remove();
        }
        $this.html('<i class="far fa-trash-alt"></i>');
        nativeToast({
            message: resp.msg,
            edge: true,
            position: 'bottom',
            type: resp.type
        })
    });
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