<style>
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

    /* Hide scrollbar for Chrome, Safari and Opera */
      *::-webkit-scrollbar {
        display: none;
      }

      /* Hide scrollbar for IE, Edge and Firefox */
      * {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
      }

      .card{
        padding: 50px !important;
      }
</style>



<link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css"> 
<section class="price_plan_area section_padding_130_80" id="pricing">
  <br>
      <h3 class="text-center">Courses You are currently enrolled in</h3>
      <div class="py-5">
        <div class="container">
          <div class="row hidden-md-up">
            <?php foreach($purchased_courses as $p_course):?>
              <div class="col-md-4" >
                <div class="card" style="height: 100%; background: url(<?=base_url('uploads/images/card-bg.jpg')?>) no-repeat center center / cover;">

                  <div class="card-block">
                    <h4 class="card-title"><?=$p_course['course_name']?></h4>
                    <h6 class="card-subtitle text-muted">By - <?=$p_course['firstname']. ' '.$p_course['lastname']?></h6>
                    <p class="card-text p-y-1 mt-2"> <?=$p_course['title']?></p>
                    <div class="text-center">
                      <a href="<?=base_url('student/course/'.$p_course['course_id'])?>" class="btn btn-success">Continue Learning</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-sm-8 col-lg-6">
            <!-- Section Heading-->
            <div class="section-heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
              <h6>More Available Courses</h6>
              <h3>Discover Your Learning Path</h3>
              <p>Our platform offers a diverse range of courses designed to be engaging, comprehensive, and accessible, helping you achieve your educational goals.</p>
              <div class="line"></div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <!-- Single Price Plan Area-->
          <?php foreach($all_courses as $key=>$course):?>
          <?php if((int)$key%2==0):?>
          <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <div class="single_price_plan wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
              
              <div class="title">
                <h3><?= $course['course_name'] ?></h3>
                <p>By - <?= $course['firstname'].' '.$course['lastname'] ?></p>
                <div class="line"></div>
              </div>
              <div class="price">
                <h4>₹<?=$course['price']?></h4>
              </div>
              <div class="description" style="height: 200px; overflow-y: scroll">
                <div class='d-block'>
                  <?=$course['description']?>
                </div >
              </div>
              <div class="button"><a class="btn btn-success btn-2" href="<?=base_url('student/course/'.$course['course_id'])?>">Get Started</a></div>
            </div>
          </div>
          <?php else:?>
            
          <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <div class="single_price_plan wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
              <div class="side-shape"><img src="https://bootdey.com/img/popular-pricing.png" alt=""></div>
              <div class="title">
                <h3><?= $course['course_name'] ?></h3>
                <p>By - <?= $course['firstname'].' '.$course['lastname'] ?></p>
                <div class="line"></div>
              </div>
              <div class="price">
                <h4>₹<?=$course['price']?></h4>
              </div>
              <div class="description" style="height: 200px; overflow-y: scroll">
                <?=$course['description']?>
              </div>
              <div class="button"><a class="btn btn-success btn-2" href="<?=base_url('student/course/'.$course['course_id'])?>">Get Started</a></div>
            </div>
          </div>
          <?php endif;?>
          <?php endforeach; ?>
          <!-- Single Price Plan Area-->
          
        </div>
      </div>
    </section>