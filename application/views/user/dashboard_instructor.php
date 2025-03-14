<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>


<style>
  body{
    background-color: #f5f5ff;
  }

  .price_plan_area {
        position: relative;
        z-index: 1;
        background-color: #f5f5ff;
    }
    
    .single_price_plan {
        position: relative;
        z-index: 1;
        border-radius: 0.5rem 0.5rem 0 0;
        -webkit-transition-duration: 500ms;
        transition-duration: 500ms;
        margin-bottom: 50px;
        background-color: #ffffff;
        padding: 3rem 4rem;
    }
    @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .single_price_plan {
            padding: 3rem;
        }
    }
    @media only screen and (max-width: 575px) {
        .single_price_plan {
            padding: 3rem;
        }
    }
    .single_price_plan::after {
        position: absolute;
        content: "";
        background-image: url("https://bootdey.com/img/half-circle-pricing.png");
        background-repeat: repeat;
        width: 100%;
        height: 17px;
        bottom: -17px;
        z-index: 1;
        left: 0;
    }
    .single_price_plan .title {
        text-transform: capitalize;
        -webkit-transition-duration: 500ms;
        transition-duration: 500ms;
        margin-bottom: 2rem;
    }
    .single_price_plan .title span {
        color: #ffffff;
        padding: 0.2rem 0.6rem;
        font-size: 12px;
        text-transform: uppercase;
        background-color: #2ecc71;
        display: inline-block;
        margin-bottom: 0.5rem;
        border-radius: 0.25rem;
    }
    .single_price_plan .title h3 {
        font-size: 1.25rem;
    }
    .single_price_plan .title p {
        font-weight: 300;
        line-height: 1;
        font-size: 14px;
    }
    .single_price_plan .title .line {
        width: 80px;
        height: 4px;
        border-radius: 10px;
        background-color: #3f43fd;
    }
    .single_price_plan .price {
        margin-bottom: 1.5rem;
    }
    .single_price_plan .price h4 {
        position: relative;
        z-index: 1;
        font-size: 2.4rem;
        line-height: 1;
        margin-bottom: 0;
        color: #3f43fd;
        display: inline-block;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-color: transparent;
        background-image: -webkit-gradient(linear, left top, right top, from(#e24997), to(#2d2ed4));
        background-image: linear-gradient(90deg, #e24997, #2d2ed4);
    }
    .single_price_plan .description {
        position: relative;
        margin-bottom: 1.5rem;
    }
    .single_price_plan .description p {
        line-height: 16px;
        margin: 0;
        padding: 10px 0;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -ms-grid-row-align: center;
        align-items: center;
    }
    .single_price_plan .description p i {
        color: #2ecc71;
        margin-right: 0.5rem;
    }
    .single_price_plan .description p .lni-close {
        color: #e74c3c;
    }
    .single_price_plan.active,
    .single_price_plan:hover,
    .single_price_plan:focus {
        -webkit-box-shadow: 0 6px 50px 8px rgba(21, 131, 233, 0.15);
        box-shadow: 0 6px 50px 8px rgba(21, 131, 233, 0.15);
    }
    .single_price_plan .side-shape img {
        position: absolute;
        width: auto;
        top: 0;
        right: 0;
        z-index: -2;
    }
    
    .section-heading h3 {
        margin-bottom: 1rem;
        font-size: 3.125rem;
        letter-spacing: -1px;
    }
    
    .section-heading p {
        margin-bottom: 0;
        font-size: 1.25rem;
    }
    
    .section-heading .line {
        width: 120px;
        height: 5px;
        margin: 30px auto 0;
        border-radius: 6px;
        background: #2d2ed4;
        background: -webkit-gradient(linear, left top, right top, from(#e24997), to(#2d2ed4));
        background: linear-gradient(to right, #e24997, #2d2ed4);
    }

    
 

</style>


</style>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-8 col-lg-6">
      <!-- Section Heading-->
      <div class="section-heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
        <h6 class="mt-4">Contribute Your Expertise</h6>
        <h3>Share Your Knowledge with the Community</h3>
        <p>Our platform thrives on the diverse expertise of educators like you. Help others achieve their educational goals by adding engaging and comprehensive courses to our platform.</p>
        <div class="line"></div>
      </div>
    </div>
  </div>
</div>



<div class="content-wrapper" style="min-height: 100vh;" >
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header text-white" style="background-color: #0a4275;">
        <div class="d-flex justify-content-between align-items-center">
          <h3 class="card-title m-0"><i class="fa fa-list"></i>&nbsp; Your Courses</h3>
            <a href="<?= base_url('instructor/add_course'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Course</a>
        </div>
      </div>
    </div>
    <div class="card" >
      <div class="card-body table-responsive " >
        <table id="na_datatable" class="table table-hover" width="100%" >
          <thead class="table-dark">
            <tr>
              <th>#id</th>
              <th>Name</th>
              <th>Created Date</th>
              <th>Status</th>
              <th class="text-right">Action</th>
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
    "ajax": "<?=base_url('dashboard/datatable_json')?>",
    "order": [[0,'asc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true, 'className':'text-center'},
    { "targets": 1, "name": "name", 'searchable':true, 'orderable':true, 'className':'text-center'},
    { "targets": 2, "name": "created_at", 'searchable':false, 'orderable':false, 'className':'text-center'},
    { "targets": 3, "name": "is_active", 'searchable':true, 'orderable':true, 'className':'text-center'},
    { "targets": 4, "name": "Action", 'searchable':false, 'orderable':false,'width':'200px', 'className':'text-center'}
    ]
  });
</script>