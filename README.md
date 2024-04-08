# AntSugUsers

***


## Creazione del progetto

- PHP:
  - "composer create-project laravel/laravel"
  - COMPOSER:
    - "composer require darkaonline/l5-swagger"
    - "composer require laravel/passport"
- VUE:
  - "npm install vite --save " 
  - "npm install laravel-vite-plugin --save"
  - "npm install @vitejs/plugin-vue --save"
  - "npm install vue --save"
  - "npm install vue-router --save"
  - "npm install vuetify --save"
  - "npm install vuex --save"

***

## File per l'invio del composer/npm

- <a href="npm_command.txt">npm_command.txt</a>
- <a href="composer_command.txt">composer_command.txt</a>

## Passaggi base

- scelta del db
- creazione/sistemazione della parte legata allo user
- studio parti custom per BE
- studio parti custom per FE

***

### Problemi SSL

-  npm set strict-ssl false

***

### Swagger

Istruzioni per poter inizzializzare e creare lo swagger:

-  php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
-  php artisan l5-swagger:generate (all'occorenza)

Nella creazione dello swagger per le annotazioni <strong>OA</strong> e la prima api devo contenere quanto segue:

<pre>
* @OA\Info(
     *        title="Api Segnalazioni",
     *        version="v1",
     *        description="Api del progetto segnalazioni",
     * )
     * @OA\Server(
     *      url="https://pds-api-t.coldiretti.it/segnalazioni",
     *      description="URL di base dell'API"
     *  )
     *
     * @OA\SecurityScheme(
     *       type="http",
     *       securityScheme="bearerAuth",
     *       scheme="bearer",
     *       bearerFormat="JWT"
     *   )

</pre>

***


### Passport

Una volta installato e inizializzato il db(migrate, seeders) deve essere lanciato il comando 
<pre>
php artisan passport:install
</pre>

Questo comando andrà a creare due file con le chiavi di cript e inserirà nella tabella "oauth_client" due righe con le rispettive chiavi di sicurezza (due o più)


***
***
