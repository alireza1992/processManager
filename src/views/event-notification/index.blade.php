@extends(config('process-manager.views.extend'))
@section('title','اعلان ها')
@section(config('process-manager.views.content'))
    <div class="container">
        @include('flash::message')

        {!! link_to_route('admin.process-managers.event-notification.create','افزودن اعلان جدید ',null) !!}
        <table class="striped checkbox-s table-ss table-bordered">
            <thead>
            <tr>
                <th width="1%">ردیف</th>
                <th>نام فرایند</th>
                <th>مرحله</th>
                <th>تارگت</th>
                <th>متن</th>
                <th>عملیات</th>
            </tr>
            </thead>
            @foreach($notifications as $item)
                <tr>
                    <td>{{($notifications->currentPage() - 1 ) * ($notifications->perPage() ) + $loop->iteration}}</td>
                    <td>{!! $item->process['name'] !!}</td>
                    <td>{!! $item->step['name'] !!}</td>
                    <td>{!! $item->target_id !!}</td>
                    <td>{!! $item->body !!}</td>
                    <td>
                        <a href="" data-toggle="control-sidebar" class="gearIcon"><i class="fa fa-cog" aria-hidden="true"></i></a>
                        <div class="gearMenu deactive">
                            {!! link_to_route('admin.process-managers.event-notification.edit','ویرایش',$item->id,['class'=>'btn btn-primary']) !!}

                            {!! Form::model($item, ['route' => ['admin.process-managers.event-notification.destroy',$item->id], 'method' => 'DELETE','class'=>'delete_btn']) !!}
                            {!! Form::submit('حذف',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $notifications->appends(Request::all())->links() }}
    </div>
@endsection

