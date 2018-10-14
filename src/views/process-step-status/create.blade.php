@extends(config('process-manager.views.extend'))
@section('title','افزودن وضعیت مراحل فرایند جدید')

@section('style')
    <style>
        table, table tr, table td {
            text-align: center;
        }
    </style>
@endsection
@section(config('process-manager.views.content'))

    <div class="container product">

        {!! Form::open(['route'=>'admin.process-managers.process-step-status.store','class'=>'product-create', 'data-parsley-validate']) !!}

        <div class="label-input">
            {!! Form::label('status_code','Status Code', ['class' => 'pull-right']) !!}
            {{ Form::number('status_code', old('status_code'), ['required', 'data-parsley-trigger'=>'change', 'min'=>'0']) }}
            {!! $errors->first('status_code','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('status_name','Status Name', ['class' => 'pull-right']) !!}
            {{ Form::text('status_name', old('status_name'), ['required', 'data-parsley-trigger'=>'change']) }}
            {!! $errors->first('status_name','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('alias','Alias', ['class' => 'pull-right']) !!}
            {{ Form::text('alias', old('alias'), ['required', 'data-parsley-trigger'=>'change', 'dir'=>'ltr']) }}
            {!! $errors->first('alias','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('process_step_id','Process Steps', ['class' => 'pull-right']) !!}
            {{ Form::select('process_step_id', $process_steps, old('process_step_id'), ['required', 'data-parsley-trigger'=>'change', 'placeholder'=>'انتخاب کنید']) }}
            {!! $errors->first('process_step_id','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('message','Message', ['class' => 'pull-right']) !!}
            {{ Form::text('message', old('message'), ['required', 'data-parsley-trigger'=>'change']) }}
            {!! $errors->first('message','<span>:message</span>') !!}
        </div>

        {!! link_to_route('admin.process-managers.process-step-status.index', 'انصراف', [], ['class' =>'btn btn-danger']) !!}
        {!! Form::submit('ارسال', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}


    </div>



@endsection

@section('scripts')
    @includeIf(config('process-manager.views.parsley'))

@endsection