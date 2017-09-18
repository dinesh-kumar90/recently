@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Orders List</div>

                <div class="panel-body">
                    @if(Session::has('flash_suceess_message'))
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                            {{ Session::get('flash_suceess_message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(!empty($orders))
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Order Date</th>
                            <th>Order Number</th>
                            <th>Contact Name</th>
                            <th>Address</th>
                            <th>Total Price</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                          <tr>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->ship_to_contact_name }}</td>
                            <td>{{ $order->ship_to_street_1 }}, {{ $order->ship_to_city }}, {{ $order->ship_to_state }}, {{ $order->ship_to_country }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>
                            <a href="{{ route('orders.show', ['id' => $order->order_id]) }}" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="View Order"><i class="fa fa-eye"></i></a>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                    {{ $orders->links() }}
                    @else
                    <p class="alert alert-info">No Orders</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.shopify.com/s/assets/external/app.js"></script>
  <script type="text/javascript">
    ShopifyApp.init({
      apiKey: '{{ $api_key }}',
      shopOrigin: 'https://{{ $storeDetail->shop }}'
    });
  </script>
@endsection
