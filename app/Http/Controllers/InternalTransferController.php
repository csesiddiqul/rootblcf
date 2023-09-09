<?php

namespace App\Http\Controllers;

use App\AccountSector;
use App\InternalTransfer;
use App\Ledger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternalTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['transaction'] = InternalTransfer::with('ledgerCredit','ledgerDebit','user')->where('financialYear_id',current_financial_year()->id)->orderByDesc('created_at')->get();
        return view('accounts.internal_transfer.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school_id = Auth::user()->school_id;
        $sectors = AccountSector::orderBy('name', 'asc')->bySchool($school_id)->where('type', 'income')->pluck('name', 'id');
        $ledgers = Ledger::bySchool($school_id)->get()->groupBy('ac_group');
        return view('accounts.internal_transfer.create', compact('sectors', 'ledgers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'ledger_id_credit' => 'required|numeric',
            'ledger_id_david' => 'required|numeric',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string'
        ]);

         $data = $request->except('_token');
         $data['school_id'] = auth()->user()->school_id;
         $data['financialYear_id'] = current_financial_year()->id;
         $data['user_id'] = auth()->user()->id;
         $data['date'] = date('Y-m-d', strtotime($data['date']));
        $internalTr = InternalTransfer::create($data);
        $voucher_no = str_pad($internalTr->id, 5, '0', STR_PAD_LEFT);
        $voucher_no = date('Ym', strtotime($internalTr->created_at)) .'-'.'IT'. $voucher_no;
        $internalTr->update(['voucher_no' => $voucher_no]);
        $ledgercredit = Ledger::find($request->ledger_id_credit);
        $ledgerdavid = Ledger::find($request->ledger_id_david);
        $ledgercredit->update(['current_balance' => ($ledgercredit->current_balance - $request->amount)]);
        $ledgerdavid->update(['current_balance' => ($ledgerdavid->current_balance + $request->amount)]);
        toast(transMsg('Saved Successfully'), 'success')->timerProgressBar();
        return redirect()->route('accounts.internal_transfer.voucher', $internalTr->voucher_no);

    }

    public function voucher($voucher_no)
    {

        $voucher = InternalTransfer::with('user')->where('voucher_no', $voucher_no)->first();
        if (empty($voucher))
            return abort('404');
        $voucherType = ['Payment Voucher', 'Payment Voucher'];
        return view('accounts.internal_transfer.voucher', compact('voucher', 'voucherType'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InternalTransfer  $internalTransfer
     * @return \Illuminate\Http\Response
     */
    public function show(InternalTransfer $internalTransfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InternalTransfer  $internalTransfer
     * @return \Illuminate\Http\Response
     */
    public function edit(InternalTransfer $internalTransfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InternalTransfer  $internalTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InternalTransfer $internalTransfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InternalTransfer  $internalTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternalTransfer $internalTransfer)
    {
        //
    }
}
