@extends(config('process-manager.views.extend'))
@section('title','افزودن مراحل فرایند جدید')

@section('style')
    <style>
        table, table tr, table td {
            text-align: center;
        }
    </style>
@endsection
@section(config('process-manager.views.content'))

    <div class="container product">

        {!! Form::open(['route'=>'admin.process-managers.process-step.store','class'=>'product-create', 'data-parsley-validate']) !!}

        <div class="label-input">
            {!! Form::label('name','Name', ['class' => 'pull-right']) !!}
            {{ Form::text('name', old('name'), ['required', 'data-parsley-trigger'=>'change']) }}
            {!! $errors->first('name','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('priority','Priority', ['class' => 'pull-right']) !!}
            {{ Form::number('priority', old('priority'), ['required', 'data-parsley-trigger'=>'change', 'dir'=>'ltr', 'min'=>0]) }}
            {!! $errors->first('priority','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('alias','Alias', ['class' => 'pull-right']) !!}
            {{ Form::text('alias', old('alias'), ['required', 'data-parsley-trigger'=>'change', 'dir'=>'ltr']) }}
            {!! $errors->first('alias','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('process_id','Process', ['class' => 'pull-right']) !!}
            {{ Form::select('process_id', $processes, old('process_id'), ['required', 'data-parsley-trigger'=>'change', 'placeholder'=>'انتخاب کنید']) }}
            {!! $errors->first('process_id','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('presenter_group_id','Presenter Group', ['class' => 'pull-right']) !!}
            {{ Form::select('presenter_group_id', $groups, old('presenter_group_id'), ['required', 'data-parsley-trigger'=>'change', 'placeholder'=>'انتخاب کنید']) }}
            {!! $errors->first('presenter_group_id','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('group_mode','Group Mode', ['class' => 'pull-right']) !!}
            {{ Form::select('group_mode', ['0'=>'ادمین', '1'=>'کاربر'],old('group_mode'), ['required', 'data-parsley-trigger'=>'change', 'placeholder'=>'انتخاب کنید']) }}
            {!! $errors->first('group_mode','<span>:message</span>') !!}
        </div>

        {!! link_to_route('admin.process-managers.process-step.index', 'انصراف', [], ['class' =>'btn btn-danger']) !!}
        {!! Form::submit('ارسال', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}


    </div>



@endsection

@section('scripts')
    @includeIf(config('process-manager.views.parsley'))

@endsection