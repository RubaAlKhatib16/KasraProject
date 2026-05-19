@extends('layouts.app')

@section('content')

<style>
    :root {
        --primary-pink: #ff5ca8;
        --light-pink: #f7c8f3;
        --lavender: #e5c7ff;
        --sidebar-dark: #1d2940;
        --card-bg: #ffffff;
        --page-bg: #f5f6fa;
        --text-dark: #1e293b;
        --border-color: #eee;
    }

    body {
        background: var(--page-bg);
    }

    .edit-user-wrapper {
        padding: 35px;
    }

    .edit-user-card {
        background: var(--card-bg);
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid #ececec;
        box-shadow:
            0 4px 20px rgba(0,0,0,0.03);
    }

    .edit-user-header {
        padding: 28px 35px;
        background: linear-gradient(
            90deg,
            #ff5ca8 0%,
            #d8a8ff 100%
        );
        color: white;
    }

    .edit-user-header h2 {
        margin: 0;
        font-size: 34px;
        font-weight: 800;
    }

    .edit-user-body {
        padding: 40px 35px;
    }

    .form-label {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 10px;
    }

    .custom-input,
    .custom-select {
        width: 100%;
        height: 56px;
        border-radius: 16px;
        border: 1px solid #ececec;
        background: #fff;
        padding: 0 18px;
        font-size: 15px;
        transition: 0.3s;
        outline: none;
    }

    .custom-input:focus,
    .custom-select:focus {
        border-color: var(--primary-pink);
        box-shadow: 0 0 0 4px rgba(255,92,168,0.08);
    }

    .form-group {
        margin-bottom: 28px;
    }

    .btn-save {
        border: none;
        background: linear-gradient(
            90deg,
            #ff5ca8,
            #d8a8ff
        );
        color: white;
        height: 52px;
        padding: 0 35px;
        border-radius: 16px;
        font-size: 15px;
        font-weight: 700;
        transition: 0.3s;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        opacity: 0.95;
    }

    .btn-back {
        height: 52px;
        padding: 0 30px;
        border-radius: 16px;
        border: 1px solid #ddd;
        background: white;
        font-weight: 700;
        color: #444;
        transition: 0.3s;
    }

    .btn-back:hover {
        background: #f8f8f8;
    }

    .buttons-wrapper {
        display: flex;
        gap: 15px;
        margin-top: 15px;
    }

    @media(max-width:768px){

        .edit-user-wrapper{
            padding:20px;
        }

        .edit-user-header h2{
            font-size:26px;
        }

        .edit-user-body{
            padding:25px;
        }
    }
</style>

<div class="edit-user-wrapper">

    <div class="edit-user-card">

        <div class="edit-user-header">
            <h2>تعديل بيانات المستخدم</h2>
        </div>

        <div class="edit-user-body">

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                الاسم
                            </label>

                            <input type="text"
                                   name="name"
                                   class="custom-input"
                                   value="{{ old('name', $user->name) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                البريد الإلكتروني
                            </label>

                            <input type="email"
                                   name="email"
                                   class="custom-input"
                                   value="{{ old('email', $user->email) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                رقم الهاتف
                            </label>

                            <input type="text"
                                   name="phone"
                                   class="custom-input"
                                   value="{{ old('phone', $user->phone) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                نوع الحساب
                            </label>

                            <select name="role"
                                    class="custom-select">

                                <option value="customer"
                                    {{ $user->role == 'customer' ? 'selected' : '' }}>
                                    Customer
                                </option>

                                <option value="seller"
                                    {{ $user->role == 'seller' ? 'selected' : '' }}>
                                    Seller
                                </option>

                                <option value="admin"
                                    {{ $user->role == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>

                            </select>
                        </div>
                    </div>

                </div>

                <div class="buttons-wrapper">

                    <button type="submit"
                            class="btn-save">

                        حفظ التعديلات
                    </button>

                    <a href="{{ route('admin.users.index') }}"
                       class="btn-back">

                        رجوع
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection