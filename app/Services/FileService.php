<?php

namespace App\Services;

use App\Models\Attachment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function storeAttachment(UploadedFile $file, int $postId): Attachment
    {
        $filename = uniqid('', true).'_'.time().'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('posts/'.$postId, $filename, 'public');

        return Attachment::create([
            'post_id' => $postId,
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getClientMimeType() ?? $file->getMimeType(),
            'size' => $file->getSize(),
            'path' => $path,
        ]);
    }

    public function deleteAttachment(Attachment $attachment): void
    {
        Storage::disk('public')->delete($attachment->path);
        $attachment->delete();
    }

    public function getFileUrl(Attachment $attachment): string
    {
        return asset('storage/'.$attachment->path);
    }
}
