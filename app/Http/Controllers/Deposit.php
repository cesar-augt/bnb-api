<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositRequest;
use App\Providers\Interfaces\BucketProviderContract;
use App\Repository\DepositRepository;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

class Deposit extends Controller
{
    public function __construct(private BucketProviderContract $bucketProvider, public UploadService $uploadService) {
    }


    public function create(Request $request)
    {
        return DepositRepository::create($request->all());
    }

    public function findByMonthAndYear(int $month, int $year)
    {
        return [
                'total' => DepositRepository::total(),
                ...DepositRepository::findByMonthAndYear($month, $year)->groupBy('status')
            ];
    }

    public function findGroupByStatus()
    {
        return  DepositRepository::loadModel()->all()->groupBy('status')->toArray();
    }

    public function findPending()
    {
        return  DepositRepository::loadModel()::query()->with('user')->where('status', 'pending')->get();
    }
    
    public function upload(DepositRequest $request)
    {        
        dd('a');
        $request->validated();
        Configuration::instance(env('CLOUDINARY_URL'));
        $file = $request->file('check_file');
        $result = (new UploadApi())->upload($file->getRealPath());
        $repository = $request->only('amount', 'description');
        $repository['url_image'] = $result['secure_url'];
        $repository['user_id'] = auth()->user()->id;
        return DepositRepository::create($repository);
    }


    public function uploadFile(Request $request)
    {        
        $file = $request->file('check_file');
        $this->uploadService->setPath($file->getRealPath());
        return $this->uploadService->handle($this->bucketProvider);    
    }

    public function approve(int $id)
    {
        $deposit = DepositRepository::loadModel()->find($id);
        $deposit->status = 'approved';
        $deposit->save();
        return $deposit;
    }

    public function reject(int $id)
    {
        $deposit = DepositRepository::loadModel()->find($id);
        $deposit->status = 'rejected';
        $deposit->save();
        return  $deposit;
    }

}
