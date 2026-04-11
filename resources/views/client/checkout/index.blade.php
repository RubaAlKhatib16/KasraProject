@extends('client.layouts.app')
@section('title', 'إتمام الطلب')
@section('content')
<div class="container">
    <h1>إتمام الطلب</h1>
    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf
        <input type="text" name="shipping_address" placeholder="عنوان التوصيل" required>
        <input type="text" name="phone" placeholder="رقم الهاتف" required>
        <textarea name="notes" placeholder="ملاحظات"></textarea>
        <button type="submit">تأكيد الطلب</button>
    </form>
</div>
@endsection