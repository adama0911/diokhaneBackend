<?php

$app->get('/', App\Controllers\HomeController::class .':accueil');

$app->post('/', App\Controllers\HomeController::class .':accueil');

$app->group('/home', function () {
    $this->post('/produits', App\Controllers\HomeController::class .':produits');
    $this->post('/cart', App\Controllers\HomeController::class .':cart');
    $this->post('/wishlist', App\Controllers\HomeController::class .':wishlist');
    $this->post('/compare', App\Controllers\HomeController::class .':compare');
    $this->post('/singleProduct', App\Controllers\HomeController::class .':singleProduct');
    $this->post('/achat', App\Controllers\HomeController::class .':achat');
    $this->post('/produitsNext', App\Controllers\HomeController::class .':produitsNext');
    $this->post('/produitsNextMotif', App\Controllers\HomeController::class .':produitsNextMotif');
    $this->post('/produitsMotif', App\Controllers\HomeController::class .':produitsMotif');
    $this->post('/vendre', App\Controllers\HomeController::class .':vendre');

});

$app->group('/cart', function () {
    $this->post('/produits', App\Controllers\HomeController::class .':produits');
    $this->post('/cart', App\Controllers\HomeController::class .':cart');
    $this->post('/wishlist', App\Controllers\HomeController::class .':wishlist');
    $this->post('/compare', App\Controllers\HomeController::class .':compare');
    $this->post('/singleProduct', App\Controllers\HomeController::class .':singleProduct');
});

$app->group('/singleProduct', function () {
    $this->post('/produits', App\Controllers\HomeController::class .':produits');
    $this->post('/singleProduct', App\Controllers\SingleProductController::class .':singleProduct');
});

$app->group('/admin', function () {
    $this->post('/add-produit', App\Controllers\AdminController::class .':addprod');
    $this->post('/liste-commandes', App\Controllers\AdminController::class .':produits');

    $this->post('/confirmerAchat', App\Controllers\AdminController::class .':confirmerAchat');
});

$app->group('/utile', function () {
    $this->post('/cart-produit', App\Controllers\UtileController::class .':home');
});


$app->group('/auth', function () {

    $this->post('/login', App\Controllers\AuthController::class .':login');

    $this->post('/logout', App\Controllers\AuthController::class .':logout');

});


$app->group('/chat', function () {

    $this->get('/listeusers', App\Controllers\ChatController::class .':listAllUsers');
    $this->post('/listeusers', App\Controllers\ChatController::class .':listAllUsers');

    $this->post('/listedatainitadmin', App\Controllers\ChatController::class .':listedatainitadmin');

    $this->post('/addmembre', App\Controllers\ChatController::class .':addmembre');

    $this->post('/getrole', App\Controllers\ChatController::class .':getrole');


    $this->post('/listemessagesroom', App\Controllers\ChatController::class .':listAllMessagesRoom');

    $this->post('/envoimessageroom', App\Controllers\ChatController::class .':envoimessageroom');

    $this->post('/envoifileroom', App\Controllers\ChatController::class .':envoifileroom');


    $this->post('/getgroupe', App\Controllers\ChatController::class .':getgroupe');

    $this->post('/listemessagesgroupe', App\Controllers\ChatController::class .':listAllMessagesGroupe');

    $this->post('/envoimessagegroupe', App\Controllers\ChatController::class .':envoimessagegroupe');

    $this->post('/envoifilegroupe', App\Controllers\ChatController::class .':envoifilegroupe');


    $this->post('/getuser', App\Controllers\ChatController::class .':getuser');

    $this->post('/listemessagesuser', App\Controllers\ChatController::class .':listAllMessagesUser');

    $this->post('/envoimessageuser', App\Controllers\ChatController::class .':envoimessageuser');

    $this->post('/envoifileuser', App\Controllers\ChatController::class .':envoifileuser');

});

$app->group('/user', function () {

    $this->post('/addmembre', App\Controllers\UserController::class .':addmembre');

});

$app->group('/file', function () {

    $this->post('/onUploadfile', App\Controllers\UploadController::class .':onUploadfile');

    $this->get('/showfile/{file}', App\Controllers\UploadController::class .':showfile');

});

