<?php 
require 'vendor/autoload.php';

define('SITE_URL', 'http://localhost/beatstore_empire');

$paypal = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential('AVAWHpbzXVC8IAU3ETPcfBeo9fMsH4MLXbjgfQgurKm8aaAXdz-EJ2YPFWmhUwg69AInsneUB0We3riS','EJlSus1VQTcj877ev3cYT_jLPs-n9ITBkBNHOGSIMeAIzM46s7pTwWzouSoYTtIUHPtGcw7PDIcR5ypx')
);
  