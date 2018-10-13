@extends(config('process-manager.views.extend'))
@section('title','مقدار مراحل فرایند')
@section(config('process-manager.views.content'))
    <div class="container">
        @include('flash::message')

        {!! link_to_route('admin.process-managers.process-step-variable.create','افزودن مقدار مراحل فرایند جدید ',null) !!}
        <table class="striped checkbox-s table-ss table-bordered">
            <thead>
            <tr>
                <th width="1%">ردیف</th>
                <th>نام</th>
                <th>نام مستعار</th>
                <th>مرحله فرایند</th>
                <th>نوع</th>
                <th>عملیات</th>
            </tr>
            </thead>
            @foreach($process_step_variables as $item)
                <tr>

                    <td>{{($process_step_variables->currentPage() - 1 ) * ($process_step_variables->perPage() ) + $loop->iteration}}</td>
                    <td>{!! $item->status_name !!}</td>
                    <td>{!! $item->alias !!}</td>
                    <td>{!! $item->process_step->name !!}</td>
                    <td>{!! $item->type !!}</td>
                    <td>
                        <a href="" data-toggle="control-sidebar" class="gearIcon"><i class="fa fa-cog"
                                                                                     aria-hidden="true"></i></a>
                        <div class="gearMenu deactive">
                            {!! link_to_route('admin.process-managers.process-step-variable.edit','ویرایش',$item->id,['class'=>'btn btn-primary']) !!}

                            {!! Form::model($item, ['route' => ['admin.process-managers.process-step-variable.destroy',$item->id], 'method' => 'DELETE','class'=>'delete_btn']) !!}
                            {!! Form::submit('حذف',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $process_step_variables->appends(Request::all())->links() }}
    </div>
@endsection

