<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style type="text/css">
        .font_size {
            font-size: 40px;
            padding-bottom: 40px;
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
                        <h1 class="font_size">Add Products</h1>
                        <form action="{{ url('add_product') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="div_design">
                                <label>Product Title :</label>
                                <input type="text" class="text_color" name="title" placeholder="Write a title"
                                    required="">
                            </div>
                            <div class="div_design">
                                <label>Product Description :</label>
                                <input type="text" class="text_color" name="description"
                                    placeholder="Write a Description" required="">
                            </div>
                            <div class="div_design">
                                <label>Product Price :</label>
                                <input type="text" class="text_color" name="price" placeholder="Write a Price"
                                    required="">
                            </div>
                            <div class="div_design">
                                <label>Discount Price :</label>
                                <input type="text" class="text_color" name="discount" placeholder="Write a Discount">
                            </div>
                            <div class="div_design">
                                <label>Product Quantity :</label>
                                <input type="text" class="text_color" name="quantity"
                                    placeholder="Write a Description" required="">
                            </div>
                            <div class="div_design">
                                <label>Product Category :</label>
                                <select name="category" class="text_color" required="">
                                    <option value="" disabled selected>Select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="div_design">
                                <label>Product Image :</label>
                                <input type="file" name="image" required="">
                            </div>
                            <div>
                                <input type="submit" value="Add Product" class="btn btn-primary">
                            </div>
                        </form>
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
