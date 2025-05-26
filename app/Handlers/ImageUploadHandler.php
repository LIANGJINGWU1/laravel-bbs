<?php

namespace App\Handlers;



use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageUploadHandler
{

    protected  array $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

    public  function save(UploadedFile $file, string $folder ,string $filePrefix = '', ?int $maxWidth = null): array|false
    {
        //构建储存的文件夹规则
        $folderName = "uploads/images/$folder/" . date("Ym/d", time());
        //文件储存路径
        $uploadPath = public_path() . '/' . $folderName;
        //获取后缀名保证是图片格式
        $extension = strtolower($file->getClientOriginalExtension() ?: 'png');
        //拼接文件名
        $filename = $filePrefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        if (!in_array($extension, $this->allowedExt)) {
            return false;
        }
        //移动图片到目录下
        $file->move($uploadPath, $filename);

        if ($maxWidth && $extension !== 'gif') {
            $this->reduceSize($uploadPath . '/' . $filename, $maxWidth);
        }
        return [
            'path' => config('app.url') . "/$folderName/$filename"
        ];
    }

    /**
     * @param $filePath
     * @param $maxWidth
     * @return void
     * 缩放图片到指定宽度
     */
        public function reduceSize($filePath, $maxWidth):void
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read($filePath);

        $image->scale($maxWidth);

        $image->save();
    }




}
