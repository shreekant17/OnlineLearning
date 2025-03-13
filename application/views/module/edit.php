<section style="min-height: 100vh;">
    <div class="container mt-5">
        <div class="card">
          <div class="card-header text-white" style="background-color: #0a4275;">
              <h2 class="text-center m-0">Module Details</h2>
          </div>
          <div class="card-body">
              <?php $this->load->view('admin/includes/_messages.php') ?>
              <?php echo form_open(base_url('instructor/edit_module/'.$module["module_id"]), 'class="form-horizontal"');  ?> 
                  <div class="mb-3">
                      <label for="moduleName" class="form-label">Module Name</label>
                      <input type="text" class="form-control" id="moduleName" name="module_name" value="<?=$module['module_name']?>" placeholder="Enter module name">
                  </div>
                  <div class="mb-3">
                      <div class="card card-info card-outline">
                          <div class="card-header text-white" style="background-color: #0a4275;">
                              <h5 class="card-title text-center m-0">Module Description</h5>
                          </div>
                          <div class="card-body">
                              <div class="mb-3">
                                  <textarea id="editor1" name="description" style="width: 100%"><?=$module['description']?></textarea>
                              </div>
                          </div>
                      </div>
                  </div>
                  <input type="hidden" value="<?=$module['course_id']?>" name="course_id">
                  <input type="submit" name="submit" value="Save" class="btn btn-primary"/>
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