<script>
$(".select2").select2();
$(document).on('submit', 'form.medical-records-form', function(event) {
    event.preventDefault();
    $("#medicalRecordsSearchResultsTable tbody").html('');
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
            $("#medical_records_form input[name='appointment_id']").val($('select[name="appointment_id"]').val());
            nativeToast({
                message: resp.msg,
                edge: true,
                position: 'bottom',
                type: resp.type
            })
        },
        error: function(xhr, status, error) {
            // errorCallback(error);
            console.log(error);
        }
    });//ajax

});

</script>