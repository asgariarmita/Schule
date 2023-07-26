<?php
require("includes/config.inc.php");
require("includes/conn.inc.php");
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Klasseninformationen</title>
</head>

<body>
    <ul>
        <li><a href="klasseninformationen.php">Klasseninformationen</a></li>
        <li><a href="schueler.php">Schüler</a></li>
        <li><a href="raeume.php">Räume</a></li>
    </ul>
    <h1>Klasseninformationen</h1>
</body>

</html>
<!-- Geben Sie die Klasseninformationen aus: Name der Klasse, Raumnummer,
Klassenvorstand sowie sämtliche Schüler, welche diese Klasse besuchen -->
<?php
$sql = "
    SELECT 
        tbl_klassen.IDKlasse, tbl_klassen.Bezeichnung, tbl_raeume.Bezeichnung as 'klass', 
        tbl_schueler.Vorname, tbl_schueler.Nachname
    FROM 
        tbl_klassen 
    INNER JOIN 
        tbl_raeume
    ON 
        tbl_klassen.FIDRaum = tbl_raeume.IDRaum
    INNER JOIN 
        tbl_schueler
    ON 
        tbl_klassen.FIDKV = tbl_schueler.IDSchueler;
    ";
$resultRaume = $conn->query($sql) or die("Fehler in der Query " . $conn->error . "<br>" . $sql);
while ($row = $resultRaume->fetch_assoc()) {
    echo "<ul><li>";
    echo "Name der Klasse: " . $row["Bezeichnung"];
    echo ", Raumnummer: " . $row["klass"];
    echo ", Klassenvorstand: " . $row["Vorname"] . " " . $row["Nachname"] . "</li><br>";

    if ($row["IDKlasse"] != 0) {
        $sql2 = "
        SELECT 
            tbl_schueler.Vorname, tbl_schueler.Nachname, tbl_klassen.IDKlasse
        FROM 
            tbl_schueler
        INNER JOIN 
            tbl_klassen
        ON 
            tbl_schueler.FIDKlasse = tbl_klassen.IDKlasse
        WHERE(
            tbl_klassen.IDKlasse = " . $row["IDKlasse"] . " 
        );";
        $resultSchueler = $conn->query($sql2) or die("Fehler in der Query " . $conn->error . "<br>" . $sql2);
        while ($row = $resultSchueler->fetch_assoc()) {
            echo "<ul><li>" . $row["Vorname"] . " " . $row["Nachname"] . "</li></ul>";
        }
        echo "</ul>";
    }
}

?>