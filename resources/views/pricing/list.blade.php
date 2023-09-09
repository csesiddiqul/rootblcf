@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')   
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.agent-left-menu') 
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default pt-0">
                <div class="panel-heading">  
                    @lang('Pricings') 
                </div>
                <div class="panel-body ">
                    <div class="clearhight"></div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-data-div table-condensed table-striped table-hover" style="margin-top: 10px !important; ">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('Pricing For')</th>
                                <th>@lang('Code')</th>
                                <th>@lang('Title')</th>
                                <th>@lang('Price')</th>  
                                <th style="text-align:center!important">@lang('Details')</th>
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
                                        @php $month = subscription($pricing->subsMonth); @endphp 
                                    @else
                                        @php $month = $pricing->subsMonth; @endphp
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
                                    <td><code class="a-href" type-name="{{ pricingfor($pricing->price_type) }}" title-name="{{ $pricing->title }}" price-name="{{$price}}" month-name="{{$month}}" detail-name="{!!nl2br($pricing->details)!!}" data-toggle="modal" data-target="#myPriceDetails">{{ $pricing->code }}</code></td>
                                    <td>{{ $pricing->title }}</td>  
                                    <td>{{$price}}</td>  
                                    <td style="text-align:center!important"> 
                                        @php $string = nl2br($pricing->details); @endphp  
                                        {!! \Illuminate\Support\Str::limit($string, 50, $end='...') !!}
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
        }); 
    </script>
@endpush
@endsection
