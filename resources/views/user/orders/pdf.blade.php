<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@lang('pdf.order') #{{ $viewData['order']->getId() }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #1E3A8A;
        }

        .header h1 {
            color: #1E3A8A;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header .app-name {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
        }

        .order-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #1E3A8A;
        }

        .order-info h2 {
            color: #1E3A8A;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .info-grid {
            display: table;
            width: 100%;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            font-weight: bold;
            padding: 5px 10px 5px 0;
            width: 30%;
            color: #555;
        }

        .info-value {
            display: table-cell;
            padding: 5px 0;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 10px;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        h3 {
            color: #1E3A8A;
            font-size: 14px;
            margin: 25px 0 15px 0;
            padding-bottom: 5px;
            border-bottom: 2px solid #e0e0e0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: white;
        }

        th {
            background-color: #1E3A8A;
            color: white;
            padding: 10px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
        }

        td {
            border: 1px solid #ddd;
            padding: 10px 8px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total-section {
            margin-top: 20px;
            text-align: right;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .total-label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #1E3A8A;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e0e0e0;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .footer .thank-you {
            font-size: 12px;
            color: #1E3A8A;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .product-name {
            font-weight: bold;
            color: #333;
        }

        .product-desc {
            font-size: 9px;
            color: #666;
            margin-top: 2px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="app-name">{{ config('app.name') }}</div>
        <h1>@lang('pdf.order') #{{ $viewData['order']->getId() }}</h1>
    </div>

    <div class="order-info">
        <h2>@lang('pdf.orderDetails')</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">@lang('pdf.date'):</div>
                <div class="info-value">{{ $viewData['order']->getCreatedAt()->format('d/m/Y H:i') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">@lang('pdf.status'):</div>
                <div class="info-value">
                    @php
                        $status = strtolower($viewData['order']->getStatus());
                        $statusClass = 'status-pending';
                        if ($status === 'completed' || $status === 'paid') {
                            $statusClass = 'status-completed';
                        }
                        if ($status === 'cancelled' || $status === 'refunded') {
                            $statusClass = 'status-cancelled';
                        }
                    @endphp
                    <span class="status-badge {{ $statusClass }}">{{ ucfirst($viewData['order']->getStatus()) }}</span>
                </div>
            </div>
            <div class="info-row">
                <div class="info-label">@lang('pdf.user'):</div>
                <div class="info-value">{{ $viewData['order']->user->getUsername() }}</div>
            </div>
        </div>
    </div>

    <h3>@lang('pdf.items')</h3>
    <table>
        <thead>
            <tr>
                <th style="width: 50%;">@lang('pdf.product')</th>
                <th class="text-center" style="width: 15%;">@lang('pdf.quantity')</th>
                <th class="text-right" style="width: 17.5%;">@lang('pdf.unitPrice')</th>
                <th class="text-right" style="width: 17.5%;">@lang('pdf.subtotal')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($viewData['items'] as $item)
                <tr>
                    <td>
                        <div class="product-name">{{ $item->product->getName() }}</div>
                        @if ($item->product->getDescription())
                            <div class="product-desc">{{ Str::limit($item->product->getDescription(), 100) }}</div>
                        @endif
                    </td>
                    <td class="text-center">{{ $item->getQuantity() }}</td>
                    <td class="text-right">${{ $item->getFormattedUnitPrice() }}</td>
                    <td class="text-right" style="font-weight: bold;">${{ $item->getFormattedSubtotal() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-label">@lang('pdf.total'):</div>
        <div class="total-amount">${{ $viewData['order']->getFormattedTotal() }}</div>
    </div>

    <div class="footer">
        <div class="thank-you">@lang('pdf.thankYou')</div>
        <div>{{ config('app.name') }} &copy; {{ date('Y') }}</div>
        <div>@lang('pdf.generatedAt'): {{ now()->format('d/m/Y H:i:s') }}</div>
    </div>
</body>

</html>
