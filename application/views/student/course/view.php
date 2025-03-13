<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>


<div class="content-wrapper" >
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header text-white" style="background-color: #0a4275;">
        <div class="d-flex justify-content-between align-items-center">
          <h3 class="card-title m-0"><i class="fa fa-list"></i>&nbsp; <?=$course['course_name']?> - Modules</h3>
          <?php if(!$course_owned):?>
            <a href="<?= base_url('payment/checkout/'.$course['course_id']); ?>" class="btn btn-success"><i class="fa-solid fa-cart-shopping"></i>Buy Course</a>
          <?php endif?>
        </div>
      </div>
      <div class="description m-4" style='height: 20vh; overflow-y: scroll;'>
          <?=$course['description']?>
      </div>
    </div>
    <div class="card" style="min-height: 100vh;">
      <div class="card-body table-responsive " style="background-color: #f5f5ff;">
        <table id="na_datatable" class="table table-hover" width="100%" >
          <thead class="table-dark">
            <tr>
              <th class="text-center">#id</th>
              <th class="text-center">Module Name</th>
              <th class="text-center">Instructor's name</th>
              <th class="text-center">Course name</th>
              <th class="text-center">Created Date</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>  
</div>



<script>
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('student/datatable_json_module/'.$course['course_id'])?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true, 'className':'text-center'},
    { "targets": 1, "name": "name", 'searchable':true, 'orderable':true, 'className':'text-center'},
    { "targets": 2, "name": "created_at", 'searchable':false, 'orderable':false, 'className':'text-center'},
    { "targets": 3, "name": "instructors_name", 'searchable':true, 'orderable':true, 'className':'text-center'},
    { "targets": 4, "name": "course_name", 'searchable':true, 'orderable':true, 'className':'text-center'},
    { "targets": 5, "name": "Action", 'searchable':false, 'orderable':false,'width':'200px', 'className':'text-center'}
    ]
  });
</script>