@extends('layouts.admin')

@section('content')

    <section class="content-header">
        <h1>
            Data Tables
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sx-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Table With Full Features</h3>
                    </div>
                    <div class="manage-block btn-block">
                        <a href="{{ route("brands.create") }}" class="btn btn-primary">Add new Item</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>URL</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->slug }}</td>
                                <td>
                                    <div class="img-container">
                                        <img src="{{ $brand->getImage() }}" alt=""/>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('brands.edit', $brand->id) }}"><i class="fa fa-edit"></i></a>&nbsp;
                                    <a href="{{ route('brands.show', $brand->id) }}"><i class="fa fa-eye"></i></a>&nbsp;
                                    {{ Form::open(['route' => ['brands.destroy', $brand->id],
                                'method' => 'delete', 'class' => 'delete']) }}
                                    <button type="submit" onclick="return confirm('Вы уверены что хотите удалить елемент?')">
                                        <i class="fa fa-remove"></i>
                                    </button>

                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>URL</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>

@endsection
