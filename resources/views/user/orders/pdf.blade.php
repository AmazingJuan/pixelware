<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@lang('pdf.order'){{ $viewData['order']->getId() }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <h2>@lang('pdf.order'){{ $viewData['order']->getId() }}</h2>
    <p><strong>@lang('pdf.date'):</strong> {{ $viewData['order']->getCreatedAt()->format('Y-m-d H:i') }}</p>
    <p><strong>@lang('pdf.status'):</strong> {{ ucfirst($viewData['order']->getStatus()) }}</p>
    <p><strong>@lang('pdf.total'):</strong> ${{ $viewData['order']->getFormattedTotal() }}</p>
    <p><strong>@lang('pdf.user'):</strong> {{ $viewData['order']->user->getUsername() }}</p>

    <h3>@lang('pdf.items')</h3>
    <table>
        <thead>
            <tr>
                <th>@lang('pdf.product')</th>
                <th>@lang('pdf.quantity')</th>
                <th>@lang('pdf.unitPrice')</th>
                <th>@lang('pdf.subtotal')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($viewData['items'] as $item)
                <tr>
                    <td>{{ $item->product->getName() }}</td>
                    <td>{{ $item->getQuantity() }}</td>
                    <td>${{ $item->getFormattedUnitPrice() }}</td>
                    <td>${{ $item->getFormattedSubtotal() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
