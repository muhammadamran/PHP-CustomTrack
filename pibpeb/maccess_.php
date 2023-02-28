<?php
$DNS   = "pibdb_local";
$USER  = "Admin";
$PASS  = "MumtazFarisHana";
$db = odbc_connect($DNS, $USER, $PASS);

if ($db) {
    // echo "Connected";
} else {
    die("Connection failed");
}

$totalData   = "SELECT COUNT(*) AS total FROM tblPibPgt";
$execTotal   = odbc_exec($db, $totalData);
$resultTotal = odbc_fetch_array($execTotal);
?>
<h4>Database PIB</h4>
<p>Total Data: <?= $resultTotal['total']; ?> CAR</p>
<table border=1>
    <thead>
        <tr>
            <td>No. </td>
            <td>CAR</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $query  = "SELECT CAR FROM tblPibPgt";
        $result = odbc_exec($db, $query);
        $no     = 0;
        while ($row = odbc_fetch_array($result)) {
            $no++;
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $row['CAR']; ?></td>
            <?php } ?>
    </tbody>
</table>