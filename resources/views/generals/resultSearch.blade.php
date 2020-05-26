@extends('layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('search') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control select2" style="width: 100%;" name="filter">
                                            <option value="" selected="selected">Select filter options</option>
                                            <option value="1" @if($oldData->filter == 1) selected @endif>Search for project</option>
                                            <option value="2" @if($oldData->filter == 2) selected @endif>Search for task</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6" id="textInput">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="keyword" value="{{ $oldData->keyword }}" placeholder="Enter any key word to search">
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
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <h1>Result of Searching: "{{ $oldData->keyword }}"</h1>
                        </div>
                        <div class="col-sm-4">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Result of Searching</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                        <!-- Box Comment -->
                        <div class="card card-widget">
                            <div class="card-header">
                                <!-- /.user-block -->
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            @foreach($data as $value)
                                <div class="card-body">
                                    <!-- Attachment -->
                                    <div class="attachment-block clearfix">
                                        <div class="attachment">
                                            <h4>{{ $value->title }}</h4>

                                            <div class="description">
                                                {{ $value->description }}
                                            </div>
                                            <!-- /.attachment-text -->
                                        </div>
                                        <!-- /.attachment-pushed -->
                                    </div>
                                    <!-- /.attachment-block -->

                                    <!-- Social sharing buttons -->
                                    <a type="button" class="btn btn-primary text-white" href="{{ route('redirectSearch', $value->id) }}">
                                        View more
                                    </a>
                                    <span class="float-right">Searching for: <text class="text-success">{{ $searchFor }}</text></span>
                                </div>
                            @endforeach
                            <div class="text-center">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        {{ $data->links() }}
                                    </ul>
                                </nav>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $("div.description").text(function(index, currentText) {
            return currentText.substr(0, 200) + "...";
        });
    </script>
@endsection
