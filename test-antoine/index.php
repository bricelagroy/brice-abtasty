<?php
// Compte client, à la fois d’AB Tasty et de la DMP
$AccountID = 'bba1c27bf34a03a5e089e1c7e133aedb';

// Pour appeler & afficher les "segment" via API
$url_segment = 'https://api-data-connector-eu.abtasty.com/accounts/' . $AccountID . '/segments'; 
$json_segment = file_get_contents($url_segment); 
$parsed_json_segment = json_decode($json_segment,true);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="icon" type="image/png" href="visuels/favicons.png" />
    <title>AB Tasty : segments</title>
</head>

<body class="container-fluid w-75 mx-auto text-center mt-5">
    <div class="mb-3">
        <a href="https://www.abtasty.com/fr/">
            <img src="visuels/abtasty-logo.svg" alt="AB Tasty Logo" title="AB Tasty Logo" width="300">
        </a>
    </div>
    <div class="mb-3">
        <img src="visuels/logo-dmp-example.png" alt="DMP_EXAMPLE logo" title="DMP_EXAMPLE logo" width="300">
    </div>
    <div class="d-flex justify-content-center">
        <div class="row w-100">
            <div class="col-sm col-lg p-3 m-2 bg-ab text-white rounded">
                <div>
                    <h2>Liste des segments poussés</h2>
                </div>  
                <div>
                    <div class="btn-group m-3">
                        <button type="button" class="btn btn-warning dropdown-toggle p-2" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Segments
                        </button>
                        <ul class="dropdown-menu">
                            <?php
                                // Pour afficher les différents segments
                                for($i=0;$i<count($parsed_json_segment);$i++){
                                    echo '<li class="dropdown-item">' . $parsed_json_segment[$i]['name'] . '</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Mise en place d'un formulaire, afin de récolter "visitor_id" et "segment" via la methode "GET" -->
            <div class="col-sm col-md col-lg p-3 m-2 bg-ab text-white rounded">
                <form action="" method="GET">
                    <div class="form-group">
                        <label class="fw-bold" for="exampleInputEmail1">visitor_id</label>
                        <input type="text" class="form-control" name="visitor_id" required>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold" for="exampleInputEmail1">segment</label>
                        <select class="form-control" id="segment" name="segment" required>
                            <option value=""></option>
                            <?php
                                    // Pour afficher les différents segments
                                    for($i=0;$i<count($parsed_json_segment);$i++){
                                        echo '<option value="' . $parsed_json_segment[$i]['name'] . '">' . $parsed_json_segment[$i]['name'] . '</option>';
                                    }
                                ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <input type="submit" name="submit" class="btn btn-warning my-3 p-2">
                    </div>
                    
                </form>

                <?php
                    // Message Alerte, pour savoir si oui ou non, le visitor_id renseigné appartient au segment
                    // Les "required" dans les inputs du formulaire permettent de ne pas avoir de champs vident lors du submit
                    // Conditions :
                        // Si le bouton est submit, est que les champs sont remplis
                            // Soit le visitor_id appartient bien au segment séléctionné --> message avec background vert
                            // Soit le visitor_id n'appartient pas au segment séléctionné --> message avec background rouge
                            // Soit le visitor_id n'existe pas --> message avec background rouge
                    
                    if(isset($_GET['submit'])){
                        $visitor_id = $_GET['visitor_id'];
                        $segment = $_GET['segment'];

                        $url_visitor_id = 'https://api-data-connector-eu.abtasty.com/accounts/' . $AccountID . '/' . 'segments/' . $visitor_id; 
                        $json_visitor_id = file_get_contents($url_visitor_id); 
                        $parsed_json_visitor_id = json_decode($json_visitor_id,true);

                            if(!empty($segment) && isset($parsed_json_visitor_id[0]['visitor_id'])){
                                if($parsed_json_visitor_id[0]['visitor_id'] == $visitor_id && $parsed_json_visitor_id[0]['segment'] == $segment){
                                    echo '<p class="' . 'p-3 mb-2 bg-success text-white rounded">Visiteur_id : ' . $visitor_id . '<br>Appartient bien au segment : ' . $segment .'</p>';
                                } else {
                                    echo '<p class="' . 'p-3 mb-2 bg-danger text-white rounded">Visiteur_id : ' . $visitor_id . '<br>N\'appartient pas au ' . $segment .'</p>';
                                    }
                            } else {
                                echo '<p class="' . 'p-3 mb-2 bg-danger text-white rounded">Visiteur_id : ' . $visitor_id . '<br>N\'existe pas ! </p>';
                            }
                    }                                 
                ?>
            </div>
        </div>
    </div>
</body>

<!-- script pour le dropdown-toggle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>