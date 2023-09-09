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
<div class="form-group col-md-6 {{ $errors->has('ledger_id') ? ' has-error' : '' }}">
    <label for="ledger_id">@lang('Ledger') <span class="text-danger">*</span></label>
    <select class="form-control" id="ledger_id" required name="ledger_id">
        <option value="" selected>@lang('Choose')</option>
        @foreach ($ledgers as $key => $value)
            <optgroup label="{{$key}}">
                @foreach ($value->sortBy('name') as $ledger)
                    <option value="{{$ledger->id}}" {{isset($expense->ledger_id) && $expense->ledger_id == $ledger->id ? 'selected' : '' }}>{{$ledger->name}}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
    @error('ledger_id')
    <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group col-md-6{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name">@lang('Name') <span class="text-danger">*</span></label>
    {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'required','autocomplete' => 'off')) !!}
    @error('name')
    <span class="help-block">
                                           <strong>{{ $message  }}</strong>
                                        </span>
    @enderror
</div>
<div class="form-group col-md-6{{ $errors->has('account_sector_id') ? ' has-error' : '' }}">
    <label for="account_sector_id">@lang('Expense Head') <span class="text-danger">*</span> </label>
    {!! Form::select('account_sector_id',$sectors, null, array('id' => 'account_sector_id', 'class' => 'form-control select2','required', 'placeholder' => trans('Choose'))) !!}
    @error('account_sector_id')
    <span class="help-block">
                                            <strong>{{ $message  }}</strong>
                                        </span>
    @enderror
</div>
<div class="form-group col-md-6{{ $errors->has('amount') ? ' has-error' : '' }}">
    <label for="amount">@lang('Amount') <span class="text-danger">*</span> </label>
    {!! Form::number('amount', NULL, array('id' => 'amount','min'=>'0', 'class' => 'form-control', 'required','autocomplete' => 'off')) !!}
    @error('amount')
    <span class="help-block">
                                            <strong>{{ $message  }}</strong>
                                        </span>
    @enderror
</div>
<div class="form-group col-md-6{{ $errors->has('date') ? ' has-error' : '' }}">
    <label for="date">@lang('Date') <span class="text-danger">*</span></label>

    @if(isset($expense->date))
        {!! Form::date('date', $expense->date ?? date('d-m-Y'), array('id' => 'date', 'class' => 'form-control','required','autocomplete' => 'off')) !!}
    @else
        {!! Form::text('date', $date ?? date('d-m-Y'), array('id' => 'date', 'class' => 'form-control','required','autocomplete' => 'off')) !!}
    @endif

    @error('date')
    <span class="help-block">
                                          <strong>{{ $message  }}</strong>
                                        </span>
    @enderror
</div>
<div class="form-group col-md-6{{ $errors->has('invoice_number') ? ' has-error' : '' }}">
    <label for="invoice_number">@lang('Purchase Invoice Number (If any)')</label>
    {!! Form::text('invoice_number', NULL, array('id' => 'invoice_number', 'class' => 'form-control','autocomplete' => 'off')) !!}
    @error('invoice_number')
    <span class="help-block">
                                           <strong>{{ $message  }}</strong>
                                        </span>
    @enderror
</div>
<div class="form-group col-md-6{{ $errors->has('file') ? ' has-error' : '' }}">
    <label class="control-label upperlabel">@lang('Attach Document')</label>
    <div class="button-wrapper">
                                      <span class="label">
                                       @lang('Choose File')
                                      </span>
        <input type="file" name="file" id="file"
               class="form-control upload-box"
               accept="*" placeholder="@lang('Upload File')">
    </div>
    @error('file')
    <span class="help-block">
                                            <strong>{{ $message  }}</strong>
                                        </span>
    @enderror
</div>
<div class="form-group col-md-6{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description">@lang('Description')</label>
    {!! Form::textarea('description', NULL, array('rows'=>1,'id' => 'description', 'class' => 'form-control','autocomplete' => 'off')) !!}
    @error('description')
    <span class="help-block">
                                            <strong>{{ $message  }}</strong>
                                        </span>
    @enderror
</div>
