@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@section('title')
    الاقسام
@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الأقسام</h4><span class="text-muted mt-1 tx-20 mr-2 mb-0">/

            {{$sections->section_name}}
            </span>
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

@if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('edit') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<!-- row -->

    <div class="row">


<div class="col-xl-12">
<!-- div -->
<div class="card mg-b-20" id="tabs-style3">
<div class="card-body">
    <div class="main-content-label mg-b-5">

    </div>
    <div class="text-wrap">
        <div class="example">
            <div class="panel panel-primary tabs-style-3">
                <div class="tab-menu-heading">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class=""><a href="#tab1" class="active" data-toggle="tab"><i class="fa fa-laptop"></i> الصادر</a></li>
                            <li><a href="#tab2" data-toggle="tab"><i class="fa fa-cube"></i> الوارد </a></li>
                            <li><a href="#tab3" data-toggle="tab"><i class="fa fa-cogs"></i> التصنيع </a></li>
                            <li><a href="#tab4" data-toggle="tab"><i class="fa fa-tasks"></i> الانتاج </a></li>
                            <li><a href="#tab5" data-toggle="tab"><i class="fa fa-tasks"></i> المصاريف </a></li>
                            <li><a href="#tab6" data-toggle="tab"><i class="fa fa-tasks"></i> المبيعات </a></li>
                            <li><a href="#tab7" data-toggle="tab"><i class="fa fa-tasks"></i> المستودع </a></li>
                            <li><a href="#tab8" data-toggle="tab"><i class="fa fa-tasks"></i> دليل الخلطات </a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                                <thead>
                                    <tr class="text-dark">

                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">تاريخ القاتورة</th>
                                        <th class="border-bottom-0">المادة</th>
                                        <th class="border-bottom-0">الكمية</th>
                                        <th class="border-bottom-0">السعر</th>
                                        <th class="border-bottom-0">المستلم</th>
                                        <th class="border-bottom-0">ملاحظات</th>
                                    </tr>
                                </thead>
                                    @php
                                        $i = 1
                                    @endphp

                                        <tbody>
                                            @foreach ($outgoings as $item )
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$item->out_Date}}</td>
                                                <td>{{$item->products->Product_name}}</td>
                                                <td>{{$item->amount}}</td>
                                                <td>{{$item->price}}</td>
                                                <td>{{$item->received}}</td>
                                                <td>{{$item->note}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                            </table>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                                <thead>
                                    <tr class="text-dark">
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">تاريخ القاتورة</th>
                                        <th class="border-bottom-0">المادة</th>
                                        <th class="border-bottom-0">الكمية</th>
                                        <th class="border-bottom-0">السعر</th>
                                        <th class="border-bottom-0">المصدر</th>
                                        <th class="border-bottom-0">ملاحظات</th>

                                    </tr>
                                </thead>
                                         @php
                                         $i = 1
                                        @endphp
                                    @foreach ($incomings as $item )
                                        <tbody>
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$item->out_Date}}</td>
                                                <td>{{$item->products->Product_name }}</td>
                                                <td>{{$item->amount}}</td>
                                                <td>{{$item->price}}</td>
                                                <td>{{$item->source}}</td>
                                                <td>{{$item->note}}</td>
                                            </tr>

                                        </tbody>
                                @endforeach
                            </table>
                        </div>
                        <div class="tab-pane" id="tab3">

                            <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                                <thead>
                                    <tr>

                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">رقم الخلطة</th>
                                        <th class="border-bottom-0"> تفاصيل الخلطة</th>
                                        <th class="border-bottom-0">عدد الخلطات</th>
                                        <th class="border-bottom-0">اسم القسم</th>
                                        <th class="border-bottom-0">المجموع </th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $i = 1
                                    @endphp
                                    @foreach ($invoice_nums as $item)
                                    <tr>
                                            <td>  {{$i++}}</td>
                                            <td>{{$item->manufacturing->max('mix_id')}}</td>
                                            <td ><a href="{{ url('manufacturingDetails') }}/{{ $item->id }}">تفاصيل الخلطة</a></td>
                                            <td>{{$item->manufacturing->max('count')}}</td>
                                            <td>{{$item->section->section_name}}</td>
                                            <td>{{$item->manufacturing->sum('amount')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                             </table>
                        </div>

                        {{--  --}}
                        <div class="tab-pane" id="tab4">
                            <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">القسم</th>
                                        <th class="border-bottom-0">تاريخ القاتورة</th>
                                        <th class="border-bottom-0">انتاج/صحن</th>
                                        @can('تعديل الفاتورة')
                                        <th class="border-bottom-0">انتاج/بيضة</th>

                                        @endcan

                                        <th class="border-bottom-0">كسر/صحن</th>
                                        <th class="border-bottom-0">كسر/بيضة</th>
                                        <th class="border-bottom-0">مجموع الانتاج/بيضة</th>
                                        <th class="border-bottom-0">نسبة الانتاج</th>
                                        <th class="border-bottom-0">المبيع/صحن</th>
                                        <th class="border-bottom-0">فرخة افتتاحي</th>
                                        <th class="border-bottom-0">النفوق/فرخة</th>
                                        <th class="border-bottom-0">فرخة صافي</th>
                                        <th class="border-bottom-0"> استهلاك الفرخة الواحدة من العلف</th>
                                        <th class="border-bottom-0">علف/كغ</th>
                                        <th class="border-bottom-0">سواد/متر</th>
                                        <th class="border-bottom-0">ملاحظات</th>
                                        <th class="border-bottom-0">العمليات</th>
                                    </tr>
                                </thead>
                                @php
                                    $i = 1
                                @endphp
                                <tbody>
                                    @foreach ($productions as $item)

                                    <tr>
                                     <td>{{$i++}}</td>
                                     <td>{{$item->section->section_name}}</td>
                                     <td>{{$item->pro_Date}}</td>
                                     <td>{{$item->production}}</td>
                                     @can('تعديل الفاتورة')
                                     <td>{{$item->production * 30}}</td>
                                     @endcan

                                     <td>{{$item->debris}}</td>
                                     <td>{{$item->debris * 30}}</td>
                                     <td>{{$item->debris* 30+$item->production * 30}}</td>
                                     <td>{{(($item->debris* 30+$item->production * 30) / $item->death_store) * 100 }}</td>
                                     <td>{{$item->sold}}</td>
                                     <td>{{$item->ch_store}}</td>
                                     <td>{{$item->death}}</td>
                                     <td>{{$item->death_store}}</td>
                                     <td>{{($item->feed / $item->death_store) * 1000}}</td>
                                     <td>{{$item->feed}}</td>
                                     <td>{{$item->Waste}}</td>
                                     <td>{{$item->note}}</td>

                                </tr>
                                @endforeach


                                </tbody>
                        </table>
                        </div>
                        {{--  --}}
                        <div class="tab-pane" id="tab5">
                            <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                                <thead>
                                    <tr class="text-dark">
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">رقم الفاتورة</th>
                                        <th class="border-bottom-0">القسم </th>
                                        <th class="border-bottom-0">التاريخ</th>
                                        <th class="border-bottom-0">المبلغ</th>
                                        <th class="border-bottom-0">البيان</th>

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
                                            <td>{{$item->note}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab6">
                            <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">رقم الفاتورة</th>
                                        <th class="border-bottom-0">القسم </th>
                                        <th class="border-bottom-0">التاريخ</th>
                                        <th class="border-bottom-0">الزبون</th>
                                        <th class="border-bottom-0">طبق</th>
                                        <th class="border-bottom-0">صندوق</th>
                                        <th class="border-bottom-0">الوزن</th>
                                        <th class="border-bottom-0">السعر</th>
                                        <th class="border-bottom-0">البيان</th>

                                    </tr>
                                </thead>
                                @php
                                    $i = 1
                                @endphp
                                <tbody>

                                    @foreach ($sells as $item)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$item->number}}</td>
                                            <td>{{$item->section->section_name}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->production}}</td>
                                            <td>{{$item->box}}</td>
                                            <td>{{$item->Weight}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->note}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="tab7">
                            <table class="table table-striped" style="text-align:center">
                                <thead>
                                    <tr class="text-dark">
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">المادة</th>
                                        <th class="border-bottom-0">الرصيد الافتتاحي</th>
                                        <th class="border-bottom-0">الوارد</th>
                                        <th class="border-bottom-0">الصادر</th>
                                        <th class="border-bottom-0">التصنيع</th>
                                        <th class="border-bottom-0">المجموع</th>

                                    </tr>
                                </thead>
                                @php
                                        $i = 1
                                    @endphp
                                    @foreach ($products as $item )
                                <tbody>
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->Product_name}}</td>
                                        <td>{{$item->product_amount}}</td>
                                        <td>{{$item->incoming->sum('amount')}}</td>
                                        <td>{{$item->outgoing->sum('amount')}}</td>
                                        <td>{{$item->manufacturing->sum('amount')}}</td>
                                        <td>{{$item->product_amount + ($item->incoming->sum('amount') - $item->outgoing->sum('amount') - $item->manufacturing->sum('amount')) }}</td>


                                    </tr>




                                </tbody>
                                @endforeach
                            </table>
                        </div>

                        <div class="tab-pane" id="tab8">
                            <table class="table table-striped" style="text-align:center">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">#</th>
                                        <th class="border-bottom-0">رقم الخلطة</th>
                                        <th class="border-bottom-0">اسم القسم</th>
                                        <th class="border-bottom-0">الوصف</th>
                                        <th class="border-bottom-0">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($mixes as $x)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td><a
                                                href="{{ url('mixDetails') }}/{{ $x->id }}">{{ $x->mix_name }}</a>
                                        </td>
                                        <td>{{ $x->section->section_name }}</td>
                                        <td>{{ $x->description }}</td>
                                            <td>

                                                    <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                        data-id="{{ $x->id }}" data-mix_name="{{ $x->mix_name }}"
                                                        data-description="{{ $x->description }}" data-toggle="modal"
                                                        href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>



                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                        data-id="{{ $x->id }}" data-mix_name="{{ $x->mix_name }}"
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
        </div>

<!---Prism Pre code-->




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
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>


@endsection
