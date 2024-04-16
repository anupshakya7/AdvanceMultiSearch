@extends('voyager::master')
@section('page_title', 'Adding Univiersity & Courses')
@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-sun"></i> Univiersity & Courses
        </h1>
        @include('voyager::multilingual.language-selector')
    </div>
@stop
@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form" class="form-edit-add" action="" method="POST" enctype="multipart/form-data">

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group col-md-12">
                                <label class="control-label" for="university">University</label>
                                <select class="form-control select2 select2-hidden-accessible" name="university" required>
                                    <option value="" >Select University</option>
                                    @foreach($universities as $university)
                                        <option value="{{$university->id}}" >{{$university->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary" id="addNewCourseIntake" style="float:right;">Add Courses & Intake</button>
                            </div>
                            <div class="courseintakeadd">
                                <div class="courseintakecard">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="course">Course</label>
                                        <select class="form-control select2 select2-hidden-accessible" name="course" required>
                                            @foreach ($courses as $course)
                                                <option value="{{$course->id}}">{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="intake">Intake</label>
                                        <select class="form-control select2 select2-hidden-accessible" multiple name="intake[]">
                                            <option value="Jan">Jan</option>
                                            <option value="Feb">Feb</option>
                                            <option value="Mar">Mar</option>
                                            <option value="Apr">Apr</option>
                                            <option value="May">May</option>
                                            <option value="Jun">Jun</option>
                                            <option value="Jul">Jul</option>
                                            <option value="Aug">Aug</option>
                                            <option value="Sep">Sep</option>
                                            <option value="Oct">Oct</option>
                                            <option value="Nov">Nov</option>
                                            <option value="Dec">Dec</option>
                                        </select>
                                    </div>
                                </div>   
                            </div>

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                        @section('submit-buttons')
                            <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                        @stop
                        @yield('submit-buttons')
                    </div>
                </form>

                <div style="display:none">
                    <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">


                </div>
            </div>
        </div>
    </div>
</div>

{{-- Single delete modal --}}
<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }}</h4>
            </div>
            <div class="modal-footer">
                <form action="#" id="delete_form" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger pull-right delete-confirm"
                        value="{{ __('voyager::generic.delete_confirm') }}">
                </form>
                <button type="button" class="btn btn-default pull-right"
                    data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
@section('javascript')
    <script>
        $(document).ready(function(){
            $('#addNewCourseIntake').click(function(e){
                e.preventDefault();
            })
        });
    </script>
@stop