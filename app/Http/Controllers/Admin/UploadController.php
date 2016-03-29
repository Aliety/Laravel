<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UploadsManager;
use Illuminate\Http\Request;
use App\Http\Requests\UploadFileRequest;
use App\Http\Requests\UploadNewFolderRequest;
use Illuminate\Support\Facades\File;
use Auth;
use App\Topic;
use App\Thesis;
use Illuminate\Support\Facades\Storage;
use App\User;

class UploadController extends Controller
{
    protected $manager;

    public function __construct(UploadsManager $manager)
    {
        $this->disk = Storage::disk(config('glhqu.uploads.storage'));
        $this->manager = $manager;
    }

    public function index(Request $request)
    {
        $folder = $request->get('folder');
        $data = $this->manager->folderInfo($folder);

        return view('admin.upload.index', $data);
    }

    public function showFile(Request $request)
    {
        $file = [];
        $user = Auth::user();
        foreach ($user->topics as $topic) {
            if ($topic->pivot->active) {
                $topicName = Topic::find($topic->id)->name;
                $teacherId = Topic::find($topic->id)->teacher_id;
            }
        }

        if (empty($topicName)) {
            return view('auth.upload')->with('file', $file);
        }

        if (! $user->thesis) {
            $folder = $user->grade .'/'.$user->college.'/'.'毕业论文';
            $thesis = new Thesis(['save_folder' => $folder, 'teacher_id' => $teacherId]);
            $user->thesis()->save($thesis);
        }

        $folder = isset($folder) ? $folder : $user->thesis->save_folder;
        if (isset($user->thesis->save_name)) {
            $filename = $user->thesis->save_name;
            $path = $folder.'/'.$filename;
            $result = $this->disk->exists($path);
            if ($result) {
                $name = $user->thesis->original_name;
            }
        }

        $file['topic'] = isset($topicName) ? $topicName : '未确认选课';
        $file['name'] = isset($name) ? $name : '未上传';
        $file['path'] = isset($path) ? $path : 'null';

        return view('auth.upload')->with('file', $file);
    }

    public function showThesis()
    {
        $teacher = Auth::guard('teacher')->user();
        $theses = $teacher->theses;
        foreach ($theses as $thesis) {
            $userId = $thesis->user_id;
            $user = User::find($userId);
            $userName = $user->name;
            $thesis['user_name'] = $userName;
        }

        return view('teacher.thesis')->with('theses', $theses);
    }

    public function createFolder(UploadNewFolderRequest $request)
    {
        $new_folder = $request->get('new_folder');
        $folder = $request->get('folder').'/'.$new_folder;

        $result = $this->manager->createDirectory($folder);

        if ($result === true) {
            return redirect()->back()->withSuccess("Folder '$new_folder' create");
        }

        $error = $result ? : "An error occurred creating directory";
        return redirect()->back()->withErrors([$error]);
    }

    public function deleteFile(Request $request)
    {
        $del_file = $request->get('del_file');
        $path = $request->get('folder').'/'.$del_file;

        $result = $this->manager->deleteFile($path);

        if ($result === true) {
            return redirect()->back()->withSuccess("File '$del_file' deleted");
        }

        $error = $result ? : "An error occurred deleting file.";
        return redirect()->back()->withErrors([$error]);
    }

    public function deleteFolder(Request $request)
    {
        $del_folder = $request->get('del_folder');
        $folder = $request->get('folder').'/'.$del_folder;

        $result = $this->manager->deleteDirectory($folder);

        if ($request === true) {
            return redirect()->back()->withSuccess("Folder '$del_folder' deleted");
        }

        $error = $result ? : "An error occurred deleting directory.";
        return redirect()->back()->withErrors([$error]);
    }

    public function uploadFile(UploadFileRequest $request)
    {
        $user = Auth::user();
        $file = $_FILES['file'];
        $original_name = $file['name'];
        $save_name = $user->id.'-'.'thesis';
        $folder = $user->thesis->save_folder;
        $path = str_finish($folder, '/') . $save_name;
        $content = File::get($file['tmp_name']);
        $result = $this->manager->saveFile($path, $content);

        if ($result === true) {
            $user->thesis->original_name = $original_name;
            $user->thesis->save_name = $save_name;
            $user->thesis->save();
            return redirect()->back()->withSuccess("File '$original_name' uploaded");
        }

        $error = $result ? : "An error occurred uploading file.";

        return redirect()->back()->withErrors([$error]);
    }

    public function downloadFile(Request $request)
    {
        $path = public_path('uploads'.'/'.$request->get('path'));
        return response()->download($path, $request->get('name'));
    }
}