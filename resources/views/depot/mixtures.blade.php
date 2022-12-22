@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    اضافة صادر
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة صادر</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('mixtures.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">اسم الخلطة</label>
                                <select id="Mix"  name="Mix" class="form-control">

                                </select>
                            </div>


                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <select name="Section" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد القسم</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <style>
                            .parent{
                                display: flex;
                                justify-content: space-around;
                                padding-top: 20px ;
                            }
                            .amount{
                                background-color:
                                background: #0019ff;
                                background: linear-gradient(0deg,#0019ff -66%, #ff00a8 80%);
                                background: -webkit-linear-gradient(0deg,#0019ff -66%, #ff00a8 80%);
                                background: -moz-linear-gradient(0deg,#0019ff -66%, #ff00a8 80%);
                                                ;
                            }
                        </style>
                        <div class=" parent">
                            <h5>اسم المادة</h5>
                            <h5> الكمية </h5>
                        </div>


                        {{-- 2 --}}
                        @for ($i = 0; $i <= 15; $i++)



                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label"> </label>
                                <select style="border-radius: 30px;" id="product"  name="product[]" class="form-control">

                                </select>
                            </div>

                            <div class="col">
                                <label> </label>
                                <input style=" color:rgb(255, 255, 255); border-radius: 30px;" type="text"  class="form-control amount"  id="amount" name="amount[]" >

                            </div>



                        </div>


                        @endfor

                        </div>
                        <h5 style="color: rgb(205, 72, 72)" align='center' >مجموع مواد الخلطة</h5>
                        <div class="col">
                            <input style="color: rgb(205, 72, 72)" type="number" disabled class="form-control total" name="total" id="total">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button id="btn"  type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection


@section('js')

    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>
<script>
    var prevValue = 0;
        $('#mix_id').on('keydown', function(e) {
        var field = $(this);
        // check if new value is more or equal to 255
        var mix_id = $('#mix_id').val
        var id = $('#id').val
                id = mix_id

                console.log(id)
        });
</script>

    <script>



        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "/mixture/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {

                            $('select[name="Mix"]').empty();

                            $.each(data, function(key, value) {

                                $('select[name="Mix"]').append('<option value="' +
                                value.id  + '">' + value.mix_name + '</option>');

                            });

                        },
                    });


                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>
    <script>



        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product[]"]').empty();
                            $('select[name="product[]"]').append('<option value="">اختيار مادة</option>');
                            $.each(data, function(key, value) {
                                $('select[name="product[]"]').append('<option value="' +
                                    key + '">' + value + '</option>');


                            });
                        },
                    });


                } else {
                    console.log('AJAX load did not work');
                }
            });

        });

    </script>

    <script>


$(document).on("input", ".amount", function() {
    var sum = 0;
    $("input[class *= 'amount']").each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
});




    </script>



@endsection
