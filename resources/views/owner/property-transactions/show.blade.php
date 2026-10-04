@extends('layouts.app') 
 
@section('title', 'Property Request Details') 
 
@section('content') 
 
<style> 
    .owner-request-page { 
        background: #f8fafc; 
        min-height: 100vh; 
        padding: 30px 0 55px; 
    } 
 
    .request-card { 
        background: #ffffff; 
        border: 1px solid #e5e7eb; 
        border-radius: 16px; 
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05); 
        overflow: hidden; 
    } 
 
    .request-card-body { 
        padding: 24px; 
    } 
 
    .request-section-title { 
        color: #111827; 
        font-weight: 700; 
        margin-bottom: 3px; 
    } 
 
    .request-section-subtitle { 
        color: #6b7280; 
        font-size: 13px; 
    } 
 
    .request-label { 
        color: #6b7280; 
        font-size: 11px; 
        font-weight: 700; 
        letter-spacing: .08em; 
        text-transform: uppercase; 
    } 
 
    .request-value { 
        color: #111827; 
        font-size: 14px; 
        font-weight: 600; 
        margin-top: 4px; 
    } 
 
    .request-muted { 
        color: #6b7280; 
        font-size: 14px; 
    } 
 
    .request-stat { 
        background: #f8fafc; 
        border: 1px solid #e5e7eb; 
        border-radius: 12px; 
        padding: 15px; 
        height: 100%; 
    } 
 
    .request-stat-value { 
        color: #111827; 
        font-size: 15px; 
        font-weight: 700; 
        margin-top: 5px; 
    } 
 
    .request-icon { 
        width: 44px; 
        height: 44px; 
        border-radius: 12px; 
        display: inline-flex; 
        align-items: center; 
        justify-content: center; 
        flex-shrink: 0; 
    } 
 
    .icon-indigo { 
        background: #eef2ff; 
        color: #4f46e5; 
    } 
 
    .icon-purple { 
        background: #f5f3ff; 
        color: #7c3aed; 
    } 
 
    .icon-emerald { 
        background: #ecfdf5; 
        color: #059669; 
    } 
 
    .icon-amber { 
        background: #fffbeb; 
        color: #d97706; 
    } 
 
    .icon-sky { 
        background: #f0f9ff; 
        color: #0284c7; 
    } 
 
    .icon-gray { 
        background: #f3f4f6; 
        color: #6b7280; 
    } 
 
    .request-status { 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
        border-radius: 999px; 
        padding: 9px 15px; 
        font-size: 13px; 
        font-weight: 700; 
        white-space: nowrap; 
    } 
 
    .request-status-dot { 
        width: 8px; 
        height: 8px; 
        border-radius: 50%; 
    } 
 
    .status-pending { 
        background: #fffbeb; 
        color: #b45309; 
    } 
 
    .status-pending .request-status-dot { 
        background: #f59e0b; 
    } 
 
    .status-approved { 
        background: #eff6ff; 
        color: #2563eb; 
    } 
 
    .status-approved .request-status-dot { 
        background: #3b82f6; 
    } 
 
    .status-completed { 
        background: #ecfdf5; 
        color: #047857; 
    } 
 
    .status-completed .request-status-dot { 
        background: #10b981; 
    } 
 
    .status-rejected { 
        background: #fef2f2; 
        color: #dc2626; 
    } 
 
    .status-rejected .request-status-dot { 
        background: #ef4444; 
    } 
 
    .status-cancelled { 
        background: #f3f4f6; 
        color: #4b5563; 
    } 
 
    .status-cancelled .request-status-dot { 
        background: #9ca3af; 
    } 
 
    .status-default { 
        background: #f3f4f6; 
        color: #6b7280; 
    } 
 
    .status-default .request-status-dot { 
        background: #9ca3af; 
    } 
 
    .property-main-image { 
        width: 100%; 
        height: 310px; 
        object-fit: cover; 
        display: block; 
    } 
 
    .property-image-placeholder { 
        height: 310px; 
        background: #f8fafc; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        color: #cbd5e1; 
    } 
 
    .request-type-badge { 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
        border-radius: 999px; 
        padding: 9px 14px; 
        font-size: 13px; 
        font-weight: 700; 
        white-space: nowrap; 
    } 
 
    .buy-badge { 
        background: #fff7ed; 
        color: #ea580c; 
    } 
 
    .rent-badge { 
        background: #ecfeff; 
        color: #0891b2; 
    } 
 
    .request-link { 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
        border-radius: 10px; 
        padding: 10px 15px; 
        background: #f5f3ff; 
        border: 1px solid #ddd6fe; 
        color: #6d28d9; 
        text-decoration: none; 
        font-size: 13px; 
        font-weight: 700; 
        transition: .2s ease; 
    } 
 
    .request-link:hover { 
        background: #ede9fe; 
        color: #5b21b6; 
    } 
 
    .offer-box { 
        border-radius: 16px; 
        padding: 22px; 
        background: #ffffff; 
        height: 100%; 
    } 
 
    .offer-listed { 
        border: 1px solid #d1fae5; 
    } 
 
    .offer-customer { 
        border: 1px solid #ddd6fe; 
    } 
 
    .offer-counter { 
        border: 1px solid #fde68a; 
    } 
 
    .offer-amount { 
        font-size: 20px; 
        font-weight: 800; 
        margin-top: 3px; 
    } 
 
    .amount-emerald { 
        color: #059669; 
    } 
 
    .amount-purple { 
        color: #7c3aed; 
    } 
 
    .amount-amber { 
        color: #d97706; 
    } 
 
    .agent-card { 
        border: 1px solid #ddd6fe; 
        background: #ffffff; 
        border-radius: 16px; 
        padding: 22px; 
    } 
 
    .agent-avatar { 
        width: 48px; 
        height: 48px; 
        border-radius: 50%; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        background: linear-gradient(135deg, #8b5cf6, #d946ef); 
        color: #ffffff; 
        font-size: 18px; 
        font-weight: 800; 
        text-transform: uppercase; 
        flex-shrink: 0; 
    } 
 
    .agent-badge { 
        display: inline-flex; 
        align-items: center; 
        gap: 7px; 
        background: #f5f3ff; 
        border: 1px solid #ddd6fe; 
        color: #7c3aed; 
        border-radius: 999px; 
        padding: 8px 13px; 
        font-size: 12px; 
        font-weight: 700; 
    } 
 
    .form-control, 
    .form-select { 
        border-color: #d1d5db; 
        border-radius: 10px; 
        padding: 11px 13px; 
        font-size: 14px; 
        color: #111827; 
        box-shadow: none !important; 
    } 
 
    .form-control:focus, 
    .form-select:focus { 
        border-color: #6366f1; 
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .10) !important; 
    } 
 
    textarea.form-control { 
        min-height: 110px; 
    } 
 
    .counter-input-wrap { 
        position: relative; 
    } 
 
    .counter-input-symbol { 
        position: absolute; 
        left: 13px; 
        top: 50%; 
        transform: translateY(-50%); 
        color: #9ca3af; 
        font-weight: 600; 
        z-index: 2; 
    } 
 
    .counter-input { 
        padding-left: 31px !important; 
    } 
 
    .info-box { 
        display: flex; 
        align-items: flex-start; 
        gap: 11px; 
        border-radius: 11px; 
        padding: 13px 15px; 
        font-size: 12px; 
        line-height: 1.6; 
    } 
 
    .info-amber { 
        background: #fffbeb; 
        border: 1px solid #fde68a; 
        color: #92400e; 
    } 
 
    .info-gray { 
        background: #f8fafc; 
        border: 1px solid #e5e7eb; 
        color: #6b7280; 
    } 
 
    .warning-box { 
        display: flex; 
        align-items: flex-start; 
        gap: 11px; 
        background: #fffbeb; 
        border: 1px solid #fde68a; 
        border-radius: 11px; 
        padding: 14px 15px; 
    } 
 
    .warning-title { 
        color: #b45309; 
        font-size: 13px; 
        font-weight: 700; 
    } 
 
    .warning-text { 
        color: #78716c; 
        font-size: 12px; 
        line-height: 1.6; 
        margin-top: 3px; 
    } 
 
    .cancelled-box { 
        border: 1px solid #e5e7eb; 
        background: #ffffff; 
        border-radius: 16px; 
        padding: 24px; 
    } 
 
    .btn-indigo { 
        background: linear-gradient(135deg, #6366f1, #7c3aed); 
        border: none; 
        color: #ffffff; 
        border-radius: 10px; 
        padding: 11px 20px; 
        font-size: 13px; 
        font-weight: 700; 
        transition: .2s ease; 
    } 
 
    .btn-indigo:hover { 
        color: #ffffff; 
        transform: translateY(-1px); 
        box-shadow: 0 7px 18px rgba(79, 70, 229, .18); 
    } 
 
    .btn-amber { 
        background: linear-gradient(135deg, #f59e0b, #f97316); 
        border: none; 
        color: #ffffff; 
        border-radius: 10px; 
        padding: 11px 20px; 
        font-size: 13px; 
        font-weight: 700; 
        transition: .2s ease; 
    } 
 
    .btn-amber:hover { 
        color: #ffffff; 
        transform: translateY(-1px); 
    } 
 
    .btn-back { 
        display: inline-flex; 
        align-items: center; 
        justify-content: center; 
        gap: 8px; 
        border: 1px solid #d1d5db; 
        background: #ffffff; 
        color: #4b5563; 
        border-radius: 10px; 
        padding: 11px 18px; 
        font-size: 13px; 
        font-weight: 700; 
        text-decoration: none; 
        transition: .2s ease; 
    } 
 
    .btn-back:hover { 
        background: #f9fafb; 
        color: #111827; 
        border-color: #9ca3af; 
    } 
 
    .note-card { 
        background: #ffffff; 
        border: 1px solid #e5e7eb; 
        border-radius: 16px; 
        padding: 22px; 
    } 
 
    /* ===================================================== 
       REQUEST DETAIL HEADER 
    ====================================================== */ 
 
    .request-detail-header { 
        display: flex; 
        align-items: center; 
        justify-content: space-between; 
        gap: 24px; 
        flex-wrap: wrap; 
    } 
 
    .request-detail-header-left { 
        flex: 1; 
        min-width: 250px; 
    } 
 
    .request-detail-header-actions { 
        flex-shrink: 0; 
    } 
 
    .back-request-btn { 
        display: inline-flex; 
        align-items: center; 
        justify-content: center; 
        gap: 8px; 
        background: #ffffff; 
        border: 1px solid #e5e7eb; 
        color: #374151; 
        border-radius: 10px; 
        padding: 10px 16px; 
        font-size: 13px; 
        font-weight: 700; 
        text-decoration: none; 
        transition: .2s ease; 
        box-shadow: 0 3px 10px rgba(15, 23, 42, .05); 
    } 
 
    .back-request-btn:hover { 
        background: #f9fafb; 
        border-color: #cbd5e1; 
        color: #111827; 
        transform: translateY(-1px); 
    } 
 
    @media (max-width: 767.98px) { 
        .owner-request-page { 
            padding: 20px 0 40px; 
        } 
 
        .request-card-body { 
            padding: 18px; 
        } 
 
        .property-main-image, 
        .property-image-placeholder { 
            height: 230px; 
        } 
 
        .request-detail-header { 
            align-items: flex-start; 
            gap: 16px; 
        } 
 
        .request-detail-header-actions { 
            width: 100%; 
        } 
 
        .back-request-btn { 
            width: 100%; 
        } 
    } 
</style> 
 
 
{{-- ===================================================== 
     DASHBOARD STYLE TOP HEADER 
====================================================== --}} 
 
<section class="section-top"> 
 
    <div class="container"> 
 
        <div class="col-lg-10 offset-lg-1 col-xs-12 text-center"> 
 
            <div class="section-top-title wow fadeInRight" 
                 data-wow-duration="1s" 
                 data-wow-delay="0.3s" 
                 data-wow-offset="0"> 
 
                <h1>Property Request #{{ $transaction->id }}</h1> 
 
                <p> 
                    Review applicant information and manage this property request. 
                </p> 
 
            </div> 
 
        </div> 
 
    </div> 
 
</section> 
 
 
<div class="owner-request-page"> 
 
    <div class="container"> 
 
        {{-- ===================================================== 
             HEADER 
        ====================================================== --}} 
 
        <div class="request-detail-header mb-4"> 
 
            <div class="request-detail-header-left"> 
 
                <div class="mb-2"> 
 
                    <span class="request-label"> 
                        Request Details 
                    </span> 
 
                </div> 
 
                <h2 class="h4 fw-bold text-dark mb-1"> 
                    Property Request #{{ $transaction->id }} 
                </h2> 
 
                <p class="text-muted mb-0 small"> 
                    Review applicant information, offers and manage this property request. 
                </p> 
 
            </div> 
 
 
            {{-- BACK TO PROPERTY REQUESTS --}} 
 
            <div class="request-detail-header-actions"> 
 
                <a 
                    href="{{ route('owner.property-transactions.index') }}" 
                    class="back-request-btn" 
                > 
                    <i class="fa-solid fa-arrow-left"></i> 
                    Back to Property Requests 
                </a> 
 
            </div> 
 
        </div> 
 
 
        {{-- ===================================================== 
             CURRENT STATUS 
        ====================================================== --}} 
 
        <div class="mb-4"> 
 
            @if($transaction->status === 'pending') 
 
                <span class="request-status status-pending"> 
                    <span class="request-status-dot"></span> 
                    Pending 
                </span> 
 
            @elseif($transaction->status === 'approved') 
 
                <span class="request-status status-approved"> 
                    <span class="request-status-dot"></span> 
                    Approved 
                </span> 
 
            @elseif($transaction->status === 'completed') 
 
                <span class="request-status status-completed"> 
                    <span class="request-status-dot"></span> 
                    Completed 
                </span> 
 
            @elseif($transaction->status === 'rejected') 
 
                <span class="request-status status-rejected"> 
                    <span class="request-status-dot"></span> 
                    Rejected 
                </span> 
 
            @elseif($transaction->status === 'cancelled') 
 
                <span class="request-status status-cancelled"> 
                    <span class="request-status-dot"></span> 
                    Cancelled 
                </span> 
 
            @else 
 
                <span class="request-status status-default"> 
                    <span class="request-status-dot"></span> 
                    {{ ucfirst($transaction->status) }} 
                </span> 
 
            @endif 
 
        </div> 
 
 
        {{-- ===================================================== 
             TOP GRID 
        ====================================================== --}} 
 
        <div class="row g-4 mb-4"> 
 
 
            {{-- ================================================= 
                 PROPERTY CARD 
            ================================================== --}} 
 
            <div class="col-lg-8"> 
 
                <div class="request-card h-100"> 
 
                    @php 
 
                        $photos = is_array($transaction->property?->photos) 
                            ? $transaction->property->photos 
                            : []; 
 
                        $mainPhoto = $photos[0] ?? null; 
 
                    @endphp 
 
 
                    {{-- PROPERTY IMAGE --}} 
 
                    @if($mainPhoto) 
 
                        <img 
                            src="{{ asset('storage/' . $mainPhoto) }}" 
                            alt="{{ $transaction->property?->title }}" 
                            class="property-main-image" 
                        > 
 
                    @else 
 
                        <div class="property-image-placeholder"> 
 
                            <div class="text-center"> 
 
                                <i class="fa-solid fa-house fa-3x"></i> 
 
                                <p class="mt-3 mb-0 small"> 
                                    No property image 
                                </p> 
 
                            </div> 
 
                        </div> 
 
                    @endif 
 
 
                    {{-- PROPERTY INFO --}} 
 
                    <div class="request-card-body"> 
 
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-start gap-3"> 
 
                            <div> 
 
                                <div class="request-label"> 
                                    Property 
                                </div> 
 
                                <h2 class="h5 fw-bold text-dark mt-1 mb-1"> 
                                    {{ $transaction->property?->title ?? 'Property Deleted' }} 
                                </h2> 
 
                                @if($transaction->property?->address) 
 
                                    <p class="small text-secondary mb-0"> 
                                        <i class="fa-solid fa-location-dot text-primary me-1"></i> 
                                        {{ $transaction->property->address }} 
                                    </p> 
 
                                @endif 
 
                            </div> 
 
 
                            {{-- TYPE --}} 
 
                            @if($transaction->type === 'buy') 
 
                                <span class="request-type-badge buy-badge"> 
                                    <i class="fa-solid fa-house"></i> 
                                    Buy Request 
                                </span> 
 
                            @else 
 
                                <span class="request-type-badge rent-badge"> 
                                    <i class="fa-solid fa-key"></i> 
                                    Rent Request 
                                </span> 
 
                            @endif 
 
                        </div> 
 
 
                        {{-- PROPERTY DETAILS --}} 
 
                        @if($transaction->property) 
 
                            <div class="row g-3 mt-3"> 
 
                                {{-- PRICE --}} 
 
                                <div class="col-6 col-sm-3"> 
 
                                    <div class="request-stat"> 
 
                                        <div class="request-label"> 
                                            Listed Price 
                                        </div> 
 
                                        <div class="request-stat-value"> 
                                            ₹{{ number_format((float) $transaction->property->price, 2) }} 
                                        </div> 
 
                                    </div> 
 
                                </div> 
 
 
                                {{-- AREA --}} 
 
                                <div class="col-6 col-sm-3"> 
 
                                    <div class="request-stat"> 
 
                                        <div class="request-label"> 
                                            Area 
                                        </div> 
 
                                        <div class="request-stat-value"> 
                                            {{ $transaction->property->area ?? '—' }} 
                                        </div> 
 
                                    </div> 
 
                                </div> 
 
 
                                {{-- BEDROOMS --}} 
 
                                <div class="col-6 col-sm-3"> 
 
                                    <div class="request-stat"> 
 
                                        <div class="request-label"> 
                                            Bedrooms 
                                        </div> 
 
                                        <div class="request-stat-value"> 
                                            {{ $transaction->property->bedrooms ?? '—' }} 
                                        </div> 
 
                                    </div> 
 
                                </div> 
 
 
                                {{-- BATHROOMS --}} 
 
                                <div class="col-6 col-sm-3"> 
 
                                    <div class="request-stat"> 
 
                                        <div class="request-label"> 
                                            Bathrooms 
                                        </div> 
 
                                        <div class="request-stat-value"> 
                                            {{ $transaction->property->bathrooms ?? '—' }} 
                                        </div> 
 
                                    </div> 
 
                                </div> 
 
                            </div> 
 
                        @endif 
 
 
                        {{-- VIEW PROPERTY --}} 
 
                        @if($transaction->property) 
 
                            <div class="mt-4"> 
 
                                <a 
                                    href="{{ route('property.details', $transaction->property->slug) }}" 
                                    target="_blank" 
                                    class="request-link" 
                                > 
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> 
                                    View Property 
                                </a> 
 
                            </div> 
 
                        @endif 
 
                    </div> 
 
                </div> 
 
            </div> 
 
 
            {{-- ================================================= 
                 TRANSACTION SUMMARY 
            ================================================== --}} 
 
            <div class="col-lg-4"> 
 
                <div class="request-card h-100"> 
 
                    <div class="request-card-body"> 
 
                        <div class="d-flex align-items-center gap-3"> 
 
                            <div class="request-icon icon-indigo"> 
                                <i class="fa-solid fa-file-signature"></i> 
                            </div> 
 
                            <div> 
 
                                <h2 class="request-section-title h6"> 
                                    Transaction Summary 
                                </h2> 
 
                                <p class="request-section-subtitle mb-0"> 
                                    Request information 
                                </p> 
 
                            </div> 
 
                        </div> 
 
 
                        <div class="mt-4"> 
 
                            {{-- REQUEST ID --}} 
 
                            <div class="mb-4"> 
 
                                <div class="request-label"> 
                                    Request ID 
                                </div> 
 
                                <div class="request-value"> 
                                    #{{ $transaction->id }} 
                                </div> 
 
                            </div> 
 
 
                            {{-- TRANSACTION TYPE --}} 
 
                            <div class="mb-4"> 
 
                                <div class="request-label"> 
                                    Transaction Type 
                                </div> 
 
                                <div class="request-value"> 
                                    {{ ucfirst($transaction->type) }} 
                                </div> 
 
                            </div> 
 
 
                            {{-- LISTED PRICE --}} 
 
                            <div class="mb-4"> 
 
                                <div class="request-label"> 
                                    Listed Price 
                                </div> 
 
                                <div class="fs-4 fw-bold amount-emerald mt-1"> 
                                    ₹{{ number_format((float) $transaction->amount, 2) }} 
                                </div> 
 
                            </div> 
 
 
                            {{-- CUSTOMER OFFER --}} 
 
                            <div class="mb-4"> 
 
                                <div class="request-label"> 
                                    Customer Offer 
                                </div> 
 
                                @if($transaction->offer_amount !== null) 
 
                                    <div class="fs-5 fw-bold amount-purple mt-1"> 
                                        ₹{{ number_format((float) $transaction->offer_amount, 2) }} 
                                    </div> 
 
                                @else 
 
                                    <div class="small text-muted mt-1"> 
                                        Not offered 
                                    </div> 
 
                                @endif 
 
                            </div> 
 
 
                            {{-- COUNTER OFFER --}} 
 
                            <div class="mb-4"> 
 
                                <div class="request-label"> 
                                    Counter Offer 
                                </div> 
 
                                @if($transaction->counter_offer_amount !== null) 
 
                                    <div class="fs-5 fw-bold amount-amber mt-1"> 
                                        ₹{{ number_format((float) $transaction->counter_offer_amount, 2) }} 
                                    </div> 
 
                                @else 
 
                                    <div class="small text-muted mt-1"> 
                                        Not offered yet 
                                    </div> 
 
                                @endif 
 
                            </div> 
 
 
                            {{-- CREATED --}} 
 
                            <div class="mb-4"> 
 
                                <div class="request-label"> 
                                    Request Submitted 
                                </div> 
 
                                <div class="request-value"> 
                                    {{ $transaction->created_at?->format('d M Y, h:i A') }} 
                                </div> 
 
                            </div> 
 
 
                            {{-- UPDATED --}} 
 
                            <div> 
 
                                <div class="request-label"> 
                                    Last Updated 
                                </div> 
 
                                <div class="request-value"> 
                                    {{ $transaction->updated_at?->format('d M Y, h:i A') }} 
                                </div> 
 
                            </div> 
 
                        </div> 
 
                    </div> 
 
                </div> 
 
            </div> 
 
        </div> 
 
 
        {{-- ===================================================== 
             OFFER DETAILS 
        ====================================================== --}} 
 
        <div class="row g-4 mb-4"> 
 
            {{-- LISTED PRICE --}} 
 
            <div class="col-md-4"> 
 
                <div class="offer-box offer-listed shadow-sm"> 
 
                    <div class="d-flex align-items-center gap-3"> 
 
                        <div class="request-icon icon-emerald"> 
                            <i class="fa-solid fa-tag"></i> 
                        </div> 
 
                        <div> 
 
                            <div class="request-label"> 
                                Listed Price 
                            </div> 
 
                            <div class="offer-amount amount-emerald"> 
                                ₹{{ number_format((float) $transaction->amount, 2) }} 
                            </div> 
 
                        </div> 
 
                    </div> 
 
                </div> 
 
            </div> 
 
 
            {{-- CUSTOMER OFFER --}} 
 
            <div class="col-md-4"> 
 
                <div class="offer-box offer-customer shadow-sm"> 
 
                    <div class="d-flex align-items-center gap-3"> 
 
                        <div class="request-icon icon-purple"> 
                            <i class="fa-solid fa-hand-holding-dollar"></i> 
                        </div> 
 
                        <div> 
 
                            <div class="request-label"> 
                                Customer Offer 
                            </div> 
 
                            @if($transaction->offer_amount !== null) 
 
                                <div class="offer-amount amount-purple"> 
                                    ₹{{ number_format((float) $transaction->offer_amount, 2) }} 
                                </div> 
 
                            @else 
 
                                <div class="small text-muted mt-1"> 
                                    Not offered 
                                </div> 
 
                            @endif 
 
                        </div> 
 
                    </div> 
 
                </div> 
 
            </div> 
 
 
            {{-- COUNTER OFFER --}} 
 
            <div class="col-md-4"> 
 
                <div class="offer-box offer-counter shadow-sm"> 
 
                    <div class="d-flex align-items-center gap-3"> 
 
                        <div class="request-icon icon-amber"> 
                            <i class="fa-solid fa-money-bill-transfer"></i> 
                        </div> 
 
                        <div> 
 
                            <div class="request-label"> 
                                Counter Offer 
                            </div> 
 
                            @if($transaction->counter_offer_amount !== null) 
 
                                <div class="offer-amount amount-amber"> 
                                    ₹{{ number_format((float) $transaction->counter_offer_amount, 2) }} 
                                </div> 
 
                            @else 
 
                                <div class="small text-muted mt-1"> 
                                    Not offered yet 
                                </div> 
 
                            @endif 
 
                        </div> 
 
                    </div> 
 
                </div> 
 
            </div> 
 
        </div> 
 
 
        {{-- ===================================================== 
             ASSIGNED AGENT 
        ====================================================== --}} 
 
        @if($transaction->property?->agent) 
 
            <div class="agent-card shadow-sm mb-4"> 
 
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3"> 
 
                    <div class="d-flex align-items-center gap-3"> 
 
                        <div class="agent-avatar"> 
                            {{ strtoupper(substr($transaction->property->agent->name, 0, 1)) }} 
                        </div> 
 
                        <div> 
 
                            <div class="request-label"> 
                                Assigned Agent 
                            </div> 
 
                            <h2 class="h6 fw-bold text-dark mt-1 mb-1"> 
                                {{ $transaction->property->agent->name }} 
                            </h2> 
 
                            <p class="small text-muted mb-0"> 
                                {{ $transaction->property->agent->email }} 
                            </p> 
 
                        </div> 
 
                    </div> 
 
 
                    <div class="agent-badge"> 
 
                        <i class="fa-solid fa-user-tie"></i> 
 
                        Property Agent 
 
                    </div> 
 
                </div> 
 
            </div> 
 
        @else 
 
            <div class="request-card mb-4"> 
 
                <div class="request-card-body"> 
 
                    <div class="d-flex align-items-center gap-3"> 
 
                        <div class="request-icon icon-gray"> 
 
                            <i class="fa-solid fa-user-slash"></i> 
 
                        </div> 
 
                        <div> 
 
                            <div class="request-label"> 
                                Assigned Agent 
                            </div> 
 
                            <h2 class="h6 fw-bold text-secondary mt-1 mb-1"> 
                                No Agent Assigned 
                            </h2> 
 
                            <p class="small text-muted mb-0"> 
                                This property is currently managed directly by the owner. 
                            </p> 
 
                        </div> 
 
                    </div> 
 
                </div> 
 
            </div> 
 
        @endif 
 
 
        {{-- ===================================================== 
             COUNTER OFFER 
        ====================================================== --}} 
 
        @if(in_array($transaction->status, ['pending', 'approved'])) 
 
            <div class="request-card mb-4"> 
 
                <div class="request-card-body"> 
 
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3"> 
 
                        <div class="d-flex align-items-center gap-3"> 
 
                            <div class="request-icon icon-amber"> 
 
                                <i class="fa-solid fa-handshake"></i> 
 
                            </div> 
 
                            <div> 
 
                                <h2 class="request-section-title h6"> 
                                    Counter Offer 
                                </h2> 
 
                                <p class="request-section-subtitle mb-0"> 
                                    Send a counter price to the customer. 
                                </p> 
 
                            </div> 
 
                        </div> 
 
 
                        @if($transaction->counter_offer_amount !== null) 
 
                            <div class="rounded-3 border px-3 py-2 bg-light"> 
 
                                <div class="small text-muted"> 
                                    Current Counter Offer 
                                </div> 
 
                                <div class="fw-bold amount-amber"> 
                                    ₹{{ number_format((float) $transaction->counter_offer_amount, 2) }} 
                                </div> 
 
                            </div> 
 
                        @endif 
 
                    </div> 
 
 
                    <form 
                        action="{{ route('owner.property-transactions.counter-offer', $transaction) }}" 
                        method="POST" 
                        class="mt-4" 
                    > 
 
                        @csrf 
                        @method('PATCH') 
 
                        <div class="row g-3 align-items-end"> 
 
                            {{-- CUSTOMER OFFER --}} 
 
                            <div class="col-md-4"> 
 
                                <label class="form-label fw-semibold small"> 
                                    Customer Offer 
                                </label> 
 
                                <div class="form-control bg-light fw-semibold amount-purple"> 
 
                                    @if($transaction->offer_amount !== null) 
 
                                        ₹{{ number_format((float) $transaction->offer_amount, 2) }} 
 
                                    @else 
 
                                        Not offered 
 
                                    @endif 
 
                                </div> 
 
                            </div> 
 
 
                            {{-- COUNTER OFFER INPUT --}} 
 
                            <div class="col-md-4"> 
 
                                <label class="form-label fw-semibold small"> 
                                    Counter Offer Amount 
                                </label> 
 
                                <div class="counter-input-wrap"> 
 
                                    <span class="counter-input-symbol"> 
                                        ₹ 
                                    </span> 
 
                                    <input 
                                        type="number" 
                                        name="counter_offer_amount" 
                                        value="{{ old('counter_offer_amount', $transaction->counter_offer_amount) }}" 
                                        min="1" 
                                        step="0.01" 
                                        max="999999999999.99" 
                                        required 
                                        placeholder="Enter counter offer" 
                                        class="form-control counter-input" 
                                    > 
 
                                </div> 
 
                                @error('counter_offer_amount') 
 
                                    <div class="text-danger small mt-2"> 
                                        {{ $message }} 
                                    </div> 
 
                                @enderror 
 
                            </div> 
 
 
                            {{-- BUTTON --}} 
 
                            <div class="col-md-4"> 
 
                                <button 
                                    type="submit" 
                                    class="btn btn-amber w-100" 
                                > 
 
                                    <i class="fa-solid fa-paper-plane me-1"></i> 
 
                                    {{ $transaction->counter_offer_amount !== null 
                                        ? 'Update Counter Offer' 
                                        : 'Send Counter Offer' 
                                    }} 
 
                                </button> 
 
                            </div> 
 
                        </div> 
 
 
                        <div class="info-box info-amber mt-3"> 
 
                            <i class="fa-solid fa-circle-info mt-1"></i> 
 
                            <p class="mb-0"> 
 
                                The customer will be able to see this counter offer in their 
                                property request dashboard and request details. 
 
                            </p> 
 
                        </div> 
 
                    </form> 
 
                </div> 
 
            </div> 
 
        @endif 
 
 
        {{-- ===================================================== 
             APPLICANT + USER DETAILS 
        ====================================================== --}} 
 
        <div class="row g-4 mb-4"> 
 
            {{-- APPLICANT --}} 
 
            <div class="col-lg-6"> 
 
                <div class="request-card h-100"> 
 
                    <div class="request-card-body"> 
 
                        <div class="d-flex align-items-center gap-3"> 
 
                            <div class="request-icon icon-sky"> 
 
                                <i class="fa-solid fa-user"></i> 
 
                            </div> 
 
                            <div> 
 
                                <h2 class="request-section-title h6"> 
                                    Applicant Details 
                                </h2> 
 
                                <p class="request-section-subtitle mb-0"> 
                                    Information submitted with request 
                                </p> 
 
                            </div> 
 
                        </div> 
 
 
                        <div class="row g-4 mt-2"> 
 
                            {{-- NAME --}} 
 
                            <div class="col-sm-6"> 
 
                                <div class="request-label"> 
                                    Full Name 
                                </div> 
 
                                <div class="request-value"> 
                                    {{ $transaction->name }} 
                                </div> 
 
                            </div> 
 
 
                            {{-- EMAIL --}} 
 
                            <div class="col-sm-6"> 
 
                                <div class="request-label"> 
                                    Email 
                                </div> 
 
                                <div class="request-value text-break"> 
                                    {{ $transaction->email }} 
                                </div> 
 
                            </div> 
 
 
                            {{-- PHONE --}} 
 
                            <div class="col-sm-6"> 
 
                                <div class="request-label"> 
                                    Phone 
                                </div> 
 
                                <div class="request-value"> 
                                    {{ $transaction->phone }} 
                                </div> 
 
                            </div> 
 
 
                            {{-- USER ACCOUNT --}} 
 
                            <div class="col-sm-6"> 
 
                                <div class="request-label"> 
                                    User Account 
                                </div> 
 
                                @if($transaction->user) 
 
                                    <div class="request-value"> 
                                        {{ $transaction->user->name }} 
                                    </div> 
 
                                    <div class="small text-muted mt-1"> 
                                        User ID: #{{ $transaction->user->id }} 
                                    </div> 
 
                                @else 
 
                                    <div class="text-danger small mt-1"> 
                                        User not found 
                                    </div> 
 
                                @endif 
 
                            </div> 
 
                        </div> 
 
                    </div> 
 
                </div> 
 
            </div> 
 
 
            {{-- ADDRESS --}} 
 
            <div class="col-lg-6"> 
 
                <div class="request-card h-100"> 
 
                    <div class="request-card-body"> 
 
                        <div class="d-flex align-items-center gap-3"> 
 
                            <div class="request-icon icon-emerald"> 
 
                                <i class="fa-solid fa-location-dot"></i> 
 
                            </div> 
 
                            <div> 
 
                                <h2 class="request-section-title h6"> 
                                    Applicant Address 
                                </h2> 
 
                                <p class="request-section-subtitle mb-0"> 
                                    Address provided by applicant 
                                </p> 
 
                            </div> 
 
                        </div> 
 
 
                        <div class="mt-4"> 
 
                            {{-- ADDRESS --}} 
 
                            <div class="mb-4"> 
 
                                <div class="request-label"> 
                                    Address 
                                </div> 
 
                                <div class="request-muted mt-1"> 
                                    {{ $transaction->address ?: 'Not provided' }} 
                                </div> 
 
                            </div> 
 
 
                            <div class="row g-4"> 
 
                                {{-- CITY --}} 
 
                                <div class="col-sm-4"> 
 
                                    <div class="request-label"> 
                                        City 
                                    </div> 
 
                                    <div class="request-muted mt-1"> 
                                        {{ $transaction->city ?: '—' }} 
                                    </div> 
 
                                </div> 
 
 
                                {{-- STATE --}} 
 
                                <div class="col-sm-4"> 
 
                                    <div class="request-label"> 
                                        State 
                                    </div> 
 
                                    <div class="request-muted mt-1"> 
                                        {{ $transaction->state ?: '—' }} 
                                    </div> 
 
                                </div> 
 
 
                                {{-- PINCODE --}} 
 
                                <div class="col-sm-4"> 
 
                                    <div class="request-label"> 
                                        Pincode 
                                    </div> 
 
                                    <div class="request-muted mt-1"> 
                                        {{ $transaction->pincode ?: '—' }} 
                                    </div> 
 
                                </div> 
 
                            </div> 
 
                        </div> 
 
                    </div> 
 
                </div> 
 
            </div> 
 
        </div> 
 
 
        {{-- ===================================================== 
             STATUS MANAGEMENT 
        ====================================================== --}} 
 
        @if($transaction->status === 'cancelled') 
 
            {{-- CANCELLED REQUEST --}} 
 
            <div class="cancelled-box shadow-sm mb-4"> 
 
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3"> 
 
                    <div class="d-flex align-items-center gap-3"> 
 
                        <div class="request-icon icon-gray"> 
 
                            <i class="fa-solid fa-ban"></i> 
 
                        </div> 
 
                        <div> 
 
                            <h2 class="request-section-title h6"> 
                                Request Cancelled 
                            </h2> 
 
                            <p class="request-section-subtitle mb-0"> 
                                This request was cancelled by the user. 
                            </p> 
 
                        </div> 
 
                    </div> 
 
 
                    <span class="request-status status-cancelled"> 
 
                        <span class="request-status-dot"></span> 
 
                        Cancelled 
 
                    </span> 
 
                </div> 
 
 
                <div class="info-box info-gray mt-4"> 
 
                    <i class="fa-solid fa-circle-info mt-1"></i> 
 
                    <p class="mb-0"> 
 
                        This request is no longer active because the user cancelled it. 
                        The owner cannot modify the status of a cancelled request. 
 
                    </p> 
 
                </div> 
 
            </div> 
 
 
        @else 
 
            {{-- NORMAL STATUS MANAGEMENT --}} 
 
            <div class="request-card mb-4"> 
 
                <div class="request-card-body"> 
 
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3"> 
 
                        <div class="d-flex align-items-center gap-3"> 
 
                            <div class="request-icon icon-indigo"> 
 
                                <i class="fa-solid fa-sliders"></i> 
 
                            </div> 
 
                            <div> 
 
                                <h2 class="request-section-title h6"> 
                                    Manage Request 
                                </h2> 
 
                                <p class="request-section-subtitle mb-0"> 
                                    Update the status of this property request. 
                                </p> 
 
                            </div> 
 
                        </div> 
 
 
                        {{-- STATUS DESCRIPTION --}} 
 
                        <div class="small text-secondary"> 
 
                            @if($transaction->status === 'pending') 
 
                                Waiting for approval. 
 
                            @elseif($transaction->status === 'approved') 
 
                                Request approved. Transaction can now be completed. 
 
                            @elseif($transaction->status === 'completed') 
 
                                Transaction has been completed successfully. 
 
                            @elseif($transaction->status === 'rejected') 
 
                                This request has been rejected. 
 
                            @endif 
 
                        </div> 
 
                    </div> 
 
 
                    <form 
                        action="{{ route('owner.property-transactions.update-status', $transaction) }}" 
                        method="POST" 
                        class="mt-4" 
                    > 
 
                        @csrf 
                        @method('PATCH') 
 
                        <div class="row g-3"> 
 
                            {{-- STATUS --}} 
 
                            <div class="col-md-6"> 
 
                                <label class="form-label fw-semibold small"> 
                                    Request Status 
                                </label> 
 
                                <select 
                                    name="status" 
                                    required 
                                    class="form-select" 
                                > 
 
                                    <option 
                                        value="pending" 
                                        {{ $transaction->status === 'pending' ? 'selected' : '' }} 
                                    > 
                                        Pending 
                                    </option> 
 
                                    <option 
                                        value="approved" 
                                        {{ $transaction->status === 'approved' ? 'selected' : '' }} 
                                    > 
                                        Approved 
                                    </option> 
 
                                    <option 
                                        value="rejected" 
                                        {{ $transaction->status === 'rejected' ? 'selected' : '' }} 
                                    > 
                                        Rejected 
                                    </option> 
 
                                    <option 
                                        value="completed" 
                                        {{ $transaction->status === 'completed' ? 'selected' : '' }} 
                                    > 
                                        Completed 
                                    </option> 
 
                                </select> 
 
                                <p class="small text-muted mt-2 mb-0"> 
 
                                    Completing a Buy request marks the property as Sold. 
                                    Completing a Rent request marks the property as Rented. 
 
                                </p> 
 
                            </div> 
 
 
                            {{-- OWNER NOTE --}} 
 
                            <div class="col-md-6"> 
 
                                <label class="form-label fw-semibold small"> 
                                    Owner Note 
                                </label> 
 
                                <textarea 
                                    name="admin_note" 
                                    rows="4" 
                                    placeholder="Add a note about this request..." 
                                    class="form-control" 
                                >{{ old('admin_note', $transaction->admin_note) }}</textarea> 
 
                                @error('admin_note') 
 
                                    <div class="text-danger small mt-2"> 
                                        {{ $message }} 
                                    </div> 
 
                                @enderror 
 
                            </div> 
 
                        </div> 
 
 
                        {{-- WARNING --}} 
 
                        <div class="warning-box mt-4"> 
 
                            <i class="fa-solid fa-triangle-exclamation text-warning mt-1"></i> 
 
                            <div> 
 
                                <div class="warning-title"> 
                                    Important 
                                </div> 
 
                                <div class="warning-text"> 
 
                                    If you select 
                                    <strong>Completed</strong>, 
                                    the related property's status will automatically change to 
                                    <strong>Sold</strong> 
                                    for Buy or 
                                    <strong>Rented</strong> 
                                    for Rent. 
 
                                </div> 
 
                            </div> 
 
                        </div> 
 
 
                        {{-- SUBMIT --}} 
 
                        <div class="d-flex flex-column flex-sm-row justify-content-sm-end gap-2 mt-4"> 
 
                            <a 
                                href="{{ route('owner.property-transactions.index') }}" 
                                class="btn-back" 
                            > 
                                <i class="fa-solid fa-arrow-left"></i> 
                                Back 
                            </a> 
 
 
                            <button 
                                type="submit" 
                                class="btn-indigo" 
                            > 
                                <i class="fa-solid fa-floppy-disk me-1"></i> 
                                Update Status 
                            </button> 
 
                        </div> 
 
                    </form> 
 
                </div> 
 
            </div> 
 
        @endif 
 
 
        {{-- ===================================================== 
             OWNER / AGENT NOTE DISPLAY 
        ====================================================== --}} 
 
        @if($transaction->admin_note) 
 
            <div class="note-card shadow-sm"> 
 
                <div class="d-flex align-items-start gap-3"> 
 
                    <div class="request-icon icon-amber"> 
 
                        <i class="fa-solid fa-note-sticky"></i> 
 
                    </div> 
 
                    <div> 
 
                        <h3 class="h6 fw-bold text-dark mb-1"> 
                            Current Note 
                        </h3> 
 
                        <p class="small text-secondary mb-0" 
                           style="white-space: pre-line; line-height: 1.7;"> 
                            {{ $transaction->admin_note }} 
                        </p> 
 
                    </div> 
 
                </div> 
 
            </div> 
 
        @endif 
 
    </div> 
 
</div> 
 
@endsection