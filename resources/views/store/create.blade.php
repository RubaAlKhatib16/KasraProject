@extends('layouts.app')

@section('title', 'إنشاء متجر جديد')

@section('content')
<div class="container">
    <h1>إنشاء متجر جديد</h1>

    <form method="POST" action="{{ route('store.store') }}">
        @csrf

        <div class="form-group">
            <label>اسم المتجر</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>وصف المتجر</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">إنشاء المتجر</button>
    </form>
</div>
@endsection