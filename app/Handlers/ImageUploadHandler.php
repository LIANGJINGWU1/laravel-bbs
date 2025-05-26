<?php

namespace App\Handlers;



use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageUploadHandler
{

    protected  array $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

    public  function save(UploadedFile $file, $folder, $filePrefix, $maxSize = 416): array|false
    {
        //构建储存的文件夹规则
        $folderName = "uploads/images/$folder/" . date("Y/m/d", time());
        //文件储存路径
        $uploadPath = public_path() . '/' . $folderName;
        //获取后缀名保证是图片格式
        $extension = strtolower($file->getClientOriginalExtension() ?: 'png');
        //拼接文件名
        $filename = $filePrefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        if(!in_array($extension, $this->allowedExt)) {
            return false;
        }
        //移动图片到目录下
        $file->move($uploadPath, $filename);

        return [
            'path' => config('app.url') . '/' . $folderName . '/' . $filename,
        ];

    }



}
