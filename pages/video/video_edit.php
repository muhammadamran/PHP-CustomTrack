<?php
    $data = $db->query('SELECT * FROM video WHERE id="'.$_GET['id'].'"');
    $row = $data->fetch_assoc()
?>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <h5 class="card-title">Update Video</h5>
        </div>
        <div class="card-body ">
            <form action="pages/video/video_proses.php?aksi=update&id=<?= $_GET['id'] ?>" method="POST">
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Title</label>
                    <input id="inputText3" name="title" type="text" value="<?= $row['title'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">ID Video Youtube</label>
                    <input id="inputText3" name="video" type="text" value="<?= $row['video'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>