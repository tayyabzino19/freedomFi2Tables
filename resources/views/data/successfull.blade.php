@extends('layouts.master')
@section('title', 'Successfull')
@section('content')

    <div class="container">
        <div class="row mb-6">
            <div class="col-lg-12">
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

                    <li class="breadcrumb-item">
                        <a href=""><i class="fa fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Successfull</span>
                    </li>

                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom gutter-b">

                    <div class="card card-custom gutter-b">
                        <div class="card card-custom gutter-b">
                            <div class="card-header flex-wrap border-0 pt-6 pb-0">


                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">
                                                    To
                                                </label>
                                                <input type="text" class="form-control" id="min" name="min">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">
                                                    From
                                                </label>
                                                <input type="text" class="form-control" id="max" name="max">
                                            </div>
                                        </div>

                                        <div class="col-lg-4" style="padding-top:24px;">
                                            <button type="button" class="btn btn-danger  "
                                                style="display:none;border-radius: 0" id="button" name="max"
                                                onclick="location.reload()"> Reset</button>
                                        </div>
                                    </div>

                                    <hr>


                                    <!--begin: Datatable-->
                                    <table class="table table-separate table-head-custom table-checkable" id="order_table">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Reservation Id</th>
                                                <th>Entry Id</th>
                                                <th>Product</th>
                                                <th>SHOPIFY ORDER ID</th>
                                                <th>Created At</th>
                                                <th>Action</th>

                                            </tr>
                                        <tbody>
                                            @foreach ($successfulls as $successfull)

                                                <tr>
                                                    <td> {{ $successfull->id }} </td>
                                                    <td> {{ $successfull->first_name }} </td>
                                                    <td> {{ $successfull->last_name }} </td>
                                                    <td> {{ $successfull->email }} </td>
                                                    <td> {{ $successfull->reservation_id }} </td>
                                                    <td> {{ $successfull->entry_id }} </td>
                                                    <td> {{ $successfull->products }} </td>
                                                    <td> @if ($successfull->status == 1) <i class="flaticon2-checkmark text-success" style="font-size:12px;"></i> @endif{{ $successfull->shopify_order_id }} </td>
                                                    <td> {{ $successfull->created_at }} </td>
                                                    <td class="text-center"> <i class="flaticon2-pen editcategory"
                                                            data-toggle="modal" style="cursor: pointer"
                                                            data-target="#editCategory" data-id="{{ $successfull->id }}"
                                                            data-status="{{ $successfull->status }}"
                                                            data-orderid="{{ $successfull->shopify_order_id }}"></i>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        </thead>
                                    </table>
                                    <!--end: Datatable-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <form method="post" action="{{ route('updateId') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Shopify Order Id </label>
                                    <input type="hidden" name="id" id="editid">
                                    <input type="text" class="form-control form-control-solid" name="orderId" id="orderId">
                                </div>


                                <div class="card-toolbar">
                                    <input type="hidden" name="status" value="0">
                                    <span class="switch switch-icon">
                                        <span class="font-weight-bold">Status &nbsp; &nbsp;</span> <label
                                            class="ml-2">

                                            <input type="checkbox" name="status" value="1" id="statuss">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary font-weight-bold">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    @endsection

    @section('page_js')

        <script>
            $(document).ready(function() {
                var table = $('#order_table').DataTable({
                    dom: 'lBfrtip',
                    //dom: 'Bfrtip',
                    buttons: [
                        'excelHtml5',
                        'csvHtml5',
                    ],
                });

                var minDate, maxDate;
                // Custom filtering function which will search data in column four between two values
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var min = minDate.val();
                        var max = maxDate.val();
                        var date = new Date(data[8]);

                        if (
                            (min === null && max === null) ||
                            (min === null && date <= max) ||
                            (min <= date && max === null) ||
                            (min <= date && date <= max)
                        ) {
                            $('#button').show();
                            return true;
                        }
                        $('#button').show();
                        return false;
                    }
                );

                minDate = new DateTime($('#min'), {
                    format: 'YYYY-MM-DD'
                });
                maxDate = new DateTime($('#max'), {
                    format: 'YYYY-MM-DD'
                });

                $('#min, #max').on('change', function() {
                    table.draw();
                });

            });



            $(document).on("click", ".editcategory", function() {

                var id = $(this).data('id');
                var orderid = $(this).data('orderid');
                var status = $(this).data('status');
                $('#editid').val(id);
                $('#orderId').val(orderid);

                if (status == null || status == 0 || status == '') {
                    $('#statuss').prop('checked', false);
                } else {
                    $('#statuss').prop('checked', true);
                }

            });
        </script>

        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/date-1.1.1/datatables.min.js"></script>


        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>

        <script>




        </script>
    @endsection

    @section('page_head')
        <style>
            .dt-button,
            .buttons-excel,
            .buttons-html5 {
                border: 1px solid #eee !important;
                margin-left: 13px !important;
                display: inline-block !important;
                padding: 6px 16px !important;
                color: #000;
                background-color: #eee;
            }

        </style>

    @endsection
