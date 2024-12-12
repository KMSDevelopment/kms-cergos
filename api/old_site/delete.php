<?php
include "../db.php";

$query45 = "SELECT * FROM revisions WHERE api_id='6'";

$data45=mysqli_query($i_conn,$query45);   

while($row45=mysqli_fetch_array($data45)){
    $revision_id = $row45['id'];

    // sql to delete a record
    $sql = "DELETE FROM revision_parts WHERE revision_id='$revision_id'";

    if (mysqli_query($i_conn, $sql)) {
        echo "Revision Part deleted successfully<Br/>";
    }

    $sql2 = "DELETE FROM revisions WHERE id='$revision_id'";

    if (mysqli_query($i_conn, $sql2)) {
        echo "Revision $revision_id deleted successfully<Br/>";
    }
};