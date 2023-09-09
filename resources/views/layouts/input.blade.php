@if(!isset($required))
    @php($required = false)
@endif
@if ($type == 'password')
    {!! Form::password($name, array('id' => $name, 'class' => 'form-control', 'autocomplete' => 'off',($required ? 'required' : ''))) !!}
@elseif ($type == 'select')
    {!! Form::select($name,$array??array(),null, array('id' => $name, 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => trans('Choose'),($required ? 'required' : ''))) !!}
@else
    {!! Form::$type($name, NULL, array('id' => $name, 'class' => 'form-control', 'autocomplete' => 'off',($required ? 'required' : ''))) !!}
@endif