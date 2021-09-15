@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $pageSubTitle }}</p>
        </div>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary pull-right">Add Role</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th> No. </th>
                            <th> Title </th>
                            <th>Permissions</th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                               <td>{{ $role->title }}</td>
                                <td class="text-center">
                                    @php $permission = json_decode($role->permissions) @endphp
                                    @foreach($permission as $per)
{{--                                    <ul>--}}
                                        <h3 style="text-transform: uppercase;">{{ $per->model }}</h3>
                                        <ul class="list-group">
                                            @if($per->permissions==1)
                                            <li class="list-group-item">View</li>
                                            @elseif($per->permissions==2)
                                                <li class="list-group-item">View</li>
                                                <li class="list-group-item">Create</li>
                                            @elseif($per->permissions==3)
                                                <li class="list-group-item">View</li>
                                                <li class="list-group-item">Create</li>
                                                <li class="list-group-item">Update</li>
                                            @elseif($per->permissions==4)
                                                <li class="list-group-item">View</li>
                                                <li class="list-group-item">Create</li>
                                                <li class="list-group-item">Update</li>
                                                <li class="list-group-item">delete</li>
                                                @endif
                                        </ul>
{{--                                        </h2>--}}
{{--                                    </ul>--}}
                                    @endforeach
{{--                                    {{ $role->permissions }}--}}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
{{--                                        <a onclick="return confirm('Are you sure?')" href="{{ route('admin.coupons.delete', $coupon->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>--}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('public/backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
