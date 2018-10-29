@extends(config('process-manager.views.extend'))
@section('title','فرایند ها')
@section(config('process-manager.views.content'))
    <div class="container">
        @include('flash::message')

        {!! link_to_route('admin.process-managers.process.create','افزودن فرایند جدید ',null) !!}
        <table class="striped checkbox-s table-ss table-bordered">
            <thead>
            <tr>
                <th width="1%">ردیف</th>
                <th>نام فرایند</th>
                <th>نام مستعار</th>
                <th>مدل</th>
                <th>عملیات</th>
            </tr>
            </thead>
            @foreach($processes as $item)
                <tr>

                    <td>{{($processes->currentPage() - 1 ) * ($processes->perPage() ) + $loop->iteration}}</td>
                    <td>{!! $item->name !!}</td>
                    <td>{!! $item->alias !!}</td>
                    <td>{!! $item->model !!}</td>
                    <td>
                        <a href="" data-toggle="control-sidebar" class="gearIcon"><i class="fa fa-cog"
                                                                                     aria-hidden="true"></i></a>
                        <div class="gearMenu deactive">
                            {!! link_to_route('admin.process-managers.process.edit','ویرایش',$item->id,['class'=>'btn btn-primary']) !!}

                            {!! Form::model($item, ['route' => ['admin.process-managers.process.destroy',$item->id], 'method' => 'DELETE','class'=>'delete_btn']) !!}
                            {!! Form::submit('حذف',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $processes->appends(Request::all())->links() }}
    </div>
@endsection

