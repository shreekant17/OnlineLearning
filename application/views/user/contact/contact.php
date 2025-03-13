<section class="container py-5" style="min-height: 100vh;">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center text-white" style="background-color: #0a4275;">
                <h2>Get in Touch</h2>
            </div>
          <div class="card-body">
            <?php $this->load->view('admin/includes/_messages.php') ?>
            <?php echo form_open(base_url('contact/'), 'class="form-horizontal"');  ?> 

              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <br>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required>
              </div>
              <br>
              <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" name="subect" class="form-control" id="subject" placeholder="Subject" required>
              </div>
              <br>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" name="message" id="message" rows="5" placeholder="Your Message" required></textarea>
              </div>
              <br>
              <input type="submit"  name="submit" value="Send Message" class="btn btn-primary btn-block"/>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </section>