@extends('admin.app')
@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $pageSubTitle }}</p>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <form action="{{ route('admin.roles.update') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title', $targetRole->title) }}"/>
                            <input type="hidden" name="id" value="{{ $targetRole->id }}">
                            @error('title') {{ $message }} @enderror
                        </div>
                        <h2>Permissions</h2>
                        <div class="form-group">
                            <legend>Category</legend>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="cate_1" name="category" value="1" {{ (in_array($category,[1,2,3,4])) ? 'checked':'' }}/>view
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="cate_2" name="category" value="2" {{ (in_array($category,[2,3,4])) ? 'checked':'' }}/>create
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="cate_3" name="category" value="3" {{ (in_array($category,[3,4])) ? 'checked':'' }}/>edit
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="cate_4" name="category" value="4" {{ (in_array($category,[4])) ? 'checked':'' }}/>delete
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <legend>User Management</legend>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="user_1" name="user" value="1" {{ (in_array($user,[1,2,3,4])) ? 'checked':'' }}/>view
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="user_2" name="user" value="2" {{ (in_array($user,[2,3,4])) ? 'checked':'' }}/>create
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="user_3" name="user" value="3" {{ (in_array($user,[3,4])) ? 'checked':'' }}/>edit
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="user_4" name="user" value="4" {{ (in_array($user,[4])) ? 'checked':'' }}/>delete
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <legend>Role Management</legend>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="role_1" name="role" value="1" {{ (in_array($role,[1,2,3,4])) ? 'checked':'' }}/>view
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="role_2" name="role" value="2" {{ (in_array($role,[2,3,4])) ? 'checked':'' }}/>create
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="role_3" name="role" value="3" {{ (in_array($role,[3,4])) ? 'checked':'' }}/>edit
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" id="role_4" name="role" value="4" {{ (in_array($role,[4])) ? 'checked':'' }}/>delete
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Permission</button>
                        &nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="{{ route('admin.roles.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
