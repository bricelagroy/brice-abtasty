<?php

/* Authentication à l'API */
$client_id = "207_rkr4sr4biogcksccw8ssgk0wswo4gsg00ggw008okcwos4ggk";
$client_secret = "147ovlaternk8cocss8k48wo0g8gskc0ko0koc0o0kg8kocsck";
$grant_type = "client_credentials";

// Initialisation d'une session
$ch = curl_init();

	try {
		// L'URL à récupérer
		curl_setopt($ch, CURLOPT_URL, "https://api.abtasty.com/oauth/v2/token");
		// Permet de faire un HTTP POST régulier
		curl_setopt($ch, CURLOPT_POST, true);
		// Toutes les données à passer lors d'une opération de HTTP POST, sous la forme d'un tableau
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            "client_id" => $client_id,
            "client_secret" => $client_secret,
            "grant_type" => $grant_type));
		// Analyser l'URL de redirection à partir de l'en-tête
		curl_setopt($ch, CURLOPT_HEADER, false);
		/* Pour retourner le transfert en tant que chaîne de caractères de la valeur retournée 
		   par curl_exec() au lieu de l'afficher directement. */
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Le nombre de secondes à attendre durant la tentative de connexion
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);   
		// Le temps maximum d'exécution de la fonction cURL en secondes
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);       
		// Pour obtenir l'URL de redirection mais sans la suivre
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		// Nombre maximal de redirections HTTP à suivre
		curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
		// Pour arrêter cURL de vérifier le certificat du pair --> possibilité de récupérer le certificat de sécurité
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, '1');

		// exécution de la session
		$response = curl_exec($ch);
	    if (curl_errno($ch)) {
			// Retourne le dernier message d'erreur cURL
			echo curl_error($ch);
			die();
		}
		/* Affiche le dernier code HTTP reçu */
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($http_code == intval(200)){
			// Afficher un json avec "access_token"
			echo $response;
		}
		// Si aucune de ces conditions, retourne : Ressource introuvable
		else{
			echo "Ressource introuvable : " . $http_code;
		}
		// Permet d’attraper les exceptions issues de la classe Error et celles de la classe Exception
	} catch (Throwable $th) {
		// Message d'erreur
		throw $th;
		// Reprise de l’exécution du script
	} finally {
		// fermeture des ressources
		curl_close($ch);
	}
/* Fin ---- Authentication à l'API */

?>