
<section class="" >
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%); min-height: 100vh;">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
        <h1 class="my-5 display-3 fw-bold ls-tight">
            Unlock Your Potential <br />
            <span class="text-primary">with Our Online Courses</span>
        </h1>
        <p style="color: hsl(217, 10%, 50.8%)">
            Discover a wide range of courses designed to help you achieve your goals. 
            Whether you're looking to advance your career, learn a new skill, or explore a new passion, 
            our expert instructors and flexible learning options make it easy to get started. 
            Join our community of learners today and start your journey towards success!
        </p>
        </div>

        <div class="col-lg-5 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
                
                <form method="POST" id="form" class="form-horizontal">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <h2 class="text-center">Verify OTP</h2>
                <?php $this->load->view('admin/includes/_messages.php') ?>
            
                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="text" name="otp" id="form3Example4" class="form-control" placeholder="Enter OTP" />
                </div>
                
                <div class="text-end mb-4">
                    <a href="<?=base_url('auth/resend_otp')?>">Resend OTP</a>
                </div>

                <input type="hidden" name="email" value="<?=$email?>">
                <input type="hidden" name="id" value="<?=$id?>">
                <input type="hidden" name="type" value="<?=$type?>">
                
                <!-- Submit button -->
                 <div class="text-center">
                     <input type="submit" name="submit" value="Submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4"/>
                 </div>
              </form>

              <form id="form2" method="post" action="<?=base_url('auth/reset_password')?>">
                <input type="hidden" name="id" value="<?=$id?>">
                <input type="hidden" name="type" value="<?=$type?>">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->


<script>
          $('#form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '<?php echo base_url("auth/verify_reset_password"); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if(response){
                        
                        $("#form2").submit();
                    }else{
                        $.notify("Incorrect OTP", "error");
                    }
                },
                error: function(error) {
                    console.log(error);
                    alert('File upload failed!');
                    
                }
            });
        });
</script>