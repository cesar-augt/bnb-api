<?php

namespace App\Providers;

use App\Providers\Interfaces\BucketProviderContract;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;
use Cloudinary\HttpClient;

class BucketProvider implements BucketProviderContract{

    public function __construct(private HttpClient $clientHttp)
    {   
        Configuration::instance(env('CLOUDINARY_URL'));     
    }

    public function uploadFile(string $path):string{
        $result = (new UploadApi())->upload($path);
        return $result['secure_url'];
    }
}