<?php

namespace App\Services;

use App\Providers\Interfaces\BucketProviderContract;

class UploadService {

    public function __construct(private string $path) {
 
    }

    public function handle(BucketProviderContract $bucketProvider){

        return $bucketProvider->uploadFile($this->path);
    
    }
    
}