<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreExpenditureSegment;
use App\Http\Controllers\Controller;
use App\Http\Traits\FileUploadTrait;
use App\Models\ExpenditureSegment;
use App\Models\ExpenditureList;
use Illuminate\Http\Request;
use Image;
use Auth;
use DB;


class ExpenditureSegmentController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Use user_id=Auth UserID By default use user_id=1
        $qExpSeg = DB::table('expenditure_segments')->where('user_id',1)->get();
        $qExpList = DB::table('expenditure_lists')->where('user_id',1)->get();

        return response()->json([
            'status' => true,
            'qExpSeg' => $qExpSeg,
            'qExpList' => $qExpList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenditureSegment $request)
    { 
        $qExpSeg=new ExpenditureSegment;  
          
        if(!empty($request->file('filProfile'))){
            $sFilePath = $this->imageUpload($request->file('filProfile'), 70, 69, 'media/default/');
            $qExpSeg->file_path=$sFilePath; 
        }else{
            return $request;  
            $qExpSeg->file_path=''; 
        }
        
        $qExpSeg->user_id = 1;
        $qExpSeg->exp_title = $request->txtExpTitle;
        $qExpSeg->save();
        
        return response()->json([
            'status' => true,
            'message' => "Expenditure segment created successfully!"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    { 
        // Use user_id=Auth UserID By default use user_id=1
        $qExpSeg = ExpenditureSegment::where('user_id',$id)->get();

        return response()->json([
            'status' => true,
            'qExpSeg' => $qExpSeg
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $qExpSeg = ExpenditureSegment::where('id',$id)->first();

        return response()->json([
            'status' => true,
            'qExpSeg' => $qExpSeg
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreExpenditureSegment $request, string $id)
    {
        DB::table('expenditure_segments')->where('id',$id)->update([
            'exp_title' => $request->txtExpTitle
        ]);
        
        return response()->json([
            'status' => true,
            'message' => "Expenditure segment update successfully!"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('expenditure_segments')->where('id',$id)->delete();

        return response()->json([
            'status' => true,
            'message' => "Expenditure segment deleted successfully!",
        ], 200);
    }
}
