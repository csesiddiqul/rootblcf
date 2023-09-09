<div class="clearfix"></div>
@php
    $admissionyear = \App\PreAdmission::bySchool(school('id'))->whereStatus(1)->first();
@endphp
<div class="panel-body pad-bot-top">
    <div class="btn-group new_b pull-left" style="overflow: hidden;">
        <a href="{{route('academic.preadmission.index')}}" class="btn {{(\Route::current()->getName() == 'academic.preadmission.index')? 'active':''}}" id="admsn">@lang('Admission Year') </a>
        <a href="{{route('academic.admission.create')}}" class="btn {{(\Route::current()->getName() == 'academic.admission.create')? 'active':''}}" id="admsn">@lang('Applications Form')</a>
        <a href="{{route('academic.admission.pending')}}" class="btn {{(\Route::current()->getName() == 'academic.admission.pending')? 'active':''}}" id="admsn">@lang('Applications') </a>
        <a href="{{route('academic.admission.approve')}}" class="btn {{(\Route::current()->getName() == 'academic.admission.approve')? 'active':''}}" id="admsn">@lang('Applications Short List')</a>
        {{-- <a href="{{route('academic.admission.index')}}" class="btn {{(\Route::current()->getName() == 'academic.admission.index')? 'active':''}}">View All Student</a>--}}
        @if($admissionyear)
            <a href="{{route('academic.admission.markEntry',[auth()->user()->school->code,$admissionyear->id,$admissionyear->year])}}" class="btn {{(\Route::current()->getName() == 'academic.admission.markEntry')? 'active':''}}" id="admsn"> @lang('Marks Entry')</a>
            <a href="{{route('academic.admission.lottery')}}" class="btn {{(\Route::current()->getName() == 'academic.admission.lottery')? 'active':''}}" id="admsn"> @lang('Lottery')</a>
            <a href="{{route('academic.admission.enroll',[auth()->user()->school->code,$admissionyear->id,$admissionyear->year])}}" class="btn {{(\Route::current()->getName() == 'academic.admission.enroll')? 'active':''}}" id="admsn"> @lang('Enroll In')</a>
        @endif
        <a href="{{route('academic.admission.instruction')}}" class="btn {{(\Route::current()->getName() == 'academic.admission.instruction')? 'active':''}}">@lang('Instruction')</a>

    </div>
    <div class="pull-right">
        @if (\Route::current()->getName() == 'academic.admission.pending')
            @if(Auth::user()->role == 'admin')
                <button type="button" class="btn btn-sm foqas-btn pull-left " data-toggle="modal"
                        data-target="#myModal"><i class="fa fa-download"></i> @lang('Download')
                </button>
            @endif
        @elseif(\Route::current()->getName() == 'academic.admission.approve')
            <button type="button" class="btn btn-sm foqas-btn pull-left " data-toggle="modal" data-target="#myModal"><i
                        class="fa fa-download"></i> @lang('Download')</button>
        @endif
    </div>
</div>
<div class="clearfix"></div>

@push('modalAppend')
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">@lang('Download Application By Status')</h4>
                </div>
                <div class="modal-body">
                    @if (\Route::current()->getName() == 'academic.admission.pending')
                        @if(Auth::user()->role == 'admin')
                            @component('components.admission-export',['type'=>'admission_students'])
                            @endcomponent
                        @endif
                    @elseif(\Route::current()->getName() == 'academic.admission.approve')
                        @component('components.admission-export',['type'=>'admission_students'])
                        @endcomponent
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm foqas-btn" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endpush
