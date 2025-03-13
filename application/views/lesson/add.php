<style>
    #preview, #preview2 {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
        }
</style>
<section style="min-height: 100vh;">
    <div class="container d-flex justify-content-center mt-5">
        <div class="card col-md-8">
            <div class="card-header text-white" style="background-color: #0a4275;">
                <h2 class="m-0 text-center">Lesson Details</h2>
            </div>
            <div class="card-body">
                <?php $this->load->view('admin/includes/_messages.php') ?>
                <?php echo form_open_multipart(base_url('instructor/add_lesson/'.$module_id), 'class="form-horizontal"');  ?> 
                    <div class="mb-3">
                        <label for="lessonName" class="form-label">Lesson Title</label>
                        <input type="text" class="form-control" id="lessonName" name="lesson_name" placeholder="Enter lesson name">
                    </div>
                    <label for="logo">Lesson Video:</label>
                    <div class="form-group d-flex justify-content-between align-items-center mb-3">
                        <input hidden type="file" class="custom-file-input" name="userfile" id="logo" accept="video/*">
                        <div class="div">
                            <video id="preview" src="" class="img-thumbnail"></video>
                        </div>
                        <label class="btn btn-primary" for="logo">Browse</label>
                    </div>
                    <label for="logo2">Thumbnail:</label>
                    <div class="form-group d-flex justify-content-between align-items-center mb-3">
                        <input hidden type="file" class="custom-file-input" name="thumbnail" id="logo2" accept="image/*">
                        <div class="div">
                            <img id="preview2" src="" class="img-thumbnail"/>
                        </div>
                        <label class="btn btn-primary" for="logo2">Browse</label>
                    </div>
                    <div class="mb-3">
                        <div class="card card-info card-outline">
                            <div class="card-header text-white" style="background-color: #0a4275;">
                                <h5 class="card-title text-center m-0">Video Description</h5>
                            </div>
                            <div class="card-body">
                                <textarea id="editor1" name="description" style="width: 100%"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="<?=$module_id?>" name="module_id">
                    <input type="submit" name="submit" value="Submit" class="btn btn-primary"/>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>


<script src="<?= base_url() ?>assets/plugins/ckeditor/ckeditor.js"></script>

<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    ClassicEditor
      .create(document.querySelector('#editor1'))
      .then(function (editor) {
        // The editor instance
      })
      .catch(function (error) {
        console.error(error)
      })

    // bootstrap WYSIHTML5 - text editor

  
  })
  </script>

  <script>
  $("#forms").addClass('active');
  $("#editors").addClass('active');
</script> 


<script>
    $(document).ready(function() {
        $('#logo').change(function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result).removeClass('d-none');
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('#logo2').change(function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview2').attr('src', e.target.result).removeClass('d-none');
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>