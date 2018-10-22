@extends(config('process-manager.views.extend'))
@section('title','افزودن فرایند جدید')

@section('style')
    <style>
        table, table tr, table td {
            text-align: center;
        }
    </style>
@endsection
@section(config('process-manager.views.content'))

    <div class="container product">

        {!! Form::open(['route'=>'admin.process-managers.event-notification.store','class'=>'product-create', 'data-parsley-validate']) !!}

        <div class="label-input">
            {!! Form::label('process_id','انتخاب فرآیند', ['class' => 'pull-right']) !!}
            {{ Form::select('process_id',$processes, ['required', 'data-parsley-trigger'=>'change']) }}
            {!! $errors->first('process_id','<span>:message</span>') !!}
        </div>

        {!! link_to_route('admin.process-managers.process.index', 'انصراف', [], ['class' =>'btn btn-danger']) !!}
        {!! Form::submit('ارسال', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}


    </div>



@endsection

@section('scripts')
    @includeIf(config('process-manager.views.parsley'))

@endsection