@extends('layouts.master')
@section('title')
   التصنيع
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ التصنيع</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('archive_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم أرشفة الفاتورة بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif

    @if (session()->has('delete_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف الفاتورة بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif

    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a href="Manufacturings/create">&nbsp; تصنيع خلطة</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                                <thead>
                                    <tr>

                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">اسم الخلطة</th>
                                        @can('حذف الفاتورة')

                                        <th class="border-bottom-0"> تفاصيل الخلطة</th>


                                        @endcan
                                        <th class="border-bottom-0">عدد الخلطات</th>
                                        <th class="border-bottom-0">اسم القسم</th>
                                        <th class="border-bottom-0">المجموع </th>
                                        <th class="border-bottom-0">العمليات </th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $i = 1
                                    @endphp
                                    @foreach ($invoice_nums as $item)
                                    <tr>
                                            <td>  {{$i++}}</td>
                                            <td>{{$item->mix->mix_name}}</td>
                                            @can('حذف الفاتورة')
                                            <td ><a href="{{ url('manufacturingDetails') }}/{{ $item->id }}">تفاصيل الخلطة</a></td>
                                            @endcan
                                            <td>{{$item->manufacturing->max('count')}}</td>
                                            <td>{{$item->section->section_name}}</td>
                                            <td>{{$item->manufacturing->sum('amount')}}</td>
                                            <td>

                                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                    data-id="{{ $item->manufacturing->max('id') }}"
                                                    data-section_name="{{ $item->section->section_name }}"
                                                    data-count="{{ $item->manufacturing->max('count') }}"
                                                    data-amount="{{ $item->manufacturing->sum('amount') }}"
                                                    data-mix_name="{{ $item->mix->id }}"
                                                    data-toggle="modal"
                                                    href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>



                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-id="{{ $item->id }}" data-section_name="{{ $item->section->section_name }}"
                                                    data-toggle="modal" href="#modaldemo9" title="حذف"><i
                                                        class="las la-trash"></i></a>

                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                             </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>

      <!-- edit -->
      <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">

                  <form action="Manufacturings/update" method="post" autocomplete="off">
                      {{ method_field('patch') }}
                      {{ csrf_field() }}
                      <div class="form-group">
                          <input type="hidden" name="id" id="id" value="">
                          <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                          <input class="form-control" name="section_name" id="section_name" type="text">
                      </div>

                      <div class="form-group">
                        <label for="inputName" class="control-label">عدد الخلطات</label>
                        <input type="number" class="form-control" id="count" name="count" required>
                        <input type="hidden" class="form-control" id="mix_name" name="mix_name" required>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="control-label">الكمية </label>
                        <input type="text" class="form-control" id="amount" name="amount" style="color: red" required>
                      </div>

              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">تاكيد</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
              </div>
              </form>
          </div>
      </div>
  </div>

  <!-- delete -->
  <div class="modal" id="modaldemo9">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content modal-content-demo">
              <div class="modal-header">
                  <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                      type="button"><span aria-hidden="true">&times;</span></button>
              </div>
              <form action="Manufacturings/destroy" method="post">
                  {{ method_field('delete') }}
                  {{ csrf_field() }}
                  <div class="modal-body">
                      <p>هل انت متاكد من عملية الحذف ؟</p><br>
                      <input type="hidden" name="id" id="id" value="">
                      <input class="form-control" name="section_name" id="section_name" type="text" readonly>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                      <button type="submit" class="btn btn-danger">تاكيد</button>
                  </div>
          </div>
          </form>
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
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
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
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
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
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var mix_name = button.data('mix_name')
        var section_name = button.data('section_name')
        var count = button.data('count')
        var amount = button.data('amount')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #mix_name').val(mix_name);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #count').val(count);
        modal.find('.modal-body #amount').val(amount)
        modal.find('.modal-body #amount').val(amount);








        // modal.find('.modal-body #mix_name').val(mix_name);
    })

</script>

<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var count = button.data('count')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #count').val(count);
    })

</script>

@endsection
