<style>
        body {
            background-color: #f5f5ff;
        }
        .edit-profile-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 600px;
            margin: auto; /* To center the container */
        }
        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
    </style>

    <section style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">

        <div class="container mt-5 edit-profile-container">
            <div class="card">
                <div class="card-header text-center text-white" style="background-color: #0a4275;">
                    <h2>Edit Profile</h2>
                </div>
                <div class="card-body">
                    <?php $this->load->view('admin/includes/_messages.php') ?>
                    <?php echo form_open_multipart(base_url('profile'), 'class="form-horizontal"'); ?> 
                        <div class="form-group text-center">
                            <img src="<?=$profile['image'] ? base_url($profile['image']) : base_url('uploads/profiles/default.png')?>" alt="Profile Picture" class="profile-pic" id="profile-pic-preview">
                            <div class="mb-3 mt-3">
                                <input type="file" class="form-control" name="userfile" id="profile-pic" accept="image/*" hidden>
                                <label class="form-label mt-2 btn btn-success" for="profile-pic" id="profile-pic-label">Choose Profile Picture</label>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?=$profile['firstname']?>" placeholder="Enter your first name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?=$profile['lastname']?>" placeholder="Enter your last name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?=$profile['email']?>" readonly placeholder="Enter your email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="mobile_no">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="<?=$profile['mobile_no']?>" placeholder="Enter your mobile number">
                        </div>
                        <input type="submit" name="submit" value="Save Changes" class="btn btn-primary btn-block"/>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </section>

  
    <script>
        // Display file name for the selected profile picture
        $('#profile-pic').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $('#profile-pic-label').html(fileName);

            // Preview the selected image
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#profile-pic-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });
    </script>