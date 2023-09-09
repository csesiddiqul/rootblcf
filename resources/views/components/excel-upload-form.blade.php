<form action="{{url('users/import/user-xlsx')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="{{$type}}">
    <div class="form-group col-md-4 pl-0">
        <div class="button-wrapper">
            <span class="label">@lang('Choose File')</span>
            <input type="file" name="file" id="file" accept=".xlsx, .xls, .csv"
                   class="form-control upload-box" placeholder="@lang('Upload File')">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-2" style="padding-left: 0px;">
        <input type="submit" class="{{btnClass()}}" value="@lang('Upload')">
    </div>
</form>
@push('styles')
    <style>
        .button-wrapper {
            text-align: center;
        }

        .button-wrapper span.label {
            display: inline-block;
            width: 100%;
            background: #0077f7;
            cursor: pointer;
            color: #fff;
            padding: 12px 0;
            font-size: 1.2rem;
            border-radius: .2rem;
        }

        .upload-box {
            display: inline-block !important;
            position: absolute;
            z-index: 1;
            width: 100%;
            height: 50px;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }
    </style>
@endpush
