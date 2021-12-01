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
                        <span   class="text-muted">Forwarders</span>
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
                                    <table class="table table-bordered table-hover table-checkable  "
                                        style="margin-top: 13px !important" id="mytable">
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
                                        </thead>

                                        <tbody>
                                            @foreach ($successfulls as  $successfull)

                                            <tr>
                                                <td>  {{ $successfull->id}}        </td>
                                                <td> {{ $successfull->first_name}} </td>
                                                <td> {{ $successfull->last_name}}  </td>
                                                <td> {{ $successfull->email}}       </td>
                                                <td>  {{ $successfull->reservation_id}} </td>
                                                <td>  {{ $successfull->entry_id}} </td>
                                                <td> {{ $successfull->products}} </td>
                                                <td>  @if($successfull->status == 1) <i class="flaticon2-checkmark text-success" style="font-size:12px;"></i> @endif{{ $successfull->shopify_order_id}} </td>
                                                <td>  {{ $successfull->created_at}} </td>
                                                <td class="text-center"> <i class="flaticon2-pen editcategory"
                                                    data-toggle="modal"
                                                    style="cursor: pointer"
                                                    data-target="#editCategory"
                                                    data-id="{{ $successfull->id }}"
                                                    data-status="{{ $successfull->status }}"
                                                    data-orderid="{{ $successfull->shopify_order_id }}"></i> </td>
                                            </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
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

            <form method="post" action="{{ route('updateId')}}" enctype="multipart/form-data">
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

                                    <input type="checkbox"  name="status" value="1" id="statuss">
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


@section('page_head')

@endsection
@section('page_js')

<script>
    $(document).ready(function() {
        $('#mytable').DataTable();
    });
</script>

<script src="{{ asset('design/assets/js/pages/crud/datatables/basic/basic.js') }}"></script>
<script src="{{ asset('design/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>


<script>


$(document).on("click", ".editcategory", function() {

var id = $(this).data('id');
var orderid = $(this).data('orderid');
var status = $(this).data('status');

$('#editid').val(id);
$('#orderId').val(orderid);

if(status !=''){
   $('#statuss').prop('checked', true);

}else{
    $('#statuss').prop('checked', false);
}

});



</script>


@endsection
