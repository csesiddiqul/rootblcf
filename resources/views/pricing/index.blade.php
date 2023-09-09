@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.master-left-menu') 
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default col-sm-12"> 
                <div class="panel-body p-0"> 
                    @include('pricing.pricing-menu') 
                    <div class="table-responsive">
                        <table class="table table-bordered table-data-div table-condensed table-striped table-hover" style="margin-top: 10px !important; ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('Pricing For')</th>
                                <th scope="col">@lang('Code')</th>
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Price')</th> 
                                <th scope="col">@lang('Country')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($pricings)>0)
                                @foreach ($pricings as $key=>$pricing)
                                    @if($pricing->country=='Bangladesh')
                                        @php $price = "৳".$pricing->price; $cur = "৳"; @endphp
                                    @else
                                        @php $price = "$".$pricing->price; $cur = "$"; @endphp
                                    @endif
                                    @if($pricing->subsMonth>0)
                                        @php($month = subscription($pricing->subsMonth)) 
                                    @else
                                        @php($month = $pricing->subsMonth)
                                    @endif
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th> 
                                    <td>
                                        {{ pricingfor($pricing->price_type) }}
                                        @if($pricing->price_type == 1 && $pricing->status==4)
                                            <sup class="text-info"><small>-Default</small></sup>
                                        @endif
                                        @if($pricing->price_type == 1)
                                        <ul class="td_ul">
                                            <li><span>With {{$month}} subscription.</span></li>
                                            <li><span>Per month {{$cur.$pricing->perStudent}} per student.</span></li>
                                        </ul>
                                        @endif
                                    </td>
                                    <td><code>{{ $pricing->code }}</code></td>
                                    <td>
                                        <a class="a-href" type-name="{{ pricingfor($pricing->price_type) }}" title-name="{{ $pricing->title }}" price-name="{{$price}}" month-name="{{$month}}" detail-name="{!!nl2br($pricing->details)!!}" data-toggle="modal" data-target="#myPriceDetails">{{ $pricing->title }}</a>
                                    </td>  
                                    <td>{{$price}}</td> 
                                    <td>{{ $pricing->country }}</td> 
                                    <td> 
                                        {!! Form::select('status',pricingStatus(), $pricing->status, array('id' => 'status'.$pricing->id, 'class' => 'form-control input-sm selec'.$pricing->status, 'onChange' =>'priceStatus(this.value,'.$pricing->id.')')) !!}
                                    </td> 
                                    <td>
                                        <a class="btn btn-xs btn-warning" href="{{route('pricings.edit',$pricing->id)}}">@lang(' Edit ')</a>
                                    </td>  
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="6" class="text-center text-danger">@lang('No Related Data Found.')</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
            @include('pricing.details-modal') 
        </div>
    </div>
</div>  
@push('script')
    <script>
        $(document).ready(function () {
            function appendFunction() { 
                $(".table-responsive div.row:first-child div.col-sm-6:first-child").html('<h5>Pricing List</h5>');
            } 
            setTimeout(function () {
                appendFunction();
                $("#EventSection").html('');
            }, 1000);
        })
    </script>
@endpush
@endsection
