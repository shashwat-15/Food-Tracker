

    <?php
    try {
        $dbh = new PDO("mysql:host=localhost;port=3307;dbname=000790494", "root", "");
    } catch(Exception $e) {
        die("ERROR: Couldn't connect. {$e->getMessage()}");
    }
?>


