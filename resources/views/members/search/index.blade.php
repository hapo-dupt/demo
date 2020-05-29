@extends('layouts.index')

@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('search') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control select2" style="width: 100%;" name="filter">
                                            <option value="null" selected="selected">Select filter options</option>
                                            <option value="1">Search for project</option>
                                            <option value="2">Search for task</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6" id="textInput">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="keyword" placeholder="Enter any key word to search">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success">Search</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
