@extends('layouts/layoutMaster')

@section('title', 'Superadmin')



@section('content')
    <div class="row g-6 mb-6">
        <!-- Ratings -->
        <div class="col-12">
            <div class="card h-100">
                <div class="row">
                    <div class="col-6">
                        <div class="card-body">
                            <div class="card-info mb-5">
                                <h4 class="mb-2 text-nowrap">Superadmin</h4>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('user_management.superadmin.create') }}"
                                    class="btn btn-sm btn-primary waves-effect waves-light">
                                    <span class="d-inline-block"> Add New User </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-end d-flex align-items-end">
                        <div class="card-body pb-0 pt-7">
                            <img src="{{ asset('assets/img/roles/superadmin.png') }}" alt="Ratings" class="img-fluid"
                                width="95">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Ratings -->
    </div>

    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection


@section('page-script')
    <script type="module">
        $(document).ready(function() {
            console.log('ready');

            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('user_management.superadmin.index') }}",
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                    },
                    {
                        data: 'id',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: (data, type, full) => {

                            let str = `<a href="{{ URL::to('user_management/superadmin') }}/${full.ulid}/edit" class = "btn btn-sm btn-outline-primary me-4 waves-effect" >Edit </a>
                            <button class ="btn btn-sm btn-outline-danger me-4 waves-effect delete" data-url="{{ URL::to('user_management/superadmin') }}/${full.ulid}">Delete </button>`;
                            return str;
                        }
                    },
                ]
            });
        });
    </script>
@endsection
