<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class FileUploadController extends Controller {

    const FILE_KEY = 'file';

    public function uploadFile(Request $request, $id = 0) {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive();
        if ($fileReceived->isFinished()) {
            $file = $fileReceived->getFile();
            $extension = $file->getClientOriginalExtension();
            $fileName = $fileNameSave = str_replace('.' . $extension, '', $file->getClientOriginalName());
            $fileNameSave .= '_' . md5(time()) . '.' . $extension;

            $target_path = $id > 0 ? 'repository/' . $id : 'tmp';

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs($target_path, $file, $fileNameSave);
            $media = [
                'file_name' => $fileName,
                'mime_type' => $extension,
                'path' => $path,
                'size' => $file->getSize()
            ];

            $fileMedia = ['id' => 0];
            if ($id > 0) {
                $media['repository_id'] = $id;
                $fileMedia = File::create($media);
            } else {
                $mediasIds = Session::get(self::FILE_KEY);
                $mediasIds[] = $media;
                Session::put(self::FILE_KEY, $mediasIds);
            }

            // delete chunked file
            unlink($file->getPathname());
            return [
                'file_id' => $fileMedia['id'],
                'image' => getImage($extension),
                'size' => formatSizeUnits($media['size']),
                'path' => asset('storage/' . $path),
                'relative_path' => $path,
                'filename' => $fileName
            ];
        }

        // otherwise return percentage informatoin
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }

    public function deleteFile(Request $request, $id) {
        if ($id > 0) {
            $file = File::findOrFail((int) $id);
            $file->delete();
            Storage::delete($file->path);
        }

        if (!empty($request->input('path'))) {
            Storage::delete($request->input('path'));
        }

        return response()->json([]);
    }
}
