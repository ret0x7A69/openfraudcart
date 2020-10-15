<?php

namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use App\Models\Media;
    use Illuminate\Http\Request;

    class MediaController extends Controller
    {
        public function __construct()
        {
            $this->middleware('backend');
            $this->middleware('permission:manage_media');
        }

        public function delete($id)
        {
            Media::where('id', $id)->delete();

            return redirect()->route('backend-media');
        }

        public function upload(Request $request)
        {
            $request->validate([
                                'media_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                        ]);
            $name = explode('.', $request->media_file->getClientOriginalName())[0];

            $fileName = $name.'_'.md5(time()).'.'.$request->media_file->getClientOriginalExtension();
            $fileName = str_replace(' ', '', $fileName);
            $mimeType = $request->media_file->getMimeType();

            if ($request->media_file->move(public_path('media'), $fileName)) {
                Media::create([
                    'filename' => $fileName,
                    'mimetype' => $mimeType,
                    'type' => 'image',
                ]);
            }

            return back()
                                ->with('successMessage', __('backend/media.successfully'))
                                ->with('fileName', $fileName);
        }

        public function page(Request $request, $pageNumber = 0)
        {
            $medias = Media::orderByDesc('created_at')->paginate(15, ['*'], 'page', $pageNumber);

            if ($pageNumber > $medias->lastPage() || $pageNumber <= 0) {
                return redirect()->route('backend-media-with-pageNumber', 1);
            }

            return view('backend.media.media', [
                'medias' => $medias,
            ]);
        }
    }
