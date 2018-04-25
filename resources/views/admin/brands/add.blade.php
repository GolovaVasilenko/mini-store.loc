@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
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

                        <!-- /.box-header -->
                        <div class="box-body">
                           <div class="block-form">
                              {!! Form::open(['route' => 'brands.store']) !!}
                                   <div class="box-body">
                                       <div class="form-group">
                                           {!! Form::label('name', 'Brand Name') !!}
                                           {!! Form::text('name', '', ['class' => 'form-control']) !!}
                                       </div>
                                       <div class="form-group">
                                           {!! Form::label('slug', 'Brand URL') !!}
                                           {!! Form::text('slug', '', ['class' => 'form-control']) !!}
                                       </div>
                                       <div class="form-group">
                                           <label for="exampleInputFile">File input</label>
                                           <input type="file" id="exampleInputFile">

                                           <p class="help-block">Example block-level help text here.</p>
                                       </div>
                                       <div class="checkbox">
                                           <label>
                                               <input type="checkbox"> Check me out
                                           </label>
                                       </div>
                                   </div>
                                   <!-- /.box-body -->

                                   <div class="box-footer">
                                       <button type="submit" class="btn btn-primary">Submit</button>
                                   </div>
                               {!! Form::close() !!}
                           </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>

        </section>
    </div>

@endsection