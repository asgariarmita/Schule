<?php
require("includes/config.inc.php");
require("includes/conn.inc.php");
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Schüler</title>
</head>

<body>
    <ul>
        <li><a href="startseite.php">startseite</a></li>
        <li><a href="klasseninformationen.php">Klasseninformationen</a></li>
        <li><a href="raeume.php">Räume</a></li>
    </ul>
    <h1>Startseite</h1>
    <form action="schueler.php" method="post">
        <label>Vorname:</label>
        <input type="text" name="vn">
        <label>Nachname:</label>
        <input type="text" name="nn">
        <button>Submit</button>
    </form>
</body>

</html>
<!-- Geben Sie alle Schüler, sortiert nach Nach- und Vornamen in einer Liste aus. 
Erstellen Sie eine Möglichkeit, nach Schülern zu suchen, und zwar nach sowohl dem 
Nach-, als auch nach dem Vornamen (nur Nachname, nur Vorname oder beides 
gemeinsam). Gehen Sie dabei so vor, dass nur ein Teil des Namens eingegeben 
werden muss, sodass sie ein entsprechendes Suchergebnis erzielen: wird 
beispielsweise im Nachnamen »ler« eingegeben, so sollen die Namen »Müller«, 
»Obermüller«, »Lernfried«, »Kettler« usw. ausgeworfen werden -->
<?php
if (count($_POST) > 0) {
    if (strlen($_POST["vn"]) > 0) {
        $arr[] = "tbl_schueler.Vorname LIKE '" . $_POST["vn"] . "%'";
    }
    if (strlen($_POST["nn"]) > 0) {
        $arr[] = "tbl_schueler.Nachname LIKE '" . $_POST["nn"] . "%'";
    }
    $sql = "
    SELECT 
        * 
    FROM 
        tbl_schueler
    WHERE(
        " . implode(" AND ", $arr) . "
    )
    ORDER BY 
        tbl_schueler.Vorname, tbl_schueler.Nachname ASC;
    ";
    $resultSchueler = $conn->query($sql) or die("Fehler in der Query " . $conn->error . "<br>" . $sql);
    while ($row = $resultSchueler->fetch_assoc()) {
        echo "<ul><li>";
        echo $row["Vorname"] . " " . $row["Nachname"] . " , Geburtsdatum: " . $row["GebDatum"];
        echo "</li></ul>";
    }
} else {
    $sql = "
    SELECT 
        * 
    FROM 
        tbl_schueler
    ORDER BY 
        tbl_schueler.Vorname, tbl_schueler.Nachname ASC;
    ";
    $resultSchueler = $conn->query($sql) or die("Fehler in der Query " . $conn->error . "<br>" . $sql);
    while ($row = $resultSchueler->fetch_assoc()) {
        echo "<ul><li>";
        echo $row["Vorname"] . " " . $row["Nachname"] . " , Geburtsdatum: " . $row["GebDatum"];
        echo "</li></ul>";
    }
}

?>