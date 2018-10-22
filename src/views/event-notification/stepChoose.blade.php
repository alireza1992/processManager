@extends(config('process-manager.views.extend'))
@section('title','انتخاب مرحله')

@section('style')
    <style>
        table, table tr, table td {
            text-align: center;
        }
    </style>
@endsection
@section(config('process-manager.views.content'))

    <div class="container product">

        {!! Form::open(['route'=>'admin.process-managers.process.store','class'=>'product-create', 'data-parsley-validate']) !!}

        <div class="label-input">
            {!! Form::label('نوع اعلان','نوع اعلان', ['class' => 'pull-right']) !!}
            {{ Form::radio('نوع اعلان', 0,['readonly'=>true])}}زمان بندی شده
            {{ Form::radio('نوع اعلان', 1,true) }}در لحظه
            {!! $errors->first('نوع اعلان','<span>:message</span>') !!}
        </div>

        {{--<div class="label-input" id="stepChoose">--}}
            {{--{!! Form::label('step_id','مرحله', ['class' => 'pull-right']) !!}--}}
            {{--{{ Form::select('step_id', array_merge(['' => 'یک گزینه را انتخاب کنید :'], $processArray),old('step_id'),['id'=>'step_id'])}}--}}
            {{--{!! $errors->first('step_id','<span>:message</span>') !!}--}}
        {{--</div>--}}

        <table class="striped checkbox-s table-ss table-bordered">
            <thead>
            <tr>
                <th width="1%">ردیف</th>
                <th>عنوان</th>
                <th>اولویت</th>
                <th>گروه کاربری</th>
                <th>نوع گروه کاربری</th>
                <th>شناسه سیسستمی</th>
            </tr>
            </thead>
        @foreach($array  as $admin)
            <tr>
                <td>
                    <input type="radio" name="step_id" id="step_id" data-id="{{$processId}}" value="{{$admin->id}}">
                </td>
                <td>{!! $admin->name !!}</td>
                <td>{!! $admin->priority !!}</td>
                <td>{!! $admin->group['name'] !!}</td>
                <td>{!! $admin->groupModeName !!}</td>
                <td>{!! $admin->alias !!}</td>
            </tr>
        @endforeach
        </table>

        {!! link_to_route('admin.process-managers.process.index', 'انصراف', [], ['class' =>'btn btn-danger']) !!}
        {!! Form::submit('ارسال', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}

        <div class="variables"></div>

    </div>



@endsection

@section('scripts')
    @includeIf(config('process-manager.views.parsley'))

@endsection