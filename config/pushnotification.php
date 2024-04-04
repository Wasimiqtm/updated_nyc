<?php

return [
  'gcm' => [
      'priority' => 'normal',
      'dry_run' => false,
      'apiKey' => 'AIzaSyAXg4EL0fKk2RHM304SCBRkApTMKwLeSt8',
  ],
  'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'AIzaSyAXg4EL0fKk2RHM304SCBRkApTMKwLeSt8',
  ],
  'apn' => [
      'certificate' => __DIR__ . '/iosCertificates/AlpharidesCertificates.pem',
      'passPhrase' => '1234', //Optional
      'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
      'dry_run' => false
  ]
];