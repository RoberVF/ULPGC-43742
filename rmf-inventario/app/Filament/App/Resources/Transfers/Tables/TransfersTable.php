<?php

namespace App\Filament\App\Resources\Transfers\Tables;

use App\Filament\App\Resources\Transfers\TransferResource;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransfersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('product.name')
                    ->label('Producto')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('fromWarehouse.name')
                    ->label('Origen')
                    ->badge()
                    ->color('danger'),

                // Un pequeño detalle visual para indicar la dirección
                TextColumn::make('separator')
                    ->label('')
                    ->default('➜')
                    ->alignCenter(),

                TextColumn::make('toWarehouse.name')
                    ->label('Destino')
                    ->badge()
                    ->color('success'),

                TextColumn::make('quantity')
                    ->label('Cantidad')
                    ->numeric()
                    ->weight('bold')
                    ->alignRight(),

                TextColumn::make('user.name')
                    ->label('Usuario')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('reference')
                    ->label('Referencia')
                    ->limit(20)
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Action::make('downloadDeliveryNote')
                    ->label('Albarán de Envío')
                    ->icon('heroicon-o-truck')
                    ->color('info')
                    ->action(function ($record) {
                        $pdf = Pdf::loadView('pdf.transfer-note', [
                            'transfer' => $record,
                            'company' => filament()->getTenant(),
                        ]);

                        return response()->streamDownload(
                            fn() => print($pdf->output()),
                            "Albaran-TRF-{$record->id}.pdf"
                        );
                    })
                // ->action(function ($record) {
                //     $company = filament()->getTenant();

                //     $verificationUrl = TransferResource::getUrl('index', tenant: $company);

                //     $qrCode = base64_encode(QrCode::format('svg')
                //         ->size(120)
                //         ->margin(1)
                //         ->generate($verificationUrl));

                //     $pdf = Pdf::loadView('pdf.transfer-note', [
                //         'transfer' => $record,
                //         'company' => $company,
                //         'qrCode' => $qrCode,
                //     ]);

                //     return response()->streamDownload(
                //         fn() => print($pdf->output()),
                //         "Albaran-TRF-{$record->id}.pdf"
                //     );
                // })
            ]);
    }
}
