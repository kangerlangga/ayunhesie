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
                        <a href="{{ route('comment.add') }}" class="btn btn-round text-white ml-auto fw-bold" style="background-color: #35A5B1">
                            <i class="fa fa-plus-circle mr-1"></i>
                            New Comments
                        </a>
                    </ul>
                </div>
                <div class="row">
                    @foreach ($DataC as $C)
                    <div class="col-md-4">
                        <div class="card card-info card-annoucement card-round">
                            <div class="card-body text-center">
                                <div class="card-opening">{{ $C->author_comments }}</div>
                                <div class="card-desc">
                                    {!! Str::limit(strip_tags($C->content_comments, '<b><i><u><strong><em>'), 135, '...') !!}
                                </div>
                                <div class="card-detail">
                                    <a href="{{ route('comment.edit', $C->id_comments) }}">
                                        <button type="button" class="btn btn-icon btn-round btn-warning">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('comment.delete', $C->id_comments) }}" class="but-delete">
                                        <button type="button" class="btn btn-icon btn-round btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </a>
                                    @if (Auth::user()->level == 'Super Admin')
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-icon btn-round btn-success" data-toggle="modal" data-target="#{{ $C->id_comments }}">
                                            <i class="fas fa-history"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="{{ $C->id_comments }}" tabindex="-1" role="dialog" aria-labelledby="{{ $C->id_comments }}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content" style="color: black">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="{{ $C->id_comments }}Label"><b>Activity History</b></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" style="text-align: left;">
                                                        <p>Created : <br>{{ $C->created_by }} <b>({{ $C->created_at }})</b></p>
                                                        <p>Last Modified : <br>{{ $C->modified_by }} <b>({{ $C->updated_at }})</b></p>
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
