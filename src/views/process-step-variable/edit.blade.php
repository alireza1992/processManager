@extends(config('process-manager.views.extend'))
@section('title','ویرایش مقدار مراحل فرایند')

@section('style')
    <style>
        table, table tr, table td {
            text-align: center;
        }
    </style>
@endsection
@section(config('process-manager.views.content'))
    <div class="container product">
        @include('flash::message')

        {!! Form::model($process_step_variable,['route'=>['admin.process-managers.process-step-variable.update',$process_step_variable->id],'method'=>'PATCH']) !!}
        <div class="container product">

            <div class="label-input">
                {!! Form::label('name','Name', ['class' => 'pull-right']) !!}
                {{ Form::text('name', old('name'), ['required', 'data-parsley-trigger'=>'change']) }}
                {!! $errors->first('name','<span>:message</span>') !!}
            </div>
            <div class="label-input">
                {!! Form::label('alias','Alias', ['class' => 'pull-right']) !!}
                {{ Form::text('alias', old('alias'), ['required', 'data-parsley-trigger'=>'change']) }}
                {!! $errors->first('alias','<span>:message</span>') !!}
            </div>
            <div class="label-input">
                {!! Form::label('desc','Desc', ['class' => 'pull-right']) !!}
                {{ Form::text('desc', old('desc'), ['required', 'data-parsley-trigger'=>'change']) }}
                {!! $errors->first('desc','<span>:message</span>') !!}
            </div>
            <div class="label-input">
                {!! Form::label('process_step_id','Process Steps', ['class' => 'pull-right']) !!}
                {{ Form::select('process_step_id', $process_steps, old('process_step_id'), ['required', 'data-parsley-trigger'=>'change', 'placeholder'=>'انتخاب کنید']) }}
                {!! $errors->first('process_step_id','<span>:message</span>') !!}
            </div>
            <div class="label-input">
                {!! Form::label('type','type', ['class' => 'pull-right']) !!}
                {{ Form::text('type', old('type'), ['required', 'data-parsley-trigger'=>'change', 'dir'=>'ltr']) }}
                {!! $errors->first('type','<span>:message</span>') !!}
            </div>


            {!! link_to_route('admin.process-managers.process-step-variable.index', 'انصراف', [], ['class' =>'btn btn-danger']) !!}
            {!! Form::submit('ارسال', ['class' => 'btn btn-primary']) !!}


        </div>
        {!! Form::close() !!}
    </div>

@endsection


@section('scripts')
    @includeIf(config('process-manager.views.parsley'))
@endsection