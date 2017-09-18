@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12 col-md-offset-0">

        <div class="page-header">
          <div class="container-fluid">
            <div class="pull-right">
              <a href="{{ route('orders.index') }}" class="btn btn-info" role="button">Go Back</a>
            </div>
            <h1>Shopify Order Info</h1>
          </div>
        </div>
        @if(!empty($order))
        <ul class="nav nav-pills nav-stacked col-md-2">
          <li class="active"><a href="#tab_a" data-toggle="pill">Order Details</a></li>
          <li class=""><a href="#tab_b" data-toggle="pill">Billing Details</a></li>
          <li class=""><a href="#tab_c" data-toggle="pill">Shipping Details</a></li>
          <li class=""><a href="#tab_d" data-toggle="pill">Products</a></li>
        </ul>
        <div class="tab-content col-md-10">
                <div class="tab-pane active" id="tab_a">
                  <h4>Basic Order Info</h4>
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td class="little">Order ID:</td>
                        <td>{{ $order->order_id }}</td>
                      </tr>
                      <tr>
                        <td class="little">Order Number:</td>
                        <td>{{ $order->order_number }}</td>
                      </tr>
                      <tr>
                        <td class="little">Store URL:</td>
                        <td>{{ $storeDetail->shop }}</td>
                      </tr>
                      
                      <tr>
                        <td class="little">Order Date:</td>
                        <td>{{ $order->order_date }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane" id="tab_b">
                    <h4>Payment Details will goes here</h4>
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td class="little">Payment Method:</td>
                          <td>{{ $order->payment_method }}</td>
                        </tr>
                        <tr>
                          <td class="little">Contact Name:</td>
                          <td>{{ $order->bill_to_contact_name }}</td>
                        </tr>
                        <tr>
                          <td class="little">Phone:</td>
                          <td>{{ $order->bill_to_phone }}</td>
                        </tr>
                        <tr>
                          <td class="little">Company:</td>
                          <td>{{ $order->bill_to_company }}</td>
                        </tr>
                        <tr>
                          <td class="little">Street 1:</td>
                          <td>{{ $order->bill_to_street_1 }}</td>
                        </tr>
                        <tr>
                          <td class="little">Street 2:</td>
                          <td>{{ $order->bill_to_street_2 }}</td>
                        </tr>
                        <tr>
                          <td class="little">City:</td>
                          <td>{{ $order->bill_to_city }}</td>
                        </tr>
                        <tr>
                          <td class="little">State:</td>
                          <td>{{ $order->bill_to_state }}</td>
                        </tr>
                        <tr>
                          <td class="little">Zip:</td>
                          <td>{{ $order->bill_to_zip }}</td>
                        </tr>                      
                        <tr>
                          <td class="little">Country:</td>
                          <td>{{ $order->bill_to_country }}</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="tab_c">
                    <h4>Shipping Details</h4>
                     <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td class="little">Shipping Service:</td>
                            <td>{{ $order->shipping_service }}</td>
                          </tr>
                          <tr>
                            <td class="little">Ship to contact name:</td>
                            <td>{{ $order->ship_to_contact_name }}</td>
                          </tr>
                          <tr>
                            <td class="little">Ship to Email1:</td>
                            <td>{{ $order->ship_to_Email1 }}</td>
                          </tr>
                          <tr>
                            <td class="little">Ship to Phone Numer:</td>
                            <td>{{ $order->ship_to_phone }}</td>
                          </tr>
                          <tr>
                            <td class="little">Ship to Company:</td>
                            <td>{{ $order->ship_to_company }}</td>
                          </tr>
                          <tr>
                            <td class="little">Ship to Street 1:</td>
                            <td>{{ $order->ship_to_street_1 }}</td>
                          </tr>
                          <tr>
                            <td class="little">Ship to Street 2:</td>
                            <td>{{ $order->ship_to_street_2 }}</td>
                          </tr>
                          <tr>
                            <td class="little">Ship to City:</td>
                            <td>{{ $order->ship_to_city }}</td>
                          </tr>
                          <tr>
                            <td class="little">Ship to State:</td>
                            <td>{{ $order->ship_to_state }}</td>
                          </tr>
                          <tr>
                            <td class="little">Ship to Zip:</td>
                            <td>{{ $order->ship_to_zip }}</td>
                          </tr>
                          <tr>
                            <td class="little">Ship to Country:</td>
                            <td>{{ $order->ship_to_country }}</td>
                          </tr>
                          
                       </tbody>
                     </table>

                </div>
                <div class="tab-pane" id="tab_d">
                  <h4>Order Products info</h4>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="left">Item Title</th>
                        <th class="right">Quantity</th>
                        <th class="right">Unit Price</th>
                        <th class="right">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($order->items as $item)
                      <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->price * $item->quantity }}</td>
                      </tr>
                    @endforeach                    
                    </tbody>
                    <tbody id="totals">
                      <tr>
                        <td colspan="3" class="text-right">Sub-Total:</td>
                        <td class="right">{{ $order->subtotal_price }}</td>
                      </tr>
                    </tbody>
                    <tbody id="totals">
                      <tr>
                        <td colspan="3" class="text-right">Shipping:</td>
                        <td class="right">{{ $order->shipping_price }}</td>
                      </tr>
                    </tbody>
                    <tbody id="totals">
                      <tr>
                        <td colspan="3" class="text-right">Tax:</td>
                        <td class="right">{{ $order->total_tax }}</td>
                      </tr>
                    </tbody>
                    <tbody id="totals">
                      <tr>
                        <td colspan="3" class="text-right">Total:</td>
                        <td class="right">{{ $order->total_price }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
        </div><!-- tab content -->
        @endif
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
