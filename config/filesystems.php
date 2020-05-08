<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", 'gcs'
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],

        'gcs' => [
            'driver' => 'gcs',
            'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'astral-reef-276607'),
            'key_file' => [
                    "type" => "service_account",
                    "project_id" => "astral-reef-276607",
                    "private_key_id" => "9d922e64c2cc1070fb0c62dac503792af62614e2",
                    "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDLLrCuEb8+W5yf\nMjbEEOhRuXQhmMgzKKyuk5xGvt6niAHQFDmEdDP9uLrpYs4ls15tHl7jWvxn7Tey\ntYvzPMHjriHyOTHn3JblWegNSNGCZlxzU3xWdJkCppHsK2t/6qJ+yS3uM2vw0I8X\nxJT9FN6fFbLvOMKpywjai78RsY2egZIziD9gN55AqQQOo7SuRV5uVyKjqqKspiPX\nQ2RmSAYLLUcRD5zqa28xPudFD8FJ+81fuf0xDrqz/iTYQaNU1b6myjMLElmKHwdq\nZh3Y7qc+cZNULDmiYcJBWgGb/q93fRnhdqow4bdWEH9t13YpEmWi/fyQAo+iGEe/\nZ5N+7TAtAgMBAAECggEAE0AW9sMRMMYKwo2GIVDtxfJxdY5tZ2Vy6O5s18oVO9+3\ntkB4S5ub4m3abarSF8HVEDcYq+dOs0UHKiwnuJG42ArDRhkTqKFefZflU77itL1g\nhH+0L9fHuHfSKwNZIcs3/pWuf5tJHo2QBSM3r3vG9OEgLSieTuqA6f3kCjfdkFcQ\nrMJ9wbyNQ48iq7Hf3J0z89u+Z18yGN6jLxW/UPR9L28o9P/IgBJnZwL92DPdSBN3\nfyeWrS+/txkqTgaqRYKyp01nw33pMYe+IR6n4Szj21JKeS6bDYGo5EBvPlnGCQPY\nfEEVBLerHXNlQKZQBcurUr7vxTokTztMpLZqXHZKYQKBgQDkmE+1LtA2ZdSnnxKS\nTO9/4RGET1WqwDx89LO9k+IATwc1zSwHvHq5gR1ABDlMNshR2NZ4STfRp3mgzFUn\nZXnAx903RTWRt08aabIig188ij30YmulZ3vkANqH2U0oqEM46sjxJ15aeJ8gOeiI\np4YGQMfqEjm0hWX4WcMq+gP9DQKBgQDjinRaEc9X75enCTmP3SHwXDOZ2fCo97XE\ntHMVizb22B5XbhjuznqZvQUTz6AGkEoVTizMzsE9BIYwh5yHeMlaykxvjtXbVmLj\nvgOVlqY+9jPwRPA9euL3Ot345f6zioiTAY9rL0/vzLF2yKyC540Bub/4vLlXkQTl\niAEGmHJ3oQKBgHhQ6nMUhqZ7BmiLQz0ZnV0TWyLmltJeh/fE2+3GLke3ULYynSAd\nRgLpQDn3fyjsFJdvp8J71xNUMKI/qfooYOLkzzxOAxoE/2+JfibIOpIkuOMuAjZ2\ntzCUenDSINhrZ6ZHfSfgbrrzjd1qXUe/1Lzpz88VdKXdKISEykKOgRbpAoGAVJ1h\nJTloRIgpegk5KaGPBGYVHkpobz0mkA6WmVVazDKUHekoRm3sM42R/MsB9E7l7cRT\nbpoYTAuJpzRW5h3pquR9xiJ0rosSXSSFCrSp/9HogJnySLqQ+mUetHc63yNOJHS5\nE5/VdxREjiqT1F4tFo4vsFzmA4U/L+gCkaRRNOECgYEAonFzRKDQoonyugwIcnUL\ntKjb0APvz1C4DAYZaX+zXN752/PKPQjigbkHnowHDCMKv2SY8ru8iezE/xKWrrEn\nVr5Yhpa1uI5W0bKXWN33c3SYIsRtIkrVAiUZBXeCnApCkshFgDVuoFd07MvnL1I8\naBnIhO4nV/sebeNR7+XlW58=\n-----END PRIVATE KEY-----\n",
                    "client_email" => "csr-service@astral-reef-276607.iam.gserviceaccount.com",
                    "client_id" => "114027054698074936361",
                    "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
                    "token_uri" => "https://oauth2.googleapis.com/token",
                    "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
                    "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/csr-service%40astral-reef-276607.iam.gserviceaccount.com"
            ],
            'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'vsu-cs3'),
            'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', null), // optional: /default/path/to/apply/in/bucket
            'storage_api_uri' => env('GOOGLE_CLOUD_STORAGE_API_URI', null), // see: Public URLs below
            'visibility' => 'public'
        ],

    ],

];
