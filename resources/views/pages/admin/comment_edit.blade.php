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
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                            <form method="POST" action="{{ route('comment.update', $EditComment->id_comments) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group @error('Author') has-error has-feedback @enderror">
                                            <label for="Author">Author Name</label>
                                            <input type="text" id="Author" name="Author" value="{{ old('Author', $EditComment->author_comments) }}" class="form-control" required>
                                            @error('Author')
                                            <small id="Author" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Email') has-error has-feedback @enderror">
                                            <label for="Email">Email</label>
                                            <input type="email" id="Email" name="Email" value="{{ old('Email', $EditComment->email_comments) }}" class="form-control" required>
                                            @error('Email')
                                            <small id="Email" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Phone') has-error has-feedback @enderror">
                                            <label for="Phone">Phone Number</label>
                                            <input type="tel" id="Phone" name="Phone" value="{{ old('Phone', $EditComment->phone_comments) }}" class="form-control" required>
                                            @error('Phone')
                                            <small id="Phone" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group @error('Comment') has-error has-feedback @enderror">
                                            <label for="Comment">Comment</label>
                                            <textarea class="form-control" id="Comment" name="Comment">
                                                {{ old('Comment', $EditComment->content_comments) }}
                                            </textarea>
                                            @error('Comment')
                                            <small id="Comment" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="visibility">Visibility</label>
                                            <select class="form-control" id="visibility" name="visibility">
                                                <option name='visibility' value='Showing' {{ $EditComment->visib_comments == 'Showing' ? 'selected' : '' }}>Showing (Publish)</option>
                                                <option name='visibility' value='Hiding' {{ $EditComment->visib_comments == 'Hiding' ? 'selected' : '' }}>Hiding (Unpublish)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success fw-bold text-uppercase">
                                                <i class="fas fa-save mr-2"></i>Save
                                            </button>
                                            <a href="{{ route('comment.data') }}" class="btn btn-warning fw-bold text-uppercase but-back">
                                                <i class="fas fa-chevron-circle-left mr-2"></i>Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.admin.footer')
    </div>
</div>
@include('layouts.admin.script')
<script type="text/javascript">
    $(document).on('click','.but-back',function(e) {

        e.preventDefault();
        const href1 = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "Changes will not be Saved!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#fd7e14',
            confirmButtonText: 'BACK',
            cancelButtonText: 'CANCEL'
            }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href1;
            }
        });
    });
</script>
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.0.0/"
        }
    }
</script>
<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Font
    } from 'ckeditor5';
    ClassicEditor
        .create( document.querySelector( '#Comment' ), {
            plugins: [
                Essentials, Paragraph, Bold, Italic, Font
            ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
<script>
    window.onload = function() {
        if ( window.location.protocol === 'file:' ) {
            alert( 'This sample requires an HTTP server. Please serve this file with a web server.' );
        }
    };
</script>
@endsection

<body>
    @yield('content')
</body>
</html>
