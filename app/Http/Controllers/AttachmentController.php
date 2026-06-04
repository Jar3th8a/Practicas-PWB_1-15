<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;

class AttachmentController extends Controller
{
    public function destroy(Attachment $attachment, FileService $fileService): RedirectResponse
    {
        $this->authorize('delete', $attachment->post);

        $fileService->deleteAttachment($attachment);

        return redirect()
            ->back()
            ->with('success', 'Archivo eliminado.');
    }
}
