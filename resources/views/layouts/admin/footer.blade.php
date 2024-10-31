<footer class="footer">
    <div class="container-fluid">
        {{-- <nav class="pull-left">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{  url('') }}">
                        Ayunhe Official Website
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Help
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Licenses
                    </a>
                </li>
            </ul>
        </nav> --}}
        <div class="copyright ml-auto">
            Copyright &copy; <?= date("Y")?> by <a href="{{  url('') }}" target="_blank">Ayunhe Official Website</a>
        </div>
    </div>
</footer>
<form id="logout-admin" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<script>
function confirmLogout() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You will be logged out from your account!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Logout!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-admin').submit();
        }
    });
}
</script>
