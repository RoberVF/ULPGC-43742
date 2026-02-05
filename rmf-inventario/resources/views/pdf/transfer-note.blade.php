<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 1cm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #1a1a1a;
            line-height: 1.5;
        }

        /* Encabezado */
        .header {
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .company-info {
            float: left;
            width: 60%;
        }

        .document-info {
            float: right;
            width: 35%;
            text-align: right;
        }

        .company-name {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .clearfix {
            clear: both;
        }

        .report-title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            background: #f0f0f0;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* Cajas de Origen y Destino */
        .logistics-table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: separate;
            border-spacing: 10px 0;
        }

        .logistics-box {
            width: 50%;
            border: 1px solid #999;
            padding: 15px;
            vertical-align: top;
            background: #fafafa;
        }

        .box-label {
            font-size: 9px;
            color: #666;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 8px;
            border-bottom: 1px solid #eee;
        }

        /* Tabla de Artículos */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .items-table th {
            background: #333;
            color: #fff;
            padding: 10px;
            text-align: left;
            border: 1px solid #333;
        }

        .items-table td {
            padding: 10px;
            border: 1px solid #eee;
        }

        .sku-cell {
            font-family: 'Courier', monospace;
            font-weight: bold;
            font-size: 12px;
        }

        /* Firmas */
        .signature-section {
            margin-top: 50px;
            width: 100%;
        }

        .signature-box {
            width: 45%;
            display: inline-block;
            text-align: center;
            border-top: 1px solid #000;
            margin: 0 2%;
            padding-top: 10px;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 9px;
            color: #888;
            text-align: center;
            border-top: 1px dotted #ccc;
            padding-top: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="company-info">
            <div class="company-name">{{ $company->name }}</div>
            <div>CIF: {{ $company->tax_id ?? '---' }}</div>
            <div>{{ $company->address ?? 'Sede Central de Operaciones' }}</div>
        </div>
        <div class="document-info">
            <strong>ALBARÁN DE TRANSFERENCIA</strong><br>
            Nº Documento: #TRF-{{ str_pad($transfer->id, 6, '0', STR_PAD_LEFT) }}<br>
            Fecha: {{ now()->format('d/m/Y H:i') }}
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="report-title">Orden de Movimiento de Inventario de Almacén</div>

    <table class="logistics-table">
        <tr>
            <td class="logistics-box">
                <div class="box-label">Expedido desde (Origen)</div>
                <strong>{{ $transfer->fromWarehouse->name }}</strong><br>
                {{ $transfer->fromWarehouse->location ?? 'Ubicación física registrada' }}
            </td>
            <td class="logistics-box">
                <div class="box-label">Consignado a (Destino)</div>
                <strong>{{ $transfer->toWarehouse->name }}</strong><br>
                {{ $transfer->toWarehouse->location ?? 'Ubicación física registrada' }}
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th width="25%">Referencia (SKU)</th>
                <th width="55%">Descripción del Producto</th>
                <th width="20%" style="text-align: right;">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="sku-cell">{{ $transfer->product->sku }}</td>
                <td>{{ $transfer->product->name }}</td>
                <td style="text-align: right;"><strong>{{ number_format($transfer->quantity, 2, ',', '.') }}
                        uds</strong></td>
            </tr>
        </tbody>
    </table>

    @if ($transfer->reference)
        <div style="padding: 15px; border: 1px dashed #ccc; background: #fff;">
            <strong>Observaciones / Instrucciones de transporte:</strong><br>
            {{ $transfer->reference }}
        </div>
    @endif

    <div class="signature-section">
        <div class="signature-box">
            SALIDA DE ALMACÉN<br>
            <small>(Firma y Sello Origen)</small>
        </div>
        <div class="signature-box">
            RECEPCIÓN DE MERCANCÍA<br>
            <small>(Firma y Sello Destino)</small>
        </div>
    </div>
{{-- 
    <div style="position: absolute; bottom: 20px; right: 0; text-align: center; width: 120px;">
        <img src="data:image/svg+xml;base64,{{ $qrCode }}" style="width: 100px; height: 100px;">
        <div style="font-size: 8px; color: #666; margin-top: 5px; text-transform: uppercase;">
            Validación Digital<br>Documento Seguro
        </div>
    </div> --}}

    <div class="footer">
        Este documento es un comprobante interno de transferencia de activos. <br>
        Generado por: {{ auth()->user()->name }} | Sistema de Auditoría de Inventario RMF
    </div>
</body>

</html>
