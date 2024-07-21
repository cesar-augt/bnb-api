<?php

namespace App\Providers\Interfaces;

use Cloudinary\HttpClient;

interface BucketProviderContract{
    public function __construct(HttpClient $httpClient);

    public function uploadFile(string $path):string;
}