<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;


function upload_file($file,$modal,$mediable_id){
    $old_file = \App\Models\Media::where('mediable_type',$modal)
        ->where('mediable_id',$mediable_id)->first();
    if ($old_file){
        File::delete(asset($old_file->file_path));
        $old_file->delete();
    }
    $media_file = new \App\Models\Media();
    $media_file->mediable_type = $modal;
    $media_file->file_name = 'file';
    $media_file->mediable_id = $mediable_id;
    $media_file->file_path = 'storage/'.$file;
    $media_file->save();

    return $file;
}

function admin(){
    return auth()->guard('admin')->user();
}

function checkPermition($linkId)
{

    $admin = auth()->guard('admin')->user();
    $allow = $admin->is_super == 1 ? 1 : 0;

    if ($allow == 0 && isset($admin->permition_group)){
        $permition_links = $admin->permition_group->links;
        if (!is_array($permition_links))
            $permition_links = json_decode($permition_links);

        if (in_array($linkId, $permition_links))
            $allow = 1;

    }

    return $allow;
}
