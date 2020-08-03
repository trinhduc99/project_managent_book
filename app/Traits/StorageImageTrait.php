<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait
{
    public function storageUploadFile($request, $fieldName, $folderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $fileNameOrigin = $request->file($fieldName)->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash);
            return [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
        }
    }
}
