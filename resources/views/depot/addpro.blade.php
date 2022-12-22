@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
    المنتجات
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    المنتجات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    @if (session()->has('Edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('Error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">

                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                                data-toggle="modal" href="#exampleModal">اضافة منتج</a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم القسم</th>
                                    <th class="border-bottom-0">فرخة افتتاحي</th>
                                    <th class="border-bottom-0">فرخة </th>
                                    <th class="border-bottom-0">بيض افتتاحي</th>
                                    <th class="border-bottom-0">بيض</th>
                                    <th class="border-bottom-0">علف افتتاحي</th>
                                    <th class="border-bottom-0">علف</th>
                                    <th class="border-bottom-0">سواد</th>
                                    <th class="border-bottom-0">العمليات</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($addproduction as $Product)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $Product->section->section_name }}</td>
                                        <td>{{ $Product->chAmount }}</td>
                                        <td>{{ $Product->amount }}</td>
                                        <td>{{ $Product->chproduction	 }}</td>
                                        <td>{{ $Product->production	 }}</td>
                                        <td>{{ $Product->chfeed	 }}</td>
                                        <td>{{ $Product->feed}}</td>
                                        <td>{{ $Product->Waste }}</td>
                                        <td>

                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-id="{{ $Product->id }}"
                                                data-section_name="{{ $Product->section->section_name }}"
                                                data-amount="{{ $Product->amount }}"
                                                data-production="{{ $Product->production }}"
                                                data-Waste="{{ $Product->Waste }}"
                                                data-feed="{{ $Product->feed }}"
                                                data-toggle="modal"
                                                href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>



                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $Product->id }}"
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

        <!-- add -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة منتج</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('addproduction.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">


                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                            <select name="section_id" id="section_id" class="form-control" required>
                                <option value="" selected disabled> --حدد القسم--</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">فرخة</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>

                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">بيض</label>
                            <input type="number" class="form-control" id="production" name="production" required>

                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">علف</label>
                            <input type="number" class="form-control" id="feed" name="feed" required>

                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">سواد</label>
                            <input type="number" class="form-control" id="Waste" name="Waste" required>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
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

              <form action="addproduction/update" method="post" autocomplete="off">
                  {{ method_field('patch') }}
                  {{ csrf_field() }}
                  <div class="form-group">
                      <input type="hidden" name="id" id="id" value=""><input type="hidden" name="id" id="id" value="">
                      <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                      <input class="form-control" name="section_name" id="section_name" type="text">
                  </div>

                  <div class="form-group">
                  <label class="my-1 mr-2" for="inlineFormCustomSelectPref">فرخة</label>
                  <input type="number" class="form-control" id="amount" name="amount" required>
                  </div>
                  <div class="form-group">
                  <label class="my-1 mr-2" for="inlineFormCustomSelectPref">بيض</label>
                  <input type="number" class="form-control" id="production" name="production" required>
                  </div>
                  <div class="form-group">
                  <label class="my-1 mr-2" for="inlineFormCustomSelectPref">علف</label>
                  <input type="number" class="form-control" id="feed" name="feed" required>
                  </div>
                  <div class="form-group">
                  <label class="my-1 mr-2" for="inlineFormCustomSelectPref">سواد</label>
                  <input type="number" class="form-control" id="Waste" name="Waste" required>
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
          <form action="sections/destroy" method="post">
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
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var amount = button.data('amount')
            var production = button.data('production')
            var Waste = button.data('Waste')
            var feed = button.data('feed')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #amount').val(amount);
            modal.find('.modal-body #production').val(production);
            modal.find('.modal-body #Waste').val(Waste);
            modal.find('.modal-body #feed').val(feed);
        })

    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var amount = button.data('amount')
            var production = button.data('production')
            var Waste = button.data('Waste')
            var feed = button.data('feed')
            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #amount').val(amount);
            modal.find('.modal-body #production').val(production);
            modal.find('.modal-body #Waste').val(Waste);
            modal.find('.modal-body #feed').val(feed);
        })

    </script>


@endsection
