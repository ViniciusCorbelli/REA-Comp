<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class FileUploadController extends Controller {

    const FILE_KEY = 'file';

    public function uploadFile(FileRequest $request, $id = 0) {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            return [
                'status' => false,
            ];
        }

        $fileReceived = $receiver->receive();
        if ($fileReceived->isFinished()) {
            $file = $fileReceived->getFile();
            $fileSize = $file->getSize();

            if (!checkAllowUpload($fileSize)) {
                unlink($file->getPathname());
                return [
                    'status' => false,
                ];
            }

            $response = $id > 0 ? $this->insertToRepository($id, $file) : $this->insertToTmp($file);
            $fileInfo = $this->getNameFile($file);

            unlink($file->getPathname());
            return [
                'file_id' => $response['file_id'],
                'image' => getImage($fileInfo['extension']),
                'size' => formatSizeUnits($fileSize),
                'path' => asset('storage/' . $response['path']),
                'relative_path' => $response['path'],
                'filename' => $fileInfo['fileName']
            ];
        }

        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }

    private function getNameFile($file) {
        $extension = $file->getClientOriginalExtension();
        $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName());
        $fileNameSave = $fileName . '_' . md5(time()) . '.' . $extension;

        return [
            'extension' => $extension,
            'fileName' => $fileName,
            'fileNameSave' => $fileNameSave
        ];
    }

    private function insertToRepository($id, $file) {
        $fileInfo = $this->getNameFile($file);

        $path = Storage::disk(config('filesystems.default'))->putFileAs('repository/' . $id, $file, $fileInfo['fileNameSave']);
        $media = [
            'file_name' => $fileInfo['fileName'],
            'mime_type' => $fileInfo['extension'],
            'path' => $path,
            'size' => $file->getSize(),
            'repository_id' => $id
        ];

        $fileCreate = File::create($media);

        return [
            'file_id' => $fileCreate['id'],
            'path' => $path,
        ];
    }

    private function insertToTmp($file) {
        $fileInfo = $this->getNameFile($file);

        $path = Storage::disk(config('filesystems.default'))->putFileAs('tmp', $file, $fileInfo['fileNameSave']);
        $media = [
            'file_name' => $fileInfo['fileName'],
            'mime_type' => $fileInfo['extension'],
            'path' => $path,
            'size' => $file->getSize()
        ];

        $mediasIds = Session::get(self::FILE_KEY);
        $mediasIds[] = $media;
        Session::put(self::FILE_KEY, $mediasIds);

        return [
            'file_id' => 0,
            'path' => $path,
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
