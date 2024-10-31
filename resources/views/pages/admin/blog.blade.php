<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.head')
</head>

@section('content')
<style>
@media (max-width: 768px) {
    .page-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .breadcrumbs {
        padding-left: 0 !important;
        margin-left: 0 !important;
    }
}
</style>
<div class="wrapper">
    <div class="main-header">
        @include('layouts.admin.nav')
    </div>
    @include('layouts.admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">{{ $judul }}</h4>
                    <ul class="breadcrumbs">
                        <a href="{{ route('blog.add') }}" class="btn btn-round text-white ml-auto fw-bold" style="background-color: #35A5B1">
                            <i class="fa fa-plus-circle mr-1"></i>
                            New Articles
                        </a>
                    </ul>
                </div>
                <div class="row">
                    @foreach ($DataB as $B)
                    <div class="col-md-4">
                        <div class="card card-post card-round">
                            <img class="card-img-top" src="{{ url('') }}/assets1/img/Blog/{{ $B->thumbnail_blog }}" alt="...">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="info-post ml-2">
                                        <p class="username">{{ $B->title_blog }}</p>
                                        <p class="date text-muted">
                                            {!! Str::limit(strip_tags($B->content_blog, '<b><i><u><strong><em>'), 45, '...') !!}
                                        </p>
                                    </div>
                                </div>
                                <div class="separator-solid"></div>
                                <a href="{{ route('blog.edit', $B->id_blog) }}">
                                    <button type="button" class="btn btn-icon btn-round btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                </a>
                                <a href="{{ route('blog.delete', $B->id_blog) }}" class="but-delete">
                                    <button type="button" class="btn btn-icon btn-round btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </a>
                                @if (Auth::user()->level == 'Super Admin')
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-icon btn-round btn-success" data-toggle="modal" data-target="#{{ $B->id_blog }}">
                                        <i class="fas fa-history"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="{{ $B->id_blog }}" tabindex="-1" role="dialog" aria-labelledby="{{ $B->id_blog }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="{{ $B->id_blog }}Label"><b>Activity History</b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Created : <br>{{ $B->created_by }} <b>({{ $B->created_at }})</b></p>
                                                    <p>Last Modified : <br>{{ $B->modified_by }} <b>({{ $B->updated_at }})</b></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('layouts.admin.footer')
    </div>
</div>
@include('layouts.admin.script')
<script>
    $(document).on('click','.but-delete',function(e) {

        e.preventDefault();
        const href1 = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "This data will be Permanently Deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#fd7e14',
            confirmButtonText: 'DELETE',
            cancelButtonText: 'CANCEL'
            }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href1;
            }
        });
    });

    //message with sweetalert
    @if(session('success'))
    Swal.fire({
        icon: "success",
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 3000
    });
    @elseif(session('error'))
    Swal.fire({
        icon: "error",
        title: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 3000
    });
    @endif
</script>
@endsection

<body>
    @yield('content')
</body>
</html>
