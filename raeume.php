<?php
require("includes/config.inc.php");
require("includes/conn.inc.php");
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Räume</title>
</head>

<body>
    <ul>
        <li><a href="startseite.php">Startseite</a></li>
        <li><a href="klasseninformationen.php">Klasseninformationen</a></li>
        <li><a href="schueler.php">Schüler</a></li>
    </ul>
    <h1>Räume</h1>
</body>

</html>
<!-- Erstellen Sie eine Übersicht über alle Räume und geben Sie ggf. auch den Namen 
der Klasse aus, die in diesem Schuljahr in diesem Raum untergebracht ist -->
<?php
$sql = "
SELECT 
    * 
FROM 
    tbl_raeume;
";
$resultRaum = $conn->query($sql) or die("Fehler in der Query " . $conn->error . "<br>" . $sql);
while ($row = $resultRaum->fetch_assoc()) {
    echo "<ul><li>" . $row["Bezeichnung"] . "</li>";

    if ($row["IDRaum"] != 0) {
        $sql2 = "
        SELECT 
            * 
        FROM 
            tbl_klassen 
        WHERE 
            tbl_klassen.FIDRaum =" . $row["IDRaum"] . "
        ;";
        $resultKlasse = $conn->query($sql2) or die("Fehler in der Query " . $conn->error . "<br>" . $sql2);
        while ($row = $resultKlasse->fetch_assoc()) {
            echo "<ul><li>" . $row["Bezeichnung"] . "</li></ul>";
        }
        echo "</ul>";
    }
}
?>