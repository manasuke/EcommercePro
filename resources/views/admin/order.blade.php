<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .input_color {
            color: black;
            padding-bottom: 10px;
        }

        .center {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;
        }

        .title_deg {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
        }

        .table_deg {
            border: 2px solid white;
            width: 100%;
            margin: auto;
            text-align: center;
        }

        .th_deg {
            background-color: skyblue;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="div_center">
                    <h2 class="h2_font">All Orders</h2>

                    <table class="table_deg">
                        <tr>
                            <th class="th_deg">Name</th>
                            <th class="th_deg">Email</th>
                            <th class="th_deg">Address</th>
                            <th class="th_deg">Phone</th>
                            <th class="th_deg">Product Title</th>
                            <th class="th_deg">Quantity</th>
                            <th class="th_deg">Price</th>
                            <th class="th_deg">Payment Status</th>
                            <th class="th_deg">Delivery Status</th>
                            <th class="th_deg">Image</th>
                            <th class="th_deg">Delivered</th>
                            <th class="th_deg">Print PDF</th>
                        </tr>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->product_title }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->delivery_status }}</td>
                                <td> <img height="100" width="100" src="product/{{ $order->image }}"
                                        alt=""></td>
                                <td>
                                    @if ($order->delivery_status == 'processing')
                                        <a class="btn btn-primary" onclick="return confirm('Are you sure?')"
                                            href="{{ url('delivered', $order) }}">Delivered</a>
                                    @else
                                        <p style="color: green">Delivered</p>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-secondary" href="{{ url('print_pdf', $order) }}">Print PDF</a>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>

        <!-- page-body-wrapper ends -->
    </div>
    @include('admin.script')
</body>

</html>
