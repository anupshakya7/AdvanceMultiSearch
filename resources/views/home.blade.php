@extends('layout.web')
@section('content')
{{-- Search Bar View --}}
<div class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card p-4 mt-3 shadow">
                <form id="handleSearch">
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
    <div class="row" id="results">
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
                    <h4 class="heading text-uppercase">{{$result->university}}<br>
                        <h6 class="mt-3 badge text-white p-2" style="background-color:#536bf6;">{{$result->course}}</h6>
                    </h4>
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
        if(course_id != ""){
            $.ajax({
                url:'api/search/intake',
                method:"GET",
                data:{
                    course_id:course_id
                },
                success:function(response){
                    $('#intake').html('');
                    $('#intake').append('<option value="">Select Intake</option>');
                    $.each(response.intake,function(index,month){
                        $('#intake').append('<option value="'+month+'">'+month+'</option>');
                   });
                }
            })
        }else{
            $('#intake').html('');
            $('#intake').append('<option value="">Select Intake</option>\
                                <option value="Jan">Jan</option>\
                                <option value="Feb">Feb</option>\
                                <option value="Mar">Mar</option>\
                                <option value="Apr">Apr</option>\
                                <option value="May">May</option>\
                                <option value="Jun">Jun</option>\
                                <option value="Jul">Jul</option>\
                                <option value="Aug">Aug</option>\
                                <option value="Sep">Sep</option>\
                                <option value="Oct">Oct</option>\
                                <option value="Nov">Nov</option>\
                                <option value="Dec">Dec</option>'
                            );
        }
    
    });

    //Search List Acoording to Select Value
    $('#handleSearch').submit(function(e){
        e.preventDefault();
        let country = $('#country').val();
        let university = $('#university').val();
        let course = $('#course').val();
        let intake = $('#intake').val();
        let level = $('#level').val();

        $.ajax({
            url:'api/search/main',
            method:"GET",
            data:{
                country:country,
                university:university,
                course:course,
                intake:intake,
                level:level
            },
            success:function(response){
                $('#results').html('');
                $.each(response.search,function(index,item){
                    $('#results').append('<div class="col-md-4">\
                    <div class="card p-3 mb-4 shadow text-center equal_height">\
                        <div class="d-flex justify-content-between">\
                            <div class="d-flex flex-row align-items-center">\
                                <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>\
                                <div class="ms-2 c-details">\
                                    <h6 class="mb-0">'+item.level+'</h6>\
                                </div>\
                            </div>\
                            <div class="badge"> <span class="text-dark ">'+item.country+'</span> </div>\
                        </div>\
                        <div class="mt-5">\
                            <h4 class="heading text-uppercase">'+item.university+'<br>\
                                <h6 class="mt-3 badge text-white p-2" style="background-color:#536bf6;">'+item.course+'</h6>\
                            </h4>\
                            <br><span class="badge" style="background-color:#306fad;">'+item.intake+'</span></div>\
                    </div>\
                </div>\
                ')
                });
                $(".equal_height").matchHeight();
            }
        })
        
    })
    //Search List Acoording to Select Value
});
</script>
@endsection