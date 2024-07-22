<?php

namespace App\Services;

use App\Providers\Interfaces\BucketProviderContract;

class UploadService {

    private string $path;

    public function setPath(string $path){
        $this->path = $path;
    }

    public function handle(BucketProviderContract $bucketProvider){
        return $bucketProvider->uploadFile($this->path);
    }
    
}