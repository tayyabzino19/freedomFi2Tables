@extends('layouts.master')
@section('title', 'Forwarder')
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
                        <span class="text-muted">Forwarders</span>
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
                                                <th>Created At</th>
                                            </tr>
                                        <tbody>
                                            @foreach ($forwarders as $forwarder)

                                                <tr>
                                                    <td> {{ $forwarder->id }} </td>
                                                    <td> {{ $forwarder->first_name }} </td>
                                                    <td> {{ $forwarder->last_name }} </td>
                                                    <td> {{ $forwarder->email }} </td>
                                                    <td> {{ $forwarder->reservation_id }} </td>
                                                    <td> {{ $forwarder->entry_id }} </td>
                                                    <td> {{ $forwarder->products }} </td>
                                                    <td> {{ $forwarder->created_at }} </td>

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
