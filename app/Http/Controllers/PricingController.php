<?php

namespace App\Http\Controllers;

use App\Pricing;
use App\Country;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pricings'] = Pricing::orderByRaw("country ASC,price DESC")->get();
        return view('pricing.index', $data);
    }

    public function pricingList()
    {
        $country = auth()->user()->nationality;
        $data['pricings'] = Pricing::where('country', $country)->whereIn('status', [1, 2, 4])->orderByRaw("subsMonth ASC,price ASC")->get();
        return view('pricing.list', $data);
    }

    public function subscriptionPlans()
    {
        $country = auth()->user()->school->country->name;
        $data['pricings'] = Pricing::where([['country', $country], ['status', 1], ['price_type', 3]])->orderByRaw("title ASC,price ASC")->get();
        return view('pricing.subscription', $data);
    }

    public function checkCode()
    {
        $country = trim(getCountryByCode(session('step1')['nationality'])['name']);
        $code = trim($_REQUEST['code']);
        $pricings = Pricing::where([['country', $country], ['code', $code], ['price_type', 1], ['status', 1]])->first();

        if (!empty($pricings)) {
            $pricings->price_type = pricingfor($pricings->price_type) . ' + ' . subscription($pricings->subsMonth);
            return $pricings;
        } else {
            $pricings = Pricing::where([['country', $country], ['price_type', 1], ['status', 4]])->first();
            $pricings->price_type = pricingfor($pricings->price_type) . ' + ' . subscription($pricings->subsMonth);
            return $pricings;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['country'] = Country::where('status', '1')->orderBy('name', 'ASC')->pluck('name', 'name');
        return view('pricing.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'price_type' => 'required|not_in:0',
            'title' => 'required|min:3|max:100',
            'price' => 'required|not_in:0',
            'country' => 'required|not_in:0',
            'details' => 'required|min:10|max:2000',
        ]);

        $pricing = new Pricing();

        $code = strtoupper(substr(uniqid(), 0, 6));
        $exists = Pricing::where('code', 'FA' . $request->price_type . $code)->count();

        if ($exists > 0) {
            $pricing->code = 'FA' . $request->price_type . strtoupper(substr(uniqid(), 7, 10));
        } else {
            $pricing->code = 'FA' . $request->price_type . $code;
        }
        $pricing->price_type = $request->price_type;
        $pricing->title = $request->title;
        $pricing->price = $request->price;
        $pricing->country = $request->country;
        $pricing->subsMonth = '';
        if ($request->price_type == 1 || $request->price_type == 3) {
            $pricing->subsMonth = $request->subsMonth;
        }
        $pricing->perStudent = '';
        if ($request->price_type == 1) {
            $pricing->perStudent = $request->perStudent;
        }
        $pricing->details = $request->details;
        $pricing->save();

        toast('Price created successfully.', 'success')->focusCancel(true)->timerProgressBar();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Pricing $pricing
     * @return \Illuminate\Http\Response
     */
    public function show(Pricing $pricing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Pricing $pricing
     * @return \Illuminate\Http\Response
     */
    public function edit(Pricing $pricing)
    {
        $data['country'] = Country::where('status', '1')->orderBy('name', 'ASC')->pluck('name', 'name');
        $data['pricing'] = $pricing;
        return view('pricing.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Pricing $pricing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pricing $pricing)
    {
        $this->validate($request, [
            'price_type' => 'required|not_in:0',
            'title' => 'required|min:3|max:100',
            'price' => 'required|not_in:0',
            'country' => 'required|not_in:0',
            'details' => 'required|min:10|max:2000',
        ]);

        $pricing->price_type = $request->price_type;
        $pricing->title = $request->title;
        $pricing->price = $request->price;
        $pricing->country = $request->country;
        $pricing->subsMonth = '';
        if ($request->price_type == 1 || $request->price_type == 3) {
            $pricing->subsMonth = $request->subsMonth;
        }
        $pricing->perStudent = '';
        if ($request->price_type == 1) {
            $pricing->perStudent = $request->perStudent;
        }
        $pricing->details = $request->details;
        $pricing->save();

        toast('Price updated successfully.', 'success')->focusCancel(true)->timerProgressBar();
        return redirect()->route('pricings.index');
    }

    public function pricingActions($value = null, $id = null)
    {
        $pricing = Pricing::where('id', $id)->first();
        if (empty($pricing)) {
            return '400';
        }

        if ($value == 4) {
            Pricing::where([['status', 4], ['country', $pricing->country]])->update(array('status' => 1));
        }

        $pricing->status = $value;

        if ($pricing->save()) {
            $actions = '200';
        } else {
            $actions = '400';
        }
        return $actions;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Pricing $pricing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pricing $pricing)
    {
        //
    }
}
