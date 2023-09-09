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
<div class="form-group col-md-6 {{ $errors->has('ledger_id_credit') ? ' has-error' : '' }}">
    <label style="font-weight: bold" for="ledger_id_credit">@lang('Ledger Credit (Amount Out)') <span class="text-danger">*</span></label>
    <select class="form-control" id="ledger_id_credit" required name="ledger_id_credit">
        <option value="" selected>@lang('Choose')</option>
        @foreach ($ledgers as $key => $value)
            <optgroup label="{{$key}}">
                @foreach ($value->sortBy('name') as $ledger)
                    <option value="{{$ledger->id}}" {{isset($income->ledger_id) && $income->ledger_id == $ledger->id ? 'selected' : '' }}>{{$ledger->name}}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
    @error('ledger_id_credit')
    <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group col-md-6 {{ $errors->has('ledger_id_david') ? ' has-error' : '' }}">
    <label style="font-weight: bold"  for="ledger_id_david">@lang('Ledger Debit (Amount In)') <span class="text-danger">*</span></label>
    <select class="form-control" id="ledger_id_david" required name="ledger_id_david">
        <option value="" selected>@lang('Choose')</option>
        @foreach ($ledgers as $key => $value)
            <optgroup label="{{$key}}">
                @foreach ($value->sortBy('name') as $ledger)
                    <option value="{{$ledger->id}}" {{isset($income->ledger_id) && $income->ledger_id == $ledger->id ? 'selected' : '' }}>{{$ledger->name}}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
    @error('ledger_id_david')
    <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>





<div class="form-group col-md-6{{ $errors->has('amount') ? ' has-error' : '' }}">
    <label for="amount">@lang('Amount') <span class="text-danger">*</span> </label>
    {!! Form::number('amount', NULL, array('id' => 'amount', 'class' => 'form-control', 'required','autocomplete' => 'off')) !!}
    @error('amount')
    <span class="help-block">
                                            <strong>{{ $message  }}</strong>
                                        </span>
    @enderror
</div>

<div class="form-group col-md-6{{ $errors->has('date') ? ' has-error' : '' }}">
    <label for="date">@lang('Date') <span class="text-danger">*</span></label>
    {!! Form::text('date', $date ?? date('d-m-Y'), array('id' => 'date', 'class' => 'form-control','required','autocomplete' => 'off')) !!}
    @error('date')
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
