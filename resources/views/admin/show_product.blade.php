<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style type="text/css">
        .center {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;
        }

        .font_size {
            font-size: 40px;
            padding-bottom: 20px;
        }

        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .text_color {
            color: black;

        }

        label {
            display: inline-block;
            width: 200px;
        }

        .div_design {
            padding-bottom: 5px;
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
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="div_center">
                        <h2 class="font_size">All Products</h2>
                        <table class="center">
                            <tr class="th_color">
                                <th class="th_deg">Product Title</th>
                                <th class="th_deg">Product Description</th>
                                <th class="th_deg">Product Quantity</th>
                                <th class="th_deg">Category Name</th>
                                <th class="th_deg">Product Price</th>
                                <th class="th_deg">Discount Price</th>
                                <th class="th_deg">Product Image</th>
                                <th class="th_deg">Action</th>
                            </tr>

                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->category }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->discount }}</td>
                                    <td>
                                        <img height="100" width="100" src="product/{{ $product->image }}"
                                            alt="">
                                    </td>
                                    <td>
                                        <a class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this product?')"
                                            href="{{ url('delete_product', $product) }}">Delete</a>
                                        <a class="btn btn-primary" href="{{ url('update_product', $product) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>


                </div>
            </div>
            <!-- main-panel ends -->
        </div>

        <!-- page-body-wrapper ends -->
    </div>
    @include('admin.script')
</body>

</html>
