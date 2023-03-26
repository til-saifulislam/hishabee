<?php
  
namespace App\HTTP\Traits;

use App\Http\Requests\StoreExpenditureSegment;
use App\Models\ExpenditureSegment;
use Illuminate\Http\Request;
use Image;
  
trait FileUploadTrait {

    //Content Image Upload 
    public function imageUpload($fFile, $iHeight, $iWeight, $sDirectory) {
       try{
            $sFileName    = time().'-'.$fFile->getClientOriginalName();
            $fImageResize = Image::make($fFile->getRealPath());
            $fImageResize->resize($iWeight, $iHeight);
            $sFilePath = $sDirectory.$sFileName;
            $fImageResize->save($sDirectory.$sFileName);

            return $sFilePath;
       }catch(\Exception $e){
            return $e->getMessage();
       }
    }
  
}