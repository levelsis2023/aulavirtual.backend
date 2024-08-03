<?php 
namespace App\Traits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; 
trait FileTrait{
    private $maxFileSize=20;// in MB
    private $validImageExtensions=['jpg','jpeg','png','gif'];
    private $validFileExtensions=['pdf','doc','docx','xls','xlsx','ppt','pptx','txt','zip','rar'];
    public function uploadFile($file,$folderName){
        if(!Storage::exists('public/'.$folderName)){ 
            Storage::makeDirectory('public/'.$folderName, 0777, true); 
        }
        $fileExtension=$file->getClientOriginalExtension();
        $fileName=time().'.'.$fileExtension;
        $file->move(storage_path('app/public/'.$folderName),$fileName); 
        return $folderName.'/'.$fileName;
        
    }public function checkIsValidImage($file){
        $fileExtension=$file->getClientOriginalExtension();
       
        if(in_array($fileExtension,$this->validImageExtensions)){
            return true;
        }if($file->getSize()<=($this->maxFileSize*1024*1024)){
            return true;
        }
        return false;
    }

    public function deleteFile($filePath){
        if(Storage::exists($filePath)){ // Update this line
            Storage::delete($filePath); // Update this line
            return true;
        }
        return false;
    }
}