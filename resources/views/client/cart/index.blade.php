@extends('client.layouts.app')

@section('title', 'سلة التسوق')

@section('content')
<div class="container">
    <h1 style="font-size: 2rem; font-weight: 800; background: linear-gradient(120deg,#FFF,#E9B3FB); background-clip: text; -webkit-background-clip: text; color: transparent; margin-bottom: 1.5rem;">سلة التسوق</h1>

    @if(session('success'))
        <div style="background: rgba(46,125,50,0.2); border: 1px solid #4caf50; padding: 0.8rem; border-radius: 60px; margin-bottom: 1rem;">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <div style="text-align: center; padding: 3rem;">سلة التسوق فارغة. <a href="{{ route('client.products.index') }}" style="color:#FFB3C7;">تسوق الآن</a></div>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(233,179,251,0.3);">
                        <th style="padding: 1rem 0.5rem;">المنتج</th>
                        <th style="padding: 1rem 0.5rem;">السعر</th>
                        <th style="padding: 1rem 0.5rem;">الكمية</th>
                        <th style="padding: 1rem 0.5rem;">خطة التقسيط</th>
                        <th style="padding: 1rem 0.5rem;">الإجمالي</th>
                        <th style="padding: 1rem 0.5rem;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                    <tr style="border-bottom: 1px solid rgba(233,179,251,0.2);">
                        <td style="padding: 1rem 0.5rem;">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                @if($item['featured_image'])
                                    <img src="{{ asset('storage/' . $item['featured_image']) }}" width="50" style="border-radius: 8px;">
                                @endif
                                {{ $item['name'] }}
                            </div>
                        </td>
                        <td style="padding: 1rem 0.5rem;">{{ number_format($item['price'], 2) }} د.أ</td>
                        <td style="padding: 1rem 0.5rem;">
                            <form action="{{ route('cart.update', $id) }}" method="POST" style="display: inline-flex; gap: 0.5rem;">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 70px; padding: 0.3rem; border-radius: 40px;">
                                <input type="hidden" name="installment_plan" value="{{ $item['installment_plan'] }}">
                                <button type="submit" style="background: none; border: none; color: #FFB3C7; cursor: pointer;"><i class="fas fa-sync-alt"></i></button>
                            </form>
                        </td>
                        <td style="padding: 1rem 0.5rem;">
                            @if($item['installment_plan'] > 0)
                                {{ $item['installment_plan'] }} قسط ({{ number_format($item['price'] / $item['installment_plan'], 2) }} د.أ/شهر)
                            @else
                                نقدي
                            @endif
                        </td>
                        <td style="padding: 1rem 0.5rem;">{{ number_format($item['price'] * $item['quantity'], 2) }} د.أ</td>
                        <td style="padding: 1rem 0.5rem;">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #FF8A8A; cursor: pointer;"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="border-top: 1px solid rgba(233,179,251,0.3);">
                        <td colspan="4" style="text-align: left; padding: 1rem 0.5rem;"><strong>الإجمالي الكلي:</strong></td>
                        <td colspan="2"><strong>{{ number_format($total, 2) }} د.أ</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div style="margin-top: 2rem; text-align: left;">
            <a href="{{ route('checkout.index') }}" style="background: #FF4F8B; border: none; padding: 0.8rem 2rem; border-radius: 60px; color: white; font-weight: bold; text-decoration: none; display: inline-block;">إتمام الشراء</a>
        </div>
    @endif
</div>
@endsection