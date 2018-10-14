@extends(config('process-manager.views.extend'))
@section('title','وضعیت مراحل فرایند')
@section(config('process-manager.views.content'))
    <div class="container">
        @include('flash::message')

        {!! link_to_route('admin.process-managers.process-step-status.create','افزودن وضعیت مراحل فرایند جدید ',null) !!}
        <table class="striped checkbox-s table-ss table-bordered">
            <thead>
            <tr>
                <th width="1%">ردیف</th>
                <th>نام وضعیت</th>
                <th>نام مستعار</th>
                <th>مرحله فرایند</th>
                <th>عملیات</th>
            </tr>
            </thead>
            @foreach($process_step_statuses as $item)
                <tr>

                    <td>{{($process_step_statuses->currentPage() - 1 ) * ($process_step_statuses->perPage() ) + $loop->iteration}}</td>
                    <td>{!! $item->status_name !!}</td>
                    <td>{!! $item->alias !!}</td>
                    <td>{!! $item->process_step->name !!}</td>
                    <td>
                        <a href="" data-toggle="control-sidebar" class="gearIcon"><i class="fa fa-cog"
                                                                                     aria-hidden="true"></i></a>
                        <div class="gearMenu deactive">
                            {!! link_to_route('admin.process-managers.process-step-status.edit','ویرایش',$item->id,['class'=>'btn btn-primary']) !!}

                            {!! Form::model($item, ['route' => ['admin.process-managers.process-step-status.destroy',$item->id], 'method' => 'DELETE','class'=>'delete_btn']) !!}
                            {!! Form::submit('حذف',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $process_step_statuses->appends(Request::all())->links() }}
    </div>
@endsection

