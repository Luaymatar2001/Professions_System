@extends('cms.parent')

@section('title')

@endsection

@section('title', 'Specialties')
@section('page-title', 'Index')
@section('small-title', 'Specialties Index')

@section('content')
@if (session()->has('status'))
@if (session('status'))
<script>
    $(document).ready(function() {
                  swal({
                    icon: "success",
                    text: "the restore process specialty is completed!"
                  })
                });
</script>
@else
<script>
    swal("Faild to restore specialty!", {
                  className: "red-bg",
                });
</script>
@endif
@endif
<section class="content">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">

                        </h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-bordered table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>description</th>
                                    <th>allow register </th>
                                    <th>specialties</th>
                                    <th>Create At</th>
                                    <th>Updated At</th>
                                    <th>Settings</th>

                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($professions as $professionals)
                                <tr>
                                    <td>{{ $professionals->id }}</td>
                                    <td>{{ $professionals->title }}</td>
                                    <td>{{ $professionals->description }}</td>
                                    <td>
                                        @if ($professionals->allow_register)
                                        <span class="badge bg-success"> {{ $professionals->Activity }} </span>
                                        @else
                                        <span class="badge bg-danger"> {{ $professionals->Activity }} </span>
                                        @endif
                                        </span>
                                    </td>

                                    <td>{{ $professionals->specialty?->title ?? 'N/A' }}</td>
                                    <td>{{ $professionals->created_at }}</td>
                                    <td>{{ $professionals->updated_at }}</td>
                                    <td>
                                        <div class="btn-group">

                                            <form method="POST"
                                                action="{{route('professional.restore_process',$professionals->id)}}" ,
                                                id="sub_Restore{{$professionals->id}}">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-info btn-circle btn-lg restore{{$professionals->id}}">
                                                    <i class="glyphicon fas fa-redo"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="container">
                        <hr>
                        <div class="row">
                            <div class="hint-text col-10"><b> {{ $professions->count() }}</b> items out of
                                <b>{{ $professions->total() }}</b> in
                                <b>{{ $professions->lastPage() }}</b> pages
                            </div>
                            <!-- 2 items out of 100 in 10 pages -->
                            <div class="col-1" style="border :10px;">
                                {{ $professions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
@endsection

@section('script')


@endsection