@extends('config('process-manager.views.extend')')
@section('title','فرایندان')
@section(config('process-manager.views.content'))
    <div class="container">
        @include('flash::message')

        {!! link_to_route('admin.process-managers.create','افزودن فرایند جدید ',null) !!}
        <table class="striped checkbox-s table-ss table-bordered">
            <thead>
            <tr>
                <th width="1%">ردیف</th>
                <th>نام فرایندان</th>
                <th>کد ملی</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            @foreach($admins as $admin)
                <tr>

                    <td>{{($admins->currentPage() - 1 ) * ($admins->perPage() ) + $loop->iteration}}</td>
                    <td>{!! $admin->name !!}</td>
                    <td>{!! $admin->id_code !!}</td>
                    <td>{!! $admin->statusName !!}</td>
                    <td>
                        <a href="" data-toggle="control-sidebar" class="gearIcon"><i class="fa fa-cog"
                                                                                     aria-hidden="true"></i></a>
                        <div class="gearMenu deactive">
                            {!! link_to_route('admin.process-managers.edit','ویرایش',$admin->id,['class'=>'btn btn-primary']) !!}

                            {!! Form::model($admin, ['route' => ['admin.process-managers.destroy',$admin->id], 'method' => 'DELETE','class'=>'delete_btn']) !!}
                            {!! Form::submit('حذف',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

        {{ $admins->appends(Request::all())->links() }}
    </div>
@endsection

