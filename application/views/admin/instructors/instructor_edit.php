  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
            <h3 class="card-title"> <i class="fa fa-pencil"></i>
              &nbsp; <?= trans('edit_instructor') ?> </h3>
            </div>
            <div class="d-inline-block float-right">
              <a href="<?= base_url('admin/instructor'); ?>" class="btn btn-success"><i class="fa fa-list"></i> <?= trans('instructors_list') ?></a>
              <a href="<?= base_url('admin/instructor/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> <?= trans('add_new_instructor') ?></a>
            </div>
          </div>
          <div class="card-body">

           <!-- For Messages -->
           <?php $this->load->view('admin/includes/_messages.php') ?>
           
           <?php echo form_open(base_url('admin/instructor/edit/'.$instructor['instructor_id']), 'class="form-horizontal"' )?> 
           
          <div class="form-group">
            <label for="firstname" class="col-md-2 control-label"><?= trans('firstname') ?></label>

            <div class="col-md-12">
              <input type="text" name="firstname" value="<?= $instructor['firstname']; ?>" class="form-control" id="firstname" placeholder="">
            </div>
          </div>

          <div class="form-group">
            <label for="lastname" class="col-md-2 control-label"><?= trans('lastname') ?></label>

            <div class="col-md-12">
              <input type="text" name="lastname" value="<?= $instructor['lastname']; ?>" class="form-control" id="lastname" placeholder="">
            </div>
          </div>

          <div class="form-group">
            <label for="email" class="col-md-2 control-label"><?= trans('email') ?></label>

            <div class="col-md-12">
              <input type="email" name="email" value="<?= $instructor['email']; ?>" class="form-control" id="email" placeholder="">
            </div>
          </div>
         
            <div class="form-group">
              <label for="mobile_no" class="col-md-2 control-label"><?= trans('mobile_no') ?></label>

              <div class="col-md-12">
                <input type="number" name="mobile_no" value="<?= $instructor['mobile_no']; ?>" class="form-control" id="mobile_no" placeholder="">
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-md-12">
                <input type="submit" name="submit" value="<?= trans('update_instructor') ?>" class="btn btn-primary pull-right">
              </div>
            </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.box-body -->
        </div>  
      </section> 
    </div>