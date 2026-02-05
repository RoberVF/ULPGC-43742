<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Informe de Inventario - {{ $warehouse->name }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; font-size: 12px; }
        .header { border-bottom: 2px solid #444; padding-bottom: 10px; margin-bottom: 20px; }
        .company-name { font-size: 18px; font-weight: bold; text-transform: uppercase; }
        .report-title { text-align: center; font-size: 16px; margin: 20px 0; background: #f2f2f2; padding: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        th { background: #444; color: white; padding: 8px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        .footer { position: fixed; bottom: 0; width: 100%; font-size: 10px; text-align: center; border-top: 1px solid #ddd; padding-top: 5px; }
        .signature-box { margin-top: 50px; width: 100%; }
        .signature { width: 45%; border-top: 1px solid #000; display: inline-block; text-align: center; padding-top: 5px; margin: 0 2%; }
    </style>
</head>
<body>
    <div class="header">
        <table style="border: none;">
            <tr>
                <td style="border: none; width: 70%;">
                    <div class="company-name">{{ $company->name }}</div>
                    <div>CIF/NIF: {{ $company->tax_id ?? '---' }}</div>
                    <div>Almacén: {{ $warehouse->name }}</div>
                </td>
                <td style="border: none; width: 30%; text-align: right;">
                    <img src="{{ public_path('storage/'.$company->logo) }}" style="height: 60px;">
                </td>
            </tr>
        </table>
    </div>

    <div class="report-title">CERTIFICADO DE EXISTENCIAS DE INVENTARIO</div>

    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>PRODUCTO</th>
                <th>CATEGORÍA</th>
                <th style="text-align: right;">CANTIDAD</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td style="text-align: right;">{{ $product->local_stock }} uds</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-box">
        <div class="signature">Responsable de Almacén<br><small>(Firma y Sello)</small></div>
        <div class="signature">Auditor / Verificador<br><small>(Firma y Sello)</small></div>
    </div>

    <div class="footer">
        Documento generado el {{ now()->format('d/m/Y H:i') }} por el usuario {{ auth()->user()->name }}. <br>
        RMF Inventory Management System - Referencia: {{ strtoupper(Str::random(8)) }}
    </div>
</body>
</html>