<?php
// var_dump($_SERVER["DOCUMENT_ROOT"]);
// exit;
$dbName = "C:/xampp/htdocs/customtrack/pibpeb/230228111429.BUP";
if (!file_exists($dbName)) {
    die("Could not find database file.");
}
$db = new PDO("odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName; Uid=; Pwd=;");

if ($db) {
    // echo "Connected";
} else {
    die("Connection failed");
}
$totalData   = "SELECT COUNT(*) AS total FROM tblPibPgt";
$execTotal   = $db->query($totalData);
$resultTotal = $execTotal->fetch();
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
        $result = $db->query($query);
        $no     = 0;
        while ($row = $result->fetch()) {
            $no++;
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $row['CAR']; ?></td>
            <?php } ?>
    </tbody>
</table>