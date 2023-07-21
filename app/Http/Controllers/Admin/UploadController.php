<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\UploadService;

class UploadController extends Controller
{
    protected $uploadService;
    /**
     * @var UploadService
     */

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function store(Request $request)
    {
        if($request->has('fileUpload')) {
            $this->uploadService->handleUpload($request);
        }
    }
}
