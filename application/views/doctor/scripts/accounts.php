<script>
$(document).on('submit', '#accounts_form', function(event) {
    event.preventDefault();
    let form = $(this);
    ajaxBtnLoader(form.find(".btn-add"));
    ajaxFormSubmit(form, function(resp) {   
        form.find(".btn-add").html('Save');
        if (resp.status == true) {
            $("#bank_name").text(resp.data.bank_name);
            $("#branch_name").text(resp.data.bank_branch_code);
            $("#account_no").text(resp.data.bank_account_number);
            $("#account_name").text(resp.data.bank_account_title);
            $("#account_modal").modal('hide');
        }
        nativeToast({
            message: resp.msg,
            edge: true,
            position: 'bottom',
            type: resp.type
        })
    }, function(error) {
        console.error(error);
    });//ajax function call back
});//profile-form
</script>
<div class="modal fade custom-modal" id="account_modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Account Details</h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <form id="accounts_form" action="update-account" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Bank Name</label>
                                <input type="text" name="bank_name" class="form-control bank_name" value="<?=$userSession['bank_name']?>" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Branch Code</label>
                                <input type="text" name="bank_branch_code" class="form-control branch_name" value="<?=$userSession['bank_branch_code']?>" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Account Number</label>
                                <input type="text" name="bank_account_number" class="form-control account_no" value="<?=$userSession['bank_account_number']?>" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Account Name</label>
                                <input type="text" name="bank_account_title" class="form-control acc_name" value="<?=$userSession['bank_account_number']?>" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="submit" id="acc_btn" class="btn btn-primary btn-add">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>