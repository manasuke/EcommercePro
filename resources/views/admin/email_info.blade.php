<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
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

        label {
            display: inline;
            width: 200px;
        }

        input {
            margin-top: 10px;
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
                    <h2 class="h2_font">Send Email To</h2>

                    <form action="{{ url('send_user_email', $order) }}" method="POST">
                        @csrf
                        <div>
                            <label for="">Email Greeting:</label>
                            <input type="text" name="greeting">
                        </div>
                        <div>
                            <label for="">Email Firstline:</label>
                            <input type="text" name="firstline">
                        </div>
                        <div>
                            <label for="">Email Body:</label>
                            <input type="text" name="body">
                        </div>

                        <div>
                            <label for="">Email Button Name:</label>
                            <input type="text" name="button">
                        </div>
                        <div>
                            <label for="">Email Url:</label>
                            <input type="text" name="url">
                        </div>
                        <div>
                            <label for="">Email Lastline:</label>
                            <input type="text" name="lastline">
                        </div>
                        <input type="submit" name="sendmail" value="Send Mail" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>

        <!-- page-body-wrapper ends -->
    </div>
    @include('admin.script')
</body>

</html>
