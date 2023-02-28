<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <h5 class="card-title">Tambah Galeri</h5>
        </div>
        <div class="card-body ">
            <form action="pages/galeri/galeri_proses.php?aksi=insert" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Titla</label>
                    <input id="inputText3" name="title" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputText3" class="col-form-label">Image</label>
                    <input id="inputText3" name="gambar" type="file" class="form-control" style="position:unset;opacity:1">
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