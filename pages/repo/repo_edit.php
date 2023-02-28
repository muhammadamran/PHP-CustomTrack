<?php
    $data = $db->query('SELECT * FROM repo WHERE id="'.$_GET['id'].'"');
    $row = $data->fetch_assoc()
?>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <h5 class="card-title">Update Repository</h5>
        </div>
        <div class="card-body ">
            <form action="pages/repo/repo_proses.php?aksi=update&id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Nama File</label>
                    <input id="inputText3" name="nam_file" type="text" value="<?= $row['nama_file'] ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Image</label>
                    <input id="inputText3" name="image" type="file" class="form-control" style="position:unset;opacity:1">
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