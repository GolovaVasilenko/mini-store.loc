@extends('layouts.admin')


@section('content')
    <section class="content-header">
        <h1>
            Widgets
            <small>Preview page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Widgets</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
            <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <a class="btn btn-primary" href="{{ route('brands.index') }}">Return to List</a>
                        <a class="btn btn-primary" href="{{ route('brands.edit', $brand->id) }}">Edit item</a>
                        {{ Form::open(['route' => ['brands.destroy', $brand->id],
                                    'method' => 'delete', 'class' => 'delete-form']) }}
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены что хотите удалить елемент?')">
                            Delete Item
                        </button>

                        {{ Form::close() }}
                    </div>
                    <!-- /.user-block -->
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read">
                            <i class="fa fa-circle-o"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <h1>{{ $brand->name }}</h1>
                    <p>URL: {{ $brand->slug }}</p>
                    <img class="img-responsive pad" src="{{ $brand->getImage() }}" alt="">


                </div>
                <!-- /.box-body -->

                <!-- /.box-footer -->
                <div class="box-footer">

                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        </div>
    </section>
@endsection