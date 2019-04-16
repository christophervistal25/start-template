<!-- Scripts -->
<!-- Bootstrap core JavaScript-->
<script src="{{URL::asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Core plugin JavaScript-->
<script src="{{URL::asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src="{{URL::asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{URL::asset("vendor/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{URL::asset("vendor/datatables/dataTables.bootstrap4.min.js")}}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

<script>
    {{-- AN EXAMPLE OF LARA TABLES --}}
     /*$('#checkins-table').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        ajax: // route('list_of_checkins') ",
        columns: [
            { name: 'customer_name' },
            { name: 'customer_phone_number' },
            { name: 'room_number' },
            { name: 'created_at' },
            { name: 'timer'  , searchable :false},
        ],
         "fnDrawCallback": function( oSettings ) {
            // A function that inside of room-select.js
        }
    });
*/


</script>
</body>
</html>
