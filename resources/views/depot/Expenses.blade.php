@extends('layouts.master')
@section('title')
المصاريف
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
                <h4 class="content-title mb-0 my-auto">التقارير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تقرير المصاريف</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('delete_Expenses'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف الفاتورة بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif


    @if (session()->has('Status_Update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث حالة الدفع بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif

    @if (session()->has('restore_Expenses'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم استعادة الفاتورة بنجاح",
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
                        <a href="Expenses/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة تقرير</a>


                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">الكود </th>
                                    <th class="border-bottom-0">القسم </th>
                                    <th class="border-bottom-0">التاريخ</th>
                                    <th class="border-bottom-0">المبلغ</th>
                                    <th class="border-bottom-0">العملة</th>
                                    <th class="border-bottom-0">البيان</th>
                                    <th class="border-bottom-0">اسم الصورة</th>
                                    <th class="border-bottom-0">عمليات المرفق</th>
                                    <th class="border-bottom-0">العمليات</th>

                                </tr>
                            </thead>
                            @php
                                $i = 1
                            @endphp
                            <tbody>

                                @foreach ($Expenses as $item)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->number}}</td>
                                        <td>{{$item->section->section_name}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->currency}}</td>
                                        <td>{{$item->note}}</td>
                                        <td>{{ $item->file_name }}</td>

                                        <td colspan="2">

                                            <a class="btn btn-outline-success btn-sm"
                                                href="{{ url('View_file') }}/{{ $item->number }}/{{ $item->file_name }}"
                                                role="button"><i class="fas fa-eye"></i>&nbsp;
                                                عرض</a>

                                            <a class="btn btn-outline-info btn-sm"
                                                href="{{ url('download') }}/{{ $item->number }}/{{ $item->file_name }}"
                                                role="button"><i
                                                    class="fas fa-download"></i>&nbsp;
                                                تحميل</a>

                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    @can('تعديل الفاتورة')
                                                        <a class="dropdown-item"
                                                            href=" {{ url('edit_Expenses') }}/{{ $item->id }}">تعديل
                                                            الفاتورة</a>
                                                    @endcan

                                                    @can('حذف الفاتورة')
                                            <a class="dropdown-item" href="#" data-Expenses_id="{{ $item->id }}"
                                                data-toggle="modal" data-target="#delete_Expenses"><i
                                                    class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                الفاتورة</a>
                                            @endcan

                                                </div>
                                            </div>

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


    <!-- حذف الفاتورة -->
    <div class="modal fade" id="delete_Expenses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('Expenses.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الحذف ؟
                    <input type="text" name="Expenses_id" id="Expenses_id" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
                </form>
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
        $('#delete_Expenses').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var Expenses_id = button.data('Expenses_id')
            var modal = $(this)
            modal.find('.modal-body #Expenses_id').val(Expenses_id);
        })

    </script>

    <script>
        $('#Transfer_Expenses').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var Expenses_id = button.data('Expenses_id')
            var modal = $(this)
            modal.find('.modal-body #Expenses_id').val(Expenses_id);
        })

    </script>







@endsection
