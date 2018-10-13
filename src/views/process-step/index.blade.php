@extends(config('process-manager.views.extend'))
@section('title','مراحل فرایند')
@section(config('process-manager.views.content'))
    <div class="container">
        @include('flash::message')

        {!! link_to_route('admin.process-managers.process-step.create','افزودن مراحل فرایند جدید ',null) !!}
        <table class="striped checkbox-s table-ss table-bordered">
            <thead>
            <tr>
                <th width="1%">ردیف</th>
                <th>نام</th>
                <th>فرایند</th>
                <th>نام مستعار</th>
                <th>گروه کاربری</th>
                <th>حالت کاربری</th>
                <th>عملیات</th>
            </tr>
            </thead>
            @foreach($process_steps as $item)
                <tr>

                    <td>{{($process_steps->currentPage() - 1 ) * ($process_steps->perPage() ) + $loop->iteration}}</td>
                    <td>{!! $item->name !!}</td>
                    <td>{!! $item->alias !!}</td>
                    <td>{!! $item->group->name !!}</td>
                    <td>{!! $item->groupModeName !!}</td>
                    <td>
                        <a href="" data-toggle="control-sidebar" class="gearIcon"><i class="fa fa-cog"
                                                                                     aria-hidden="true"></i></a>
                        <div class="gearMenu deactive">
                            {!! link_to_route('admin.process-managers.process-step.edit','ویرایش',$item->id,['class'=>'btn btn-primary']) !!}

                            {!! Form::model($item, ['route' => ['admin.process-managers.process-step.destroy',$item->id], 'method' => 'DELETE','class'=>'delete_btn']) !!}
                            {!! Form::submit('حذف',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $process_steps->appends(Request::all())->links() }}
    </div>
@endsection

