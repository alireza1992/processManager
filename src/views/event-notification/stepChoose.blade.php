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

        {!! Form::open(['route'=>'admin.process-managers.event-notification.saveParameters','class'=>'product-create', 'data-parsley-validate']) !!}

        <div class="label-input">
            {!! Form::label('نوع اعلان','نوع اعلان', ['class' => 'pull-right']) !!}
            {{ Form::radio('نوع اعلان', 0,['readonly'=>true])}}زمان بندی شده
            {{ Form::radio('نوع اعلان', 1,true) }}در لحظه
            {!! $errors->first('نوع اعلان','<span>:message</span>') !!}
        </div>

        <div class="label-input">
            {!! Form::label('status','وضعیت ارسال اعلان', ['class' => 'pull-right']) !!}
            {{ Form::radio('status', 1,true)}}فعال
            {{ Form::radio('status', 0) }}غیرفعال
            {!! $errors->first('status','<span>:message</span>') !!}
        </div>

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
        @foreach($array  as $step)
            <tr>
                <td>
                    <input type="radio" name="step_id" id="step_id" data-id="{{$processId}}" value="{{$step->id}}">
                </td>
                <td>{!! $step->name !!}</td>
                <td>{!! $step->priority !!}</td>
                <td>{!! $step->group['name'] !!}</td>
                <td>{!! $step->groupModeName !!}</td>
                <td>{!! $step->alias !!}</td>
            </tr>
        @endforeach
        </table>

        <input type="hidden" name="notificationId" value="{{$notificationId}}">
        <input type="hidden" name="processId" value="{{$processId}}">

        <div class="conditions">
        @include('processmanager::event-notification.conditions')
        </div>

        {!! link_to_route('admin.process-managers.event-notification.index', 'انصراف', [], ['class' =>'btn btn-danger']) !!}
        {!! Form::submit('ارسال', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}


    </div>

@endsection

@section('scripts')
    @includeIf(config('process-manager.views.parsley'))

@endsection