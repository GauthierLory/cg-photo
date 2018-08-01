<?php
// lors de l'initialisation on lui passe la clé en parametre
class Stripe{
    //
    private $api_key;

    public function __construct(string $api_key)
    {
        $this->api_key = $api_key;
    }

    // url que l'on souhaite appeler en l'occurence la page costumer et  un tableau qui sera envoyé a l'api
    public function api(string $client, array $donnees) :stdClass
    {
        // utilisation de la librairie culr de php
        $ch = curl_init();
        // définition des options sous forme de tableau
        curl_setopt_array($ch,[
            // permet de "créer" un client
            CURLOPT_URL => "https://api.stripe.com/v1/$client",
            // on n'affiche pas les informations
            CURLOPT_RETURNTRANSFER => true,
            // utilise le login, on envoi notre clé privé
            CURLOPT_USERPWD => $this->api_key,
            // utilise une authentification basic
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            // envoi des donnees
            CURLOPT_POSTFIELDS => http_build_query($donnees)
        ]);
        // recupere les info sous forme de json
        $response = json_decode(curl_exec($ch));
        curl_close($ch);
        // sinon erreur capturé par php
        if (property_exists($response, 'error')){
            throw new Exception($response->error->message);
        }
        return $response;

    }
}
