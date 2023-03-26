<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ExpenditureListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Use user_id=Auth UserID By default use user_id=1
        $qExpList = DB::table('expenditure_lists as exli')
        ->join('expenditure_segments as exse', 'exli.exp_seg_id', '=', 'exse.id')
        ->select('exli.*','exse.exp_title')
        ->where('exli.user_id',1)->get();

        return response()->json([
            'status' => true,
            'qExpList' => $qExpList
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Use user_id=Auth UserID By default use user_id=1 
        $qExpSeg = DB::table('expenditure_segments')->where('user_id',1)->get();
        $qPaymentType = DB::table('payment_accounts')->get();

        return response()->json([
            'status' => true,
            'qExpSeg' => $qExpSeg,
            'qPaymentType' => $qPaymentType
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cmbExpSegID' => 'required',
            'txtAmount' => 'required|integer',
            'cmbPaymentAcctID' => 'required'
        ]);

        DB::table('expenditure_lists')->insert([
            'user_id' => 1,
            'exp_seg_id' => $request->cmbExpSegID,
            'amount' => $request->txtAmount,
            'exp_note' => $request->txtExpNote,
            'payment_account_id' => $request->cmbPaymentAcctID,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        return response()->json([
            'status' => true,
            'amount' => $request->txtAmount,
            'message' => "Expenditure list created successfully!"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $qExpSeg = DB::table('expenditure_segments')->where('user_id',1)->get();
        $qPaymentType = DB::table('payment_accounts')->get();
        $qExpList = DB::table('expenditure_lists')->where('id',$id)->first();

        return response()->json([
            'status' => true,
            'qExpSeg' => $qExpSeg,
            'qPaymentType' => $qPaymentType,
            'qExpList' => $qExpList
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'cmbExpSegID' => 'required',
            'txtAmount' => 'required|integer',
            'cmbPaymentAcctID' => 'required'
        ]);

        DB::table('expenditure_lists')->where('id',$id)->update([
            'exp_seg_id' => $request->cmbExpSegID,
            'amount' => $request->txtAmount,
            'exp_note' => $request->txtExpNote,
            'payment_account_id' => $request->cmbPaymentAcctID,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        return response()->json([
            'status' => true,
            'amount' => $request->txtAmount,
            'message' => "Expenditure list updated successfully!"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('expenditure_lists')->where('id',$id)->delete();

        return response()->json([
            'status' => true,
            'message' => "Expenditure list deleted successfully!",
        ], 200);
    }
}
