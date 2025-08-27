<?php
require_once __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../config/app.php';

echo "<h2>Check Google Config</h2>";
echo "<pre>";
echo "Client ID:\n" . $app['google_client_id'] . "\n\n";
echo "Client Secret:\n" . (getenv('GOOGLE_CLIENT_SECRET') ?: '❌ NO DEFINIDO') . "\n\n";
echo "Redirect URI (app.php):\n" . $app['oauth_redirect_url'] . "\n\n";
echo "Callback URL actual:\nhttps://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/google_callback.php\n";
echo "</pre>";
