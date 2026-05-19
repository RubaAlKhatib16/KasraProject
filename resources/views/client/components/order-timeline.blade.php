{{--
    ============================================================
    Order Status Timeline — Reusable Blade Component
    ============================================================
    الاستخدام:
        @include('client.components.order-timeline', ['order' => $order])

    حالات الطلب المدعومة:
        pending → processing → shipped → delivered
        أي حالة خارج هذه القائمة تُعرض كـ "cancelled"
    ============================================================
--}}
  @include('client.components.order-timeline', ['order' => $order])
@php
    $steps = [
        [
            'key'   => 'pending',
            'label' => 'قيد الانتظار',
            'icon'  => 'fas fa-clock',
            'desc'  => 'تم استلام طلبك وهو بانتظار المراجعة',
        ],
        [
            'key'   => 'processing',
            'label' => 'جارٍ التجهيز',
            'icon'  => 'fas fa-box-open',
            'desc'  => 'يتم تجهيز طلبك وتغليفه الآن',
        ],
        [
            'key'   => 'shipped',
            'label' => 'في الطريق',
            'icon'  => 'fas fa-shipping-fast',
            'desc'  => 'طلبك في الطريق إليك مع مندوب التوصيل',
        ],
        [
            'key'   => 'delivered',
            'label' => 'تم التسليم',
            'icon'  => 'fas fa-check-circle',
            'desc'  => 'تم تسليم طلبك بنجاح، شكراً لتسوقك معنا!',
        ],
    ];

    $statusOrder = ['pending', 'processing', 'shipped', 'delivered'];
    $currentStatus = $order->status ?? 'pending';
    $cancelled = $currentStatus === 'cancelled';
    $currentIndex = array_search($currentStatus, $statusOrder);
    if ($currentIndex === false) $currentIndex = 0;
@endphp

<div class="order-timeline-wrapper {{ $cancelled ? 'is-cancelled' : '' }}">

    {{-- حالة الإلغاء --}}
    @if($cancelled)
        <div class="cancelled-banner">
            <i class="fas fa-times-circle"></i>
            <span>تم إلغاء هذا الطلب</span>
        </div>
    @endif

    {{-- رقم الطلب + تاريخه --}}
    <div class="timeline-meta">
        <div class="timeline-meta-item">
            <i class="fas fa-hashtag"></i>
            <span>طلب رقم <strong>#{{ $order->id }}</strong></span>
        </div>
        <div class="timeline-meta-item">
            <i class="fas fa-calendar-alt"></i>
            <span>{{ $order->created_at->format('d / m / Y') }}</span>
        </div>
    </div>

    {{-- الـ Timeline --}}
    <div class="timeline-track">
        {{-- خط التقدم --}}
        <div class="track-line">
            <div
                class="track-fill"
                style="width: {{ $cancelled ? '0' : ($currentIndex / (count($steps) - 1)) * 100 }}%"
            ></div>
        </div>

        {{-- الخطوات --}}
        <div class="timeline-steps">
            @foreach($steps as $i => $step)
                @php
                    $isDone    = !$cancelled && $i < $currentIndex;
                    $isActive  = !$cancelled && $i === $currentIndex;
                    $isPending = $cancelled  || $i > $currentIndex;
                @endphp
                <div class="timeline-step {{ $isDone ? 'done' : ($isActive ? 'active' : 'pending') }}"
                     style="animation-delay: {{ $i * 0.12 }}s">

                    {{-- الأيقونة --}}
                    <div class="step-icon">
                        @if($isDone)
                            <i class="fas fa-check"></i>
                        @else
                            <i class="{{ $step['icon'] }}"></i>
                        @endif
                        @if($isActive)
                            <span class="pulse-ring"></span>
                        @endif
                    </div>

                    {{-- النص --}}
                    <div class="step-text">
                        <span class="step-label">{{ $step['label'] }}</span>
                        @if($isActive)
                            <span class="step-desc">{{ $step['desc'] }}</span>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    </div>

</div>

<style>
.order-timeline-wrapper {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(14px);
    border: 1px solid rgba(233, 179, 251, 0.2);
    border-radius: 28px;
    padding: 2rem 2rem 1.8rem;
    position: relative;
    overflow: hidden;
}
.order-timeline-wrapper::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at top left, rgba(255, 79, 139, 0.06), transparent 60%);
    pointer-events: none;
}

/* ---- meta ---- */
.timeline-meta {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    margin-bottom: 2rem;
    color: #94A3B8;
    font-size: 0.82rem;
}
.timeline-meta-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
}
.timeline-meta-item i { color: #E9B3FB; }
.timeline-meta-item strong { color: #fff; }

/* ---- cancelled ---- */
.cancelled-banner {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    background: rgba(239, 68, 68, 0.12);
    border: 1px solid rgba(239, 68, 68, 0.35);
    border-radius: 60px;
    padding: 0.5rem 1.2rem;
    color: #FCA5A5;
    font-size: 0.88rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    width: fit-content;
}
.cancelled-banner i { font-size: 1rem; }
.is-cancelled .track-fill { background: rgba(239,68,68,0.4) !important; }

/* ---- track ---- */
.timeline-track { position: relative; }

.track-line {
    position: absolute;
    top: 24px;
    right: 24px;
    left: 24px;
    height: 3px;
    background: rgba(255,255,255,0.07);
    border-radius: 99px;
    z-index: 0;
}
.track-fill {
    height: 100%;
    border-radius: 99px;
    background: linear-gradient(90deg, #FF4F8B, #E9B3FB);
    transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
}

/* ---- steps ---- */
.timeline-steps {
    display: flex;
    justify-content: space-between;
    position: relative;
    z-index: 1;
    gap: 0.5rem;
}

.timeline-step {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    animation: stepFadeIn 0.5s ease both;
}

@keyframes stepFadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ---- icon ---- */
.step-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    position: relative;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

/* done */
.timeline-step.done .step-icon {
    background: linear-gradient(135deg, #FF4F8B, #E6497D);
    box-shadow: 0 0 18px rgba(255, 79, 139, 0.4);
    color: #fff;
}

/* active */
.timeline-step.active .step-icon {
    background: linear-gradient(135deg, #E9B3FB, #C084FC);
    box-shadow: 0 0 24px rgba(233, 179, 251, 0.5);
    color: #1e0a2e;
}

/* pending */
.timeline-step.pending .step-icon {
    background: rgba(255,255,255,0.05);
    border: 2px solid rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.25);
}

/* ---- pulse ring ---- */
.pulse-ring {
    position: absolute;
    inset: -6px;
    border-radius: 50%;
    border: 2px solid rgba(233, 179, 251, 0.5);
    animation: pulse 1.8s ease-out infinite;
}
@keyframes pulse {
    0%   { transform: scale(1);   opacity: 0.8; }
    100% { transform: scale(1.6); opacity: 0; }
}

/* ---- text ---- */
.step-text {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.3rem;
    text-align: center;
}
.step-label {
    font-size: 0.78rem;
    font-weight: 700;
}
.timeline-step.done   .step-label { color: #FFB3C7; }
.timeline-step.active .step-label { color: #E9B3FB; }
.timeline-step.pending .step-label { color: rgba(255,255,255,0.3); }

.step-desc {
    font-size: 0.68rem;
    color: #94A3B8;
    max-width: 110px;
    line-height: 1.4;
}

/* ---- responsive ---- */
@media (max-width: 600px) {
    .timeline-steps { gap: 0.25rem; }
    .step-icon { width: 38px; height: 38px; font-size: 0.85rem; }
    .track-line { top: 19px; }
    .step-desc { display: none; }
    .order-timeline-wrapper { padding: 1.4rem 1rem 1.2rem; }
}
</style>