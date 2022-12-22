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
                    <form action="{{ route('Manufacturings.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        <div class="row">
                            <div class="col">
                                <label>تاريخ الخلطة</label>
                                <input class="form-control fc-datepicker" name="out_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">اسم الخلطة</label>
                                <select id="Mix"  name="Mix" class="form-control" onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')" required>
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد خلطة</option>

                                </select>
                            </div>







                        </div>
                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">القسم </label>
                                <select name="Section" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" required>
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد القسم</option>
                                    @foreach ($sections as $sections)
                                        <option value="{{ $sections->id }}"> {{ $sections->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">عدد الخلطات</label>
                                <input type="number" class="form-control" id="count" name="count" required>
                                <input type="button" id='btnm' value="موافق">
                            </div>


                        </div>

                        <div class="row" id="ro">

                        </div>

                        {{-- 2 --}}

                        {{-- <div class="card-body">
                            <h3>تفاصيل الخلطة</h3>
                            <br><br>
                            <div class="table-responsive">

                                    <table id="table" class="table key-buttons text-md-nowrap"  name='table'>

                                    </table>
                                    <br>
                                    <h3>الخلطة بعد عملية الضرب</h3>
                                    <table id="table1" class="table key-buttons text-md-nowrap"  name='table1'>

                                    </table>



                            </div>
                        </div> --}}

                        </div>

                        <div class="d-flex justify-content-center">
                            <button id="btn"   type="submit" class="btn btn-primary">حفظ البيانات</button>
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
                        $('select[name="Mix"]').append('<option disabled selected  value="">تحديد الخلطة</option>');
                        $.each(data, function(key, value) {

                            $('select[name="Mix"]').append('<option value="' +
                            value.id  + '">' + value.mix_name + '</option>');
                            console.log(value)
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
        $('select[name="Mix"]').on('change', function() {
            var MixId = $(this).val();
            if (MixId) {
                $.ajax({
                    url: "/getmix/" + MixId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        $('#table').empty();

                        $.each(data, function(key, value) {

                                let tr =' <td>' + value.product_id + '</td> '
                                let td =' <td>' + value.amount + '</td> '

                            $('#table').append(tr);

                            $('#table').append(td);

                        });
                        $('#table1').empty();

                         function keyPressed(e){
                            var key = e.key;
                            document.getElementById("result").textContent = key;
                            };

                        $.each(data, function(key, value) {

                            $('#btnm').on('click', function name() {

                                let amount = $('#count').val() * value.amount
                                let pro_id = value.product_id

                                  //  var newIn = "<li id='li'>"+ amount+"</li> ";
                                    var newIn = "<input hidden  name='amount[]' value='" + amount + "'> ";
                                    var newId = "<input hidden  name='pro_id[]' value='" + pro_id + "'> ";

                                    $("#ro").append(newId)
                                    $("#ro").append(newIn)

                                    console.log(pro_id)
                                    console.log(amount)

                                    let td =' <td>' +  amount + '</td> '
                                    let tr =' <td>' + pro_id + '</td> '


                                $('#table1').append(tr);
                                $('#table1').append(td);
                                $('#btnm').hide()



                            }  )

                        });

                    },
                });


            } else {
                console.log('AJAX load did not work');
            }
        });

    });

</script>



@endsection
