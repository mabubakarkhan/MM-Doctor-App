    <!-- Footer -->
    <footer class="site-footer">
        <div class="site-footer-legal"><p>WEBSITE BY <a href="javascript://"><strong><?=APP_TITLE?></strong></a></p>
            <p>© <?=date('Y')?>. All RIGHT RESERVED.</p></div>
        </footer>
        <!-- Core  -->
        <script src="<?=GLOBAL_?>vendor/jquery/jquery.js"></script>
        <script src="<?=GLOBAL_?>vendor/bootstrap/bootstrap.js"></script>
        <script src="<?=GLOBAL_?>vendor/animsition/animsition.js"></script>
        <script src="<?=GLOBAL_?>vendor/asscroll/jquery-asScroll.js"></script>
        <script src="<?=GLOBAL_?>vendor/mousewheel/jquery.mousewheel.js"></script>
        <script src="<?=GLOBAL_?>vendor/asscrollable/jquery.asScrollable.all.js"></script>
        <script src="<?=GLOBAL_?>vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
        <script src="<?=GLOBAL_?>vendor/waves/waves.js"></script>
        <!-- Plugins -->
        <script src="<?=GLOBAL_?>vendor/switchery/switchery.min.js"></script>
        <script src="<?=GLOBAL_?>vendor/intro-js/intro.js"></script>
        <script src="<?=GLOBAL_?>vendor/screenfull/screenfull.js"></script>
        <script src="<?=GLOBAL_?>vendor/slidepanel/jquery-slidePanel.js"></script>
        <script src="<?=GLOBAL_?>vendor/datatables/jquery.dataTables.js"></script>
        <script src="<?=GLOBAL_?>vendor/datatables-fixedheader/dataTables.fixedHeader.js"></script>
        <script src="<?=GLOBAL_?>vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
        <script src="<?=GLOBAL_?>vendor/datatables-responsive/dataTables.responsive.js"></script>
        <script src="<?=GLOBAL_?>vendor/datatables-tabletools/dataTables.tableTools.js"></script>
        <script src="<?=GLOBAL_?>vendor/asrange/jquery-asRange.min.js"></script>
        <script src="<?=GLOBAL_?>vendor/bootbox/bootbox.js"></script>
        <script src="<?=GLOBAL_?>vendor/jquery-placeholder/jquery.placeholder.js"></script>
        <script type="text/javascript" src="<?=GLOBAL_?>js/jquery.validate.min.js" ></script>
        <script src="<?=GLOBAL_?>vendor/formvalidation/formValidation.min.js"></script>
        <script src="<?=GLOBAL_?>vendor/formvalidation/framework/bootstrap.min.js"></script>
        <script src="<?=GLOBAL_?>vendor/jquery-ui/jquery-ui.js"></script>
        <script src="<?=GLOBAL_?>vendor/blueimp-tmpl/tmpl.js"></script>
        <script src="<?=GLOBAL_?>vendor/blueimp-canvas-to-blob/canvas-to-blob.js"></script>
        <script src="<?=GLOBAL_?>vendor/blueimp-load-image/load-image.all.min.js"></script>
        <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload.js"></script>
        <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload-process.js"></script>
        <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload-image.js"></script>
        <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload-audio.js"></script>
        <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload-video.js"></script>
        <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload-validate.js"></script>
        <script src="<?=GLOBAL_?>vendor/blueimp-file-upload/jquery.fileupload-ui.js"></script>
        <script src="<?=GLOBAL_?>vendor/dropify/dropify.min.js"></script>
        <script src="<?=GLOBAL_?>vendor/summernote/summernote.min.js"></script>
        <!-- Scripts -->
        <script src="<?=GLOBAL_?>js/core.js"></script>
        <script src="<?=GLOBAL_?>assets/js/site.js"></script>
        <script src="<?=GLOBAL_?>assets/js/sections/menu.js"></script>
        <script src="<?=GLOBAL_?>assets/js/sections/menubar.js"></script>
        <script src="<?=GLOBAL_?>assets/js/sections/gridmenu.js"></script>
        <script src="<?=GLOBAL_?>assets/js/sections/sidebar.js"></script>
        <script src="<?=GLOBAL_?>js/configs/config-colors.js"></script>
        <script src="<?=GLOBAL_?>assets/js/configs/config-tour.js"></script>
        <script src="<?=GLOBAL_?>js/components/asscrollable.js"></script>
        <script src="<?=GLOBAL_?>js/components/animsition.js"></script>
        <script src="<?=GLOBAL_?>js/components/slidepanel.js"></script>
        <script src="<?=GLOBAL_?>js/components/switchery.js"></script>
        <script src="<?=GLOBAL_?>js/components/tabs.js"></script>
        <script src="<?=GLOBAL_?>js/components/datatables.js"></script>
        <script src="<?=GLOBAL_?>js/components/jquery-placeholder.js"></script>
        <script src="<?=GLOBAL_?>js/components/material.js"></script>
        <script src="<?=GLOBAL_?>assets/examples/js/forms/validation.js"></script>
        <script src="<?=GLOBAL_?>js/components/dropify.js"></script>
        <script src="<?=GLOBAL_?>assets/examples/js/forms/uploads.js"></script>
        <script src="<?=GLOBAL_?>js/components/summernote.js"></script>
        <script src="<?=GLOBAL_?>assets/examples/js/forms/editor-summernote.js"></script>
        <script>
          (function(document, window, $) {
            'use strict';
            var Site = window.Site;
            $(document).ready(function() {
              Site.run();
          });
        })(document, window, jQuery);
    </script>
</body>
</html>
<style>
    div.theatre-cover{
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      background: rgba(0,0,0,.9);
      z-index: 2000;
      display: none;
  }
  div.theatre-cover img{
      position: absolute;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      margin: auto;
      width: auto;
      height: auto;
      max-width: 100%;
      max-height: 100%;
  }
</style>
<div class="theatre-cover image">
    <img src="<?=IMG?>loader.svg">
</div>

<script type="text/javascript">
    $.extend($.validator.messages, {
        required: "",
        minlength: "",
        maxlength: ""
    });
</script>
<script type="text/javascript">
    $(function(){
        $("li[rel=<?=strtolower($menu)?>]").addClass("active");
        $("li[rel=<?=strtolower($menu)?>]").parent('ul').parent("li").addClass('active');
        $("li[rel=<?=strtolower($menu)?>]").parent('ul').parent("li").addClass('open');

    });//onload
    //get doctor
    $(document).on('click', '.get-doctor', function(event) {
        event.preventDefault();
        $id = $(this).attr('data-id');
        $(".theatre-cover").fadeIn(100);
        $.post('<?=BASEURL."admin/get-doctor-detail"?>', {id: $id}, function(resp) {
            resp = $.parseJSON(resp);
            $(".theatre-cover").fadeOut(100);
            if (resp.status == true) {
                $("#modal-docotr-detail .modal-content").html(resp.html);
                $("#modal-docotr-detail").modal('show');
            }
            else{
                alert('no record found');
            }
        });
    });
    //get patient
    $(document).on('click', '.get-patient', function(event) {
        event.preventDefault();
        $id = $(this).attr('data-id');
        $(".theatre-cover").fadeIn(100);
        $.post('<?=BASEURL."admin/get-patient-detail"?>', {id: $id}, function(resp) {
            resp = $.parseJSON(resp);
            $(".theatre-cover").fadeOut(100);
            if (resp.status == true) {
                $("#modal-patient-detail .modal-content").html(resp.html);
                $("#modal-patient-detail").modal('show');
            }
            else{
                alert('no record found');
            }
        });
    });


    $(document).on('click', '.appointment-cancel', function(event) {
        event.preventDefault();
        $this = $(this);
        $(".appointment-cancel-form input[name='id']").val($this.attr('data-id'));
        $("#modal-appointment-cancel").modal('show');
    });

    $(document).on('submit', '.appointment-cancel-form', function(event) {
        event.preventDefault();
        $form = $(this);
        $(".theatre-cover").fadeIn(100);
        $.post('<?=BASEURL."admin/appointment-cancel"?>', {data: $("#appointment-form").serialize(),form: $form.serialize()}, function(resp) {
            resp = $.parseJSON(resp);
            $(".theatre-cover").fadeOut(100);
            if (resp.status == true) {

                var dataTable = $('#appointments-table').DataTable();
                dataTable.clear().draw();
                $('#appointments-table').DataTable().destroy();

                $("#appointments-table tbody").html(resp.html);
                $('#appointments-table').DataTable();

                $("#modal-appointment-cancel").modal('hide');
            }
            alert(resp.msg);
        });
    });

    $(document).on('click', '.get-medical-records', function(event) {
        event.preventDefault();
        $this = $(this);
        $(".theatre-cover").fadeIn(100);
        $.post('<?=BASEURL."admin/appointment-medical-records"?>', {id: $this.attr('data-id')}, function(resp) {
            resp = $.parseJSON(resp);
            $(".theatre-cover").fadeOut(100);
            $("#modal-appointment-medical-records table tbody").html(resp.html);
            $("#modal-appointment-medical-records").modal('show');
        });
    });

    $(document).on('submit', '#doctor-profile-form', function (event) {
        event.preventDefault();
        $form = $(this);
        $(".theatre-cover").fadeIn(100);
        $.post('<?=BASEURL."admin/update-doctor"?>', {data: $form.serialize()}, function(resp) {
            resp = $.parseJSON(resp);
            $(".theatre-cover").fadeOut(100);
            alert(resp.msg);
        });
    });

    $(document).on('submit', '#patient-profile-form', function (event) {
        event.preventDefault();
        $form = $(this);
        $(".theatre-cover").fadeIn(100);
        $.post('<?=BASEURL."admin/update-patient"?>', {data: $form.serialize()}, function(resp) {
            resp = $.parseJSON(resp);
            $(".theatre-cover").fadeOut(100);
            alert(resp.msg);
        });
    });

</script>

<div class="modal fade" id="modal-patient-detail" style="padding-right: 0 !important;">
    <div class="modal-dialog" role="document" style="width: 97%;padding-right: 0 !important;">
        <div class="modal-content">            
            <!-- html -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-docotr-detail" style="padding-right: 0 !important;">
    <div class="modal-dialog" role="document" style="width: 97%;padding-right: 0 !important;">
        <div class="modal-content">            
            <!-- html -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-appointment-cancel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cancel Appointment</h4>
            </div>
            <div class="modal-body">
                <form class="appointment-cancel-form">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label>Cancel Note</label>
                        <textarea name="cancel_note" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="Submit">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- #modal-appointment-cancel -->


<div class="modal fade" id="modal-appointment-medical-records">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Medical Records</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Attachment</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- #modal-appointment-medical-records -->