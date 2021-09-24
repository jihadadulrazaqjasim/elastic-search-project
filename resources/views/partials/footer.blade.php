   <!-- Footer -->
   <footer class="sticky-footer bg-white" >
    <div class="container my-auto" >
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Jihad - 2021</span>
            <br><br>
            {{-- <span>07507703483 - 07507696865</span> --}}
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->


<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

        <a class="btn btn-primary" href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logoutForm').submit();">
                        Logout
                    </a>
                    <form id="logoutForm" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
    </div>
</div>
</div>
</div>

<!-- Scripts -->
<script src="{{URL::to('js/app.js')}}"></script>

<!-- Bootstrap core JavaScript-->
<script src="{{URL::to('vendor/jquery/jquery.min.js')}}"></script>

<script src="{{URL::to('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{URL::to('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{URL::to('/js/sb-admin-2.min.js')}}" type="text/javascript"></script>
