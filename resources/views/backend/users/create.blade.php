@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Thêm người dùng</h5>
    <div class="card-body">
      <form method="post" action="{{route('users.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Tên</label>
        <input id="inputTitle" type="text" name="name" placeholder="Nhập tên của bạn"  value="{{old('name')}}" class="form-control">
        @error('name')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
            <label for="inputEmail" class="col-form-label">Email</label>
          <input id="inputEmail" type="email" name="email" placeholder="Nhập Email của bạn"  value="{{old('email')}}" class="form-control">
          @error('email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
            <label for="inputPassword" class="col-form-label">Mật khẩu</label>
            <div class="input-group">
                <input id="inputPassword" type="password" name="password" placeholder="Nhập mật khẩu" value="{{old('password')}}" class="form-control">
                <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePassword()">
                        <i class="fas fa-eye" id="togglePassword"></i>
                    </span>
                </div>
            </div>
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="form-group">
        <label for="inputPhoto" class="col-form-label">Hình</label>
        <div class="input-group">
            <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
                </a>
            </span>
            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">
          @error('photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        @php 
        $roles=DB::table('users')->select('role')->distinct()->get();
        @endphp
        <div class="form-group">
            <label for="role" class="col-form-label">Role</label>
            <select name="role" class="form-control">
                <option value="">-----Chọn Role-----</option>
                @foreach($roles as $role)
                    <option value="{{$role->role}}">{{$role->role}}</option>
                @endforeach
            </select>
          @error('role')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
          <div class="form-group">
            <label for="status" class="col-form-label">Trạng thái</label>
            <select name="status" class="form-control">
                <option value="active">Kích hoạt</option>
                <option value="inactive">Không kích hoạt</option>
            </select>
          @error('status')
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
        <div class="form-group mb-3">
          <button class="btn btn-success" type="submit">Thêm mới</button>
          <button type="reset" class="btn btn-warning">Hoàn tác</button>
           
        </div>
      </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
<script>
function togglePassword() {
    const passwordInput = document.getElementById('inputPassword');
    const toggleIcon = document.getElementById('togglePassword');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
@endpush