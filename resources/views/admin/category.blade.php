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
        }

        .center {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;
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
                    <h2 class="h2_font">Add Category</h2>
                    <form action="{{ url('add_category') }}" method="POST">
                        @csrf
                        <input class="input_color" type="text" name="category" placeholder="Write a category name">
                        <input type="submit" class="btn btn-primary" value="Add Category">
                    </form>

                    <table class="center">
                        <tr>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->category_name }}</td>
                                <td><a onclick="return confirm('Are you sure?')"
                                        href="{{ url('delete_category', $category) }}" class="btn btn-danger">Delete</a>
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
