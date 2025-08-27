<?php
// config/app.php

return [
    // 👇 ID de cliente OAuth (lo copias desde Google Cloud Console)
    'google_client_id'     => '44137422481-e45lfqr2biruhhbhdvo6ef8vptbqcm3m.apps.googleusercontent.com',

    // 👇 Client Secret (lo descargas en el JSON del cliente OAuth y lo pegas aquí)
    'google_client_secret' => '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',

    // 👇 Redirect URI (tiene que ser exactamente el mismo configurado en Google Cloud Console)
    'oauth_redirect_url'   => 'https://poe.olimpiadasespecialeschile.net/auth/google_callback.php',

    // 👇 Restringir por dominio (opcional: null = acepta cualquier correo)
    'allowed_domain'       => null,

    // 👇 Configuración de sesiones
    'session_name'         => 'accesos_app',
    'session_lifetime'     => 60*60*8 // 8 horas
];
