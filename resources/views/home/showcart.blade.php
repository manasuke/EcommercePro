<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
    <style type="text/css">
        table,
        th,
        td {
            border: 1px solid black;
        }

        .th_color {
            background-color: skyblue;

        }

        .th_deg {
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; width: 50% padding: 30px">
            <table>
                <tr class="th_color">
                    <th class="th_deg">Product Name</th>
                    <th class="th_deg">Quantity</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Action</th>
                </tr>

                <?php $totalPrice = 0; ?>

                @foreach ($carts as $cart)
                    <tr>
                        <td class="th_deg">{{ $cart->product_title }}</td>
                        <td class="th_deg">{{ $cart->quantity }}</td>
                        <td class="th_deg">{{ $cart->price }}</td>
                        <td class="th_deg">
                            <img height="100" width="100" src="product/{{ $cart->image }}" alt="">
                        </td>
                        <td class="th_deg">
                            <a class="btn btn-danger" href="{{ url('remove_cart', $cart) }}"
                                onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </td>
                    </tr>
                    <?php $totalPrice += $cart->price; ?>
                @endforeach
            </table>
            <div>Total price: {{ $totalPrice }}</div>
        </div>
        <div style="margin: auto;">
            <h3>Process Order</h3>
            <a href="{{ url('cash_order') }}" class="btn btn-danger">Cash On Delivery</a>
            <a href="{{ url('stripe', $totalPrice) }}" class="btn btn-danger">Pay Using Card</a>
        </div>
    </div>
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
    </div>
    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>
