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

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              
           
              <?php echo form_open(base_url('auth/login/'), 'class="form-horizontal"' )?> 
                <!-- 2 column grid layout with text inputs for the first and last names -->
                 <h2 class="text-center">Login</h2>
                 <?php $this->load->view('admin/includes/_messages.php') ?>
                 
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form3Example3">Email address</label>
                  <input type="email" name="email" id="form3Example3" class="form-control" autocomplete="do-not-autofill" placeholder = "Enter Email Address"/>
                </div>

                

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form3Example4">Password</label>
                  <input type="password" name="password" id="form3Example4" class="form-control" autocomplete="do-not-autofill" placeholder = "Enter Password"/>
                </div>
                <div class="text-center">
                  <p>Login as:</p>
                </div>
                <!-- Password input -->
                 <div class="btn-group d-flex form-outline mb-4 justify-content-center" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="type" id="student" value="student"  autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="student">Student</label>

                    <input type="radio" class="btn-check" name="type" id="instructor" value="instructor" autocomplete="off">
                    <label class="btn btn-outline-primary" for="instructor">Instructor</label>

                </div>
                
                
                <div class="d-flex justify-content-between mb-4">
                  <a href="<?=base_url('auth/forgot_password')?>">Forgot Password?</a>
                    <a href="<?=base_url('auth/signup')?>">Don't have an account? Signup</a>
                </div>
                
                <!-- Submit button -->
                 <div class="text-center">
                     <input type="submit" name="submit" value="Login" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4"/>
                 </div>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->