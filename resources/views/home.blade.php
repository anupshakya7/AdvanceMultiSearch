@extends('layout.web')
@section('content')
    {{-- Search Bar View --}}
    <div class="container mt-4">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card p-4 mt-3 shadow">
                    <form action="">
                        <h3 class="heading text-center">Hi! How can we help You?</h3>
                        <div class="d-flex justify-content-center px-5">
    
                            <div class="search mx-1">
                                <select class="form-select" id="country" name="country">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="search mx-1">
                                <select class="form-select" id="university" name="university">
                                    <option value="">Select University</option>
                                    @foreach ($universities as $university)
                                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="search mx-1">
                                <select class="form-select" id="course" name="course">
                                    <option value="">Select Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="search mx-1">
                                <select class="form-select" id="intake" name="intake">
                                    <option value="">Select Intake</option>
                                    <option value="Jan">January</option>
                                    <option value="Feb">February</option>
                                    <option value="Mar">March</option>
                                    <option value="Apr">April</option>
                                    <option value="May">May</option>
                                    <option value="Jun">June</option>
                                    <option value="Jul">July</option>
                                    <option value="Aug">August</option>
                                    <option value="Sep">September</option>
                                    <option value="Oct">October</option>
                                    <option value="Nov">November</option>
                                    <option value="Dec">December</option>
                                </select>
                            </div>
                            <div class="search mx-1">
                                <select class="form-select" id="level" name="level">
                                    <option value="">Select Level</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                        </div>
                        <button id="submit_btn">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Search Bar View --}}

    {{-- Search Item View --}}
    <div class="container mt-5 mb-3">
        <div class="row">
            @foreach($results as $result)
            <div class="col-md-4">
                <div class="card p-3 mb-4 shadow text-center equal_height">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                            <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
                            <div class="ms-2 c-details">
                                <h6 class="mb-0">{{$result->level}}</h6>
                            </div>
                        </div>
                        <div class="badge"> <span class="text-dark ">{{$result->country}}</span> </div>
                    </div>
                    <div class="mt-5">
                        <h4 class="heading text-uppercase">{{$result->university}}<br><h6 class="mt-3 badge text-white p-2" style="background-color:#536bf6;">{{$result->course}}</h6></h4>
                        <br>
                        <?php
                            $intakes = json_decode($result->intake);
                        ?>
                        @foreach($intakes as $intake)
                            <span class="badge" style="background-color:#306fad;">{{$intake}}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{-- Search Item View --}}
@endsection

@section('script')
<script>
$(document).ready(function(){
    $(".equal_height").matchHeight();
    //Fetch University List Acoording to Country
    $('#country').change(function(){
        let country_id = $('#country').val();
            $.ajax({
                url:'api/search/university',
                method:"GET",
                data:{
                    country_id:country_id
                },
                success:function(response){
                    $('#university').html('');
                    $('#university').append('<option value="">Select University</option>');
                    $.each(response.university,function(index,item){
                        $('#university').append('<option value="'+item.id+'">'+item.name+'</option>');
                    }); 
                }
            })
    });

    //Fetch Course List Acoording to University
    $('#university').change(function(){
        let university_id = $('#university').val();
            $.ajax({
                url:'api/search/course',
                method:"GET",
                data:{
                    university_id:university_id
                },
                success:function(response){
                    $('#course').html('');
                    $('#course').append('<option value="">Select Course</option>');
                    $.each(response.courses,function(index,item){
                        $('#course').append('<option value="'+item.id+'">'+item.name+'</option>');
                    }); 
                }
            })
    });

    //Fetch Intake List Acoording to Course
    $('#course').change(function(){
        let course_id = $('#course').val();
            $.ajax({
                url:'api/search/intake',
                method:"GET",
                data:{
                    course_id:course_id
                },
                success:function(response){
                   console.log(response);
                }
            })
    });
});
</script>
@endsection
