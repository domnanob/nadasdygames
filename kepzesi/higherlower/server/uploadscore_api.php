<?php

include 'functions.php';
require_once __DIR__ . '/../../includes/database.php';
$conn = kepzesi_database_connection('higherorlowergame');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    //Csekkolja, hogy mit ad meg a parameterekben
    if(isset($_GET['user_id']) && isset($_GET['score']) && isset($_GET['mode'])){
        $score = filter_var($_GET['score'], FILTER_VALIDATE_INT);
        if ($score === false) {
            http_response_code(422);
            echo json_encode(["success" => false, "error" => "Érvénytelen pontszám."]);
            exit;
        }
        $result = uploadScore((string) $_GET['user_id'], $score, (string) $_GET['mode']);
        if($result){
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "A pontszám mentése nem sikerült."]);
        }

    }
}
