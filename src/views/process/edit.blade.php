@extends(config('process-manager.views.extend'))
@section('title','ویرایش فرایند')

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

        {!! Form::model($process,['route'=>['admin.process-managers.process.update',$process->id],'method'=>'PATCH']) !!}
        <div class="container product">

            <div class="label-input">
                {!! Form::label('name','Name', ['class' => 'pull-right']) !!}
                {{ Form::text('name', old('name'), ['required', 'data-parsley-trigger'=>'change']) }}
                {!! $errors->first('name','<span>:message</span>') !!}
            </div>
            <div class="label-input">
                {!! Form::label('alias','Alias', ['class' => 'pull-right']) !!}
                {{ Form::text('alias', old('alias'), ['required', 'data-parsley-trigger'=>'change', 'dir'=>'ltr']) }}
                {!! $errors->first('alias','<span>:message</span>') !!}
            </div>
            <div class="label-input">
                {!! Form::label('model','Model', ['class' => 'pull-right']) !!}
                {{ Form::text('model', old('model'), ['required', 'data-parsley-trigger'=>'change', 'dir'=>'ltr']) }}
                {!! $errors->first('model','<span>:message</span>') !!}
            </div>

            {!! link_to_route('admin.process-managers.process.index', 'انصراف', [], ['class' =>'btn btn-danger']) !!}
            {!! Form::submit('ارسال', ['class' => 'btn btn-primary']) !!}


        </div>
        {!! Form::close() !!}
    </div>

@endsection


@section('scripts')
    @includeIf(config('process-manager.views.parsley'))
@endsection