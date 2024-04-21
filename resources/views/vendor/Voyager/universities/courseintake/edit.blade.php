@extends('voyager::master')
@section('page_title', 'Edit Course & Intake')
@section('page_header')
<div class="container-fluid">
    <h1 class="page-title">
        <i class="voyager-sun"></i> Edit Course & Intake
    </h1>
    @include('voyager::multilingual.language-selector')
</div>
@endsection
@section('content')
<div class="page-content edit-add container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <!-- form start -->
                <form role="form" class="form-edit-add" action="{{route('admin.course-intake.update')}}" method="POST"
                    enctype="multipart/form-data">

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
                        <div id="courseintakeadd">
                            <input type="hidden" name="id" value="{{$id}}">
                            <div class="courseintakecard">
                                <div class="form-group col-md-5">
                                    <label class="control-label" for="course">Course</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="courses"
                                        name="course" required>
                                        @foreach ($courses as $course)
                                       
                                        <option value="{{$course->id}}" @if($selectedCourses && $course->id == $selectedCourses->id) selected @endif>{{$course->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <?php
                                    $intakes = json_decode($pivotTable->intake);
                                ?>
                                <div class="form-group col-md-5">
                                    <label class="control-label" for="intake">Intake</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="intake" multiple
                                        name="intake[]">
                                        <option value="Jan" @foreach($intakes as $intake) {{$intake == 'Jan' ? 'selected':''}} @endforeach>Jan</option>
                                        <option value="Feb" @foreach($intakes as $intake) {{$intake == 'Feb' ? 'selected':''}} @endforeach>Feb</option>
                                        <option value="Mar" @foreach($intakes as $intake) {{$intake == 'Mar' ? 'selected':''}} @endforeach>Mar</option>
                                        <option value="Apr" @foreach($intakes as $intake) {{$intake == 'Apr' ? 'selected':''}} @endforeach>Apr</option>
                                        <option value="May" @foreach($intakes as $intake) {{$intake == 'May' ? 'selected':''}} @endforeach>May</option>
                                        <option value="Jun" @foreach($intakes as $intake) {{$intake == 'Jun' ? 'selected':''}} @endforeach>Jun</option>
                                        <option value="Jul" @foreach($intakes as $intake) {{$intake == 'Jul' ? 'selected':''}} @endforeach>Jul</option>
                                        <option value="Aug" @foreach($intakes as $intake) {{$intake == 'Aug' ? 'selected':''}} @endforeach>Aug</option>
                                        <option value="Sep" @foreach($intakes as $intake) {{$intake == 'Sep' ? 'selected':''}} @endforeach>Sep</option>
                                        <option value="Oct" @foreach($intakes as $intake) {{$intake == 'Oct' ? 'selected':''}} @endforeach>Oct</option>
                                        <option value="Nov" @foreach($intakes as $intake) {{$intake == 'Nov' ? 'selected':''}} @endforeach>Nov</option>
                                        <option value="Dec" @foreach($intakes as $intake) {{$intake == 'Dec' ? 'selected':''}} @endforeach>Dec</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <a href="javascript:void(0);" class="remove-entry btn btn-danger"
                                        style="margin-top: 25px !important;">
                                        <span data-icon="C" class="icon"></span>
                                    </a>
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
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{
                    __('voyager::generic.cancel') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('javascript')
<script>
    $(document).ready(function(){

    });
</script>
@endsection