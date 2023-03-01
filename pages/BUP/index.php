<title>BUP | Customs Track - Application</title>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<?php
// SEARCH
$findFileName = '';
if (isset($_POST['find'])) {
    $findFileName = $_POST['findFileName'];
}
?>
<div id="main-content">
    <!-- Heading -->
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>BUP</h3>
                    <p class="text-subtitle text-muted">Date <?= date('d F Y') ?> - Time <?= date('H:i A') ?></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">BUP</li>
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
                    <div style="display: flex;justify-content: space-between;align-items: center;">
                        <div style="display: grid;align-items: center;">
                            <h5 class="card-title">Last Upload</h5>
                            <?php
                            $total       =  $db->query("SELECT COUNT(*) AS total_record FROM tb_bupbue WHERE type='BUP'");
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
                                <th style="text-align: center;">Total Record</th>
                                <th style="text-align: center;">Upload By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['find'])) {
                                $dataTable = $db->query("SELECT * FROM tb_bupbue WHERE type='BUP' AND original_name LIKE '%$findFileName%' ORDER BY id DESC");
                            } else {
                                $dataTable = $db->query("SELECT * FROM tb_bupbue WHERE type='BUP' ORDER BY id DESC");
                            }
                            if (mysqli_num_rows($dataTable) > 0) {
                                $no = 0;
                                while ($row = mysqli_fetch_array($dataTable)) {
                                    $no++;
                            ?>
                                    <tr>
                                        <td><?= $no ?>.</td>
                                        <td style="text-align: center;">
                                            <a href="index.php?m=BUP&s=bup&data=<?= $row['file_name']; ?>">
                                                <font style="font-weight: 900;"><?= $row['original_name']; ?></font>
                                            </a>
                                        </td>
                                        <?php
                                        $fileBUP   = $row['original_name'];
                                        $dbName    = $_SERVER["DOCUMENT_ROOT"] . "customtrack/file/BUPBUE/$fileBUP";
                                        if (!file_exists($dbName)) {
                                            die("Could not find database file.");
                                        }
                                        $dbAccess = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName; Uid=; Pwd=;");

                                        if ($dbAccess) {
                                            // echo "Connected";
                                        } else {
                                            die("Connection failed");
                                        }
                                        $totalData   = "SELECT COUNT(*) AS total FROM tblPibHdr";
                                        $execTotal   = $dbAccess->query($totalData);
                                        $resultTotal = $execTotal->fetch();
                                        ?>
                                        <td style="text-align: center;"><?= $resultTotal['total']; ?></td>
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
                                    </tr>
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