<?php 

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_PERSISTENT         => true
];

try {
    $connection = new PDO(
        "mysql:host=".$_ENV['DB_HOST'].";
        dbname=".$_ENV['DB_DATABASE'].";
        charset=utf8",
        $_ENV["DB_USERNAME"],
        $_ENV["DB_PASSWORD"],
        $options        
    );

    //Verify connection
    // echo $connection->getAttribute(PDO::ATTR_SERVER_VERSION);

} catch (PDOException $th) {
    echo $e->getMessage();
}