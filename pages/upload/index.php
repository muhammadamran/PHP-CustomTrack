<title>File Uploader | Customs Track - Application</title>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<?php
// SEARCH
$findFileName = '';
if (isset($_POST['find'])) {
    $findFileName = $_POST['findFileName'];
}
// END SEARCH

if (isset($_POST['submit'])) {
    $date   = date('Y-m-d H:i A');
    $by     = $_SESSION['username'];
    $status = "0";

    $cpt = count($_FILES['upload']['name']);
    for ($i = 0; $i < $cpt; $i++) {
        $filename = $_FILES['upload']['name'][$i];
        $tmpname = $_FILES['upload']['tmp_name'][$i];
        $sizename = $_FILES['upload']['size'][$i];
        $exp = explode('.', $filename);
        $ext = end($exp);
        $wdot = substr($filename, 0, -4);
        $uniq_file =  $_FILES['upload']['name'][$i];
        $newname =  $_FILES['upload']['name'][$i];
        $config['upload_path'] = './file/BUPBUE/';
        $config['allowed_types'] = "BUP|BUE";
        $config['max_size'] = '2000000';
        $config['file_name'] = $newname;

        if ($ext == 'BUP' || $ext == 'BUE') {

            $datacheck   =  $db->query("SELECT * FROM tb_bupbue WHERE original_name='$filename'");
            $resultcheck = mysqli_fetch_array($datacheck);
            if ($resultcheck['original_name'] != NULL) {

                echo "<script>window.location.href='index.php?m=upload&s=index&Ducpliacte';</script>";
            } else {
                move_uploaded_file($tmpname, "file/BUPBUE/" . $newname);

                $insert = $db->query("INSERT INTO `tb_bupbue`(`id`, `original_name`, `file_name`, `log_user`, `log_time`, `status`, `type`) 
            	VALUES 
            	('','" . $filename . "','" . $wdot . "','" . $by . "','" . $date . "','" . $status . "','" . $ext . "')");

                if ($insert) {
                    echo "<script>window.location.href='index.php?m=upload&s=index&InsertSuccess';</script>";
                } else {
                    echo "<script>window.location.href='index.php?m=upload&s=index&Failed';</script>";
                }
            }
        } else {
            echo "<script>window.location.href='index.php?m=upload&s=index&Format';</script>";
        }
    }
}

if (isset($_POST["delete_"])) {

    $ID        = $_POST['ID'];

    $delete    = $db->query("DELETE FROM tb_bupbue WHERE id='$ID'");

    if ($delete) {
        echo "<script>window.location.href='index.php?m=upload&s=index&DeleteSuccess';</script>";
    } else {
        echo "<script>window.location.href='index.php?m=upload&s=index&Failed';</script>";
    }
}
?>
<div id="main-content">
    <!-- Heading -->
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>File Uploader</h3>
                    <p class="text-subtitle text-muted">Date <?= date('d F Y') ?> - Time <?= date('H:i A') ?></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">File Uploader</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Heading -->
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Multiple Files</h5>
                    <?php if (isset($_GET['InsertSuccess'])) { ?>
                        <div class="alert alert-success" style="margin-bottom: -35px;">
                            <h4 class="alert-heading">Success</h4>
                            <p>Data saved successfully.</p>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['DeleteSuccess'])) { ?>
                        <div class="alert alert-success" style="margin-bottom: -35px;">
                            <h4 class="alert-heading">Success</h4>
                            <p>Data has been deleted.</p>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['Failed'])) { ?>
                        <div class="alert alert-danger" style="margin-bottom: -35px;">
                            <h4 class="alert-heading">Failed</h4>
                            <p>an error occurred, please try again.</p>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['Format'])) { ?>
                        <div class="alert alert-warning" style="margin-bottom: -35px;">
                            <h4 class="alert-heading">Fortmat</h4>
                            <p>File format should be use .BUP or .BUE!</p>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['Ducpliacte'])) { ?>
                        <div class="alert alert-info" style="margin-bottom: -35px;">
                            <h4 class="alert-heading">Ducpliacte</h4>
                            <p>Data already added on system!</p>
                        </div>
                    <?php } ?>
                </div>
                <div class="card-content">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <p class="card-text">
                                Upload File .BUP or .BUE
                                <br>
                                <font style="margin-top: 5px;color: red;font-size: 14px;"><i>**Note: you can use select all files to upload Click File or Drag File here</i></font>
                            </p>
                            <input type="file" class="form-control" name="upload[]" multiple="multiple" required="required">
                        </div>
                        <div class="modal-footer">
                            <a href="" class="btn btn-light-primary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block"><i class="iconly-boldClose-Square"></i> Reset</span>
                            </a>
                            <button type="submit" name="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block"><i class="iconly-boldUpload"></i> Upload</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex;justify-content: space-between;align-items: center;">
                        <div style="display: grid;align-items: center;">
                            <h5 class="card-title">Last Upload</h5>
                            <?php
                            $total       =  $db->query("SELECT COUNT(*) AS total_record FROM tb_bupbue");
                            $resulttotal = mysqli_fetch_array($total);
                            ?>
                            <font style="font-size: 10px;">Total Upload File: <?= $resulttotal['total_record']; ?> Uploaded</font>
                        </div>
                        <form action="" method="POST">
                            <div style="display: flex;align-items: center;">
                                <input type="text" class="form-control" name="findFileName" placeholder="Search File Name ..." value="<?= $findFileName; ?>">
                                &nbsp;
                                <button type="submit" name="find" class="btn btn-primary"><i class="iconly-boldSearch"></i> </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th style="text-align: center;">File Name</th>
                                <th style="text-align: center;">Type</th>
                                <th style="text-align: center;">Upload By</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['find'])) {
                                $dataTable = $db->query("SELECT * FROM tb_bupbue WHERE original_name LIKE '%$findFileName%' ORDER BY id DESC LIMIT 5");
                            } else {
                                $dataTable = $db->query("SELECT * FROM tb_bupbue ORDER BY id DESC LIMIT 5");
                            }
                            if (mysqli_num_rows($dataTable) > 0) {
                                $no = 0;
                                while ($row = mysqli_fetch_array($dataTable)) {
                                    $no++;
                            ?>
                                    <tr>
                                        <td><?= $no ?>.</td>
                                        <td style="text-align: center;"><?= $row['original_name']; ?></td>
                                        <td style="text-align: center;"><?= $row['type']; ?></td>
                                        <td>
                                            <div style="display: flex;justify-content:flex-start;align-items: center;">
                                                <div class="table-icon">
                                                    <i class="iconly-boldInfo-Square"></i>
                                                </div>
                                                <div style="margin-left: 5px;">
                                                    <div style="font-size: 15px;font-weight: 500;">
                                                        <?= $row['log_user']; ?>
                                                    </div>
                                                    <div style="font-size: 12px;font-weight: 300;">
                                                        <?= $row['log_time']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="badge bg-success"><?= $row['status']; ?></span>
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $row['id'] ?>">
                                                <i class="iconly-boldDelete"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Delete -->
                                    <div class="modal fade text-left" id="delete<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <form action="" method="POST">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title white" id="myModalLabel120">
                                                            Detele Data
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5 class="card-title">Are you sure you want to delete this data?</h5>
                                                        <code><?= $row['original_name'] ?></code>
                                                        <!-- Name -->
                                                        <input type="hidden" name="ID" value="<?= $row['id'] ?>">
                                                        <!-- End Name -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">No</span>
                                                        </button>
                                                        <button type="submit" class="btn btn-danger ml-1" name="delete_">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Yes</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Delete -->
                                <?php } ?>
                            <?php } else { ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            searching: false
        });
    });
</script>