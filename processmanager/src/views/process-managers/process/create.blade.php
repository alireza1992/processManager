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

        {!! Form::open(['route'=>'admin.process-managers.store','class'=>'product-create', 'data-parsley-validate']) !!}

        <div class="label-input">
            {!! Form::label('name','نام کاربر', ['class' => 'pull-right']) !!}
            {{ Form::text('name', old('name'), ['required', 'data-parsley-trigger'=>'change']) }}
            {!! $errors->first('name','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('email','ایمیل کاربر', ['class' => 'pull-right']) !!}
            {{ Form::text('email', old('email'), ['required', 'data-parsley-trigger'=>'change']) }}
            {!! $errors->first('email','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('cellphone','تلفن همراه کاربر', ['class' => 'pull-right']) !!}
            {{ Form::text('cellphone', old('cellphone'), ['required', 'data-parsley-trigger'=>'change']) }}
            {!! $errors->first('cellphone','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('id_code','کد ملی', ['class' => 'pull-right']) !!}
            {{ Form::text('id_code', old('id_code'), ['required', 'data-parsley-trigger'=>'change']) }}
            {!! $errors->first('id_code','<span>:message</span>') !!}
        </div>
        <div class="label-input">

            {!! Form::label('group_id', 'گروه کاربر') !!}
            @foreach($groups as $group)
                <p>
                    {!! Form::radio('group_id', $group->id ,old('group_id'), ['class' => 'pull-right','required']) !!}
                    <span
                            class="pull-right">{{$group->name}}</span>
                </p>
            @endforeach
            {!! $errors->first('group_id','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('password','رمز عبور', ['class' => 'pull-right']) !!}
            {{ Form::password('password', null, ['required', 'data-parsley-trigger'=>'change']) }}
            {!! $errors->first('password','<span>:message</span>') !!}
        </div>
        <div class="label-input">
            {!! Form::label('password_confirmation','رمز عبور', ['class' => 'pull-right']) !!}
            {{ Form::password('password_confirmation', null, ['required', 'data-parsley-trigger'=>'change']) }}
            {!! $errors->first('password','<span>:message</span>') !!}
        </div>
        <div class="label-input">

            {!! Form::label('status', 'وضعیت کاربر') !!}
            <p>
                {!! Form::radio('status', 0 ,old('status'), ['class' => 'pull-right','required']) !!} <span
                        class="pull-right">غیر فعال</span>
            </p>
            <p>
                {!! Form::radio('status', 1 ,true, ['class' => 'pull-right']) !!} <span
                        class="pull-right">فعال</span>
            </p>
            {!! $errors->first('status','<span>:message</span>') !!}
        </div>


        {!! link_to_route('admin.process-managers.index', 'انصراف', [], ['class' =>'btn btn-danger']) !!}
        {!! Form::submit('ارسال', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}


    </div>



@endsection

@section('scripts')
    @includeIf(config('process-manager.views.parsley'))

@endsection