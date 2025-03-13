<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body{
         background-color: #f5f5ff;
    }
     .comment-box {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            background: white;
        }
        .reply-box {
            margin-left: 50px;
        }
        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .comment-content {
          width: 100%;
            margin-left: 15px;
        }
        .comment-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
</style>
<link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />

  <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
  <!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->



<div class="container mt-5 d-flex justify-content-between" style="min-height: 100vh; gap: 10px;">
 
    <div class="col-md-8">
      <video
        id="my-video"
        class="video-js col-md-12"
        controls
        preload="auto"
        width="720"
        height="446"
        poster="<?=base_url($lesson['video_thumbnail'])?>"
        data-setup="{}"
      >
        <source src="<?=base_url($lesson['video_src'])?>" type="video/mp4" />
        <p class="vjs-no-js">
          To view this video please enable JavaScript, and consider upgrading to a
          web browser that
          <a href="https://videojs.com/html5-video-support/" target="_blank">
            supports HTML5 video</a>.
        </p>
      </video>

      <h3 class="m-2"><?=$lesson['lesson_name']?></h3>

      <nav class="mt-3">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Description</button>
          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Comments</button>
          <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Notes</button>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <div class="card" style="border-top: none; border-top-left-radius: 0;">
            <div class="card-body">
              <h5 class="card-title"><?= $lesson['lesson_name']?></h5>
              <div class="card-text" style="height: 40vh; overflow-y: scroll;">
                <?= $lesson['description']?>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" >
          <div class="mb-4">
              <textarea class="form-control" id="commentText" rows="1" placeholder="Add a comment..."></textarea>
              <button class="btn btn-primary mt-2" id="postComment">Post Comment</button>
          </div>
          <div class="comment_box" style="height: 80vh; overflow-y: scroll;">

          </div>
          
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
          <div class="card">
            <div class="card-header text-white" style="background-color: #0a4275;">
                <h3 class="card-title m-0">Notes</h3>
            </div>
            <div class="card-body table-responsive" style="background-color: #fafaff;">
              <table id="na_datatable" class="table table table-hover" width="100%" >
                <thead class="table-dark">
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>PDF</th>
                    <th>Created Date</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      
    </div>

    <div class="col-md-4">
     <div class="card">
            <div class="card-header text-white" style="background-color: #0a4275;">
                <h3 class="card-title m-0"><?=$module['module_name']?> - Lessons</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Description</h5>
                <div class="card-text" style="height: 50vh; overflow-y:scroll;"><?=$module['description']?></div>
                <ul class="list-group list-group-flush" style="max-height: 50vh; overflow-y: scroll;">
                  <?php foreach($all_lessons as $l):?>
                    <a href="<?=base_url('student/lesson/'.$l['lesson_id'])?>" style="text-decoration: none; cursor: pointer;">
                      <li class="list-group-item d-flex justify-content-start align-items-center" style="gap: 5px;">
                        <img src="<?=base_url($l['video_thumbnail'])?>" alt="" style="width: 150px; height: 100px; border-radius: 2px; object-fit: cover; ">
                        <h6 style="width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?=$l['lesson_name']?></h6>
                      </li>
                    </a>
                  <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
 
</div>

  <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>



  <script>

    function comments(){
      $.ajax({
          url: '<?=base_url("comment/get_comments")?>',  // URL to send the request to
          type: 'POST',           // HTTP method (GET, POST, etc.)
          data: {
              lesson_id: "<?=$lesson['lesson_id']?>", // Data to send with the request
          },
          success: function(response) {
            console.log(JSON.parse(response))

            
              response = JSON.parse(response);
              $('.comment_box').html("")
                
              Object.keys(response).forEach(function(key) {
                var comment = response[key];
                
                $('.comment_box').append(
                  "<div class='comment-box' id='"+comment.comment_id+"'>"+
                        "<div class='d-flex'>"+
                            "<img src='"+"<?=base_url()?>"+comment.image+"' alt='Profile Picture' class='profile-pic'>"+
                            "<div class='comment-content'>"+
                                "<div class='comment-header'>"+
                                    "<strong>"+comment.firstname+" "+comment.lastname+"</strong>"+
                                    "<span class='text-muted'>"+comment.created_at+"</span>"+
                                "</div>"+
                                "<p>"+comment.comment+"</p>"+
                                "<div class='d-flex justify-content-between' style='gap: 2px;'>"+
                                  "<textarea class='form-control' id='comment_"+comment.comment_id+ "' rows='1' placeholder='Reply...'></textarea>"+
                                  "<button class='btn btn-secondary' data-id='"+comment.comment_id+"' onclick=add_reply(this) >Post</button>"+
                                "</div>"+
                            "</div>"+
                        "</div>"+
                    "</div>"
                );
                replies(comment.comment_id)
              })
                
          },
          error: function(xhr, status, error) {
            
              console.error(error);
          }
      });
    }

    function replies(comment_id){
      $.ajax({
          url: '<?=base_url("comment/get_replies")?>',  // URL to send the request to
          type: 'POST',           // HTTP method (GET, POST, etc.)
          data: {
              comment_id: comment_id, // Data to send with the request
          },
          success: function(response) {

                response = JSON.parse(response);
                console.log(response);
                Object.keys(response).forEach(function(key) {
                  var reply = response[key];
                  console.log(key)
                  $('#'+comment_id).append(
                    "<div class='comment-box reply-box mt-2'>"+
                          "<div class='d-flex'>"+
                              "<img src='"+"<?=base_url()?>"+reply.image+"' alt='Profile Picture' class='profile-pic'>"+
                              "<div class='comment-content'>"+
                                  "<div class='comment-header'>"+
                                      "<strong>"+reply.firstname+' '+reply.lastname+"</strong>"+
                                      "<span class='text-muted'>"+reply.created_at+"</span>"+
                                  "</div>"+
                                  "<p>"+reply.reply+"</p>"+
                              "</div>"+
                          "</div>"+
                      "</div>"
                  );
                })
          },
          error: function(xhr, status, error) {
            
              console.error(error);
          }
      });
    }



    function add_comment(comment){
      $.ajax({
          url: '<?=base_url("comment/add_comment")?>',  // URL to send the request to
          type: 'POST',           // HTTP method (GET, POST, etc.)
          data: {
              comment: comment, // Data to send with the request
              lesson_id: "<?=$lesson['lesson_id']?>",
          },
          success: function(response) {
            comments();
          },
          error: function(xhr, status, error) {
              console.error(error);
          }
      });
    }


    
  

    function add_reply(comment_reply){

      comment_id = comment_reply.getAttribute('data-id');
      reply = $("#comment_"+comment_id).val().trim();
      console.log(comment_id);

      if(reply!=""){
          $.ajax({
            url: '<?=base_url("comment/add_reply")?>',  // URL to send the request to
            type: 'POST',           // HTTP method (GET, POST, etc.)
            data: {
                reply: reply, // Data to send with the request
                comment_id: comment_id,
            },
            success: function(response) {
              comments();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

      }
    }

    $(document).ready(function(){
      comments();

      $("#postComment").on('click', function(){
        var comment = $("#commentText").val().trim();
        $("#commentText").val("");
        if (comment!=""){
          add_comment(comment);
        }
      })

      $("#post_reply_to_comment_").on('click', function(){
        var comment = $("#commentText").val().trim();
        $("#commentText").val("");
        if (comment!=""){
          add_comment(comment);
        }
      })

      $('#na_datatable').DataTable({
            "processing": true,
            "serverSide": false,
            "ajax": "<?=base_url('pdf/datatable_json_pdf/'.$lesson['lesson_id'])?>",
            "order": [[0,'asc']],
            "columnDefs": [
            { "targets": 0, "name": "id", 'searchable':true, 'orderable':true, 'className':'text-center'},
            { "targets": 1, "name": "Title", 'searchable':true, 'orderable':true, 'className':'text-center'},
            { "targets": 2, "name": "pdf", 'searchable':true, 'orderable':true, 'className':'text-center'},
            { "targets": 3, "name": "created_at", 'searchable':false, 'orderable':false, 'className':'text-center'},
            { "targets": 4, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px', 'className':'text-center'}
            ]
        });
    })
  </script>
