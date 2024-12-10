@extends('user.layouts.master')
@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Đổi mật khẩu</div>
   
                <div class="card-body">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf 
   
                         @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                         @endforeach 
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu hiện tại</label>
  
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                    <div class="input-group-append">
                                        <span class="input-group-text toggle-password" style="cursor: pointer;">
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu mới</label>
  
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                    <div class="input-group-append">
                                        <span class="input-group-text toggle-password" style="cursor: pointer;">
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Xác nhận mật khẩu mới</label>
    
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                    <div class="input-group-append">
                                        <span class="input-group-text toggle-password" style="cursor: pointer;">
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
   
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Cập nhật mật khẩu
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .input-group-text {
        background-color: transparent;
        border-left: none;
    }
    .form-control {
        border-right: none;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelectorAll('.toggle-password');
    
    togglePassword.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.input-group').querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    });
});
</script>
@endsection