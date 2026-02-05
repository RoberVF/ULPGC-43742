<?php

namespace App\Filament\App\Resources\Warehouses\Tables;

use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class WarehousesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Almacén')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('location')
                    ->label('Ubicación')
                    ->limit(30),

                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),
            ])
            ->actions([
                Action::make('downloadReport')
                    ->label('Informe Legal')
                    ->icon('heroicon-o-document-check')
                    ->color('success')
                    ->action(function ($record) {
                        $company = filament()->getTenant();

                        // Obtenemos los productos con stock filtrado (reutilizamos tu lógica Pro)
                        $products = \App\Models\Product::query()
                            ->withSum(['stockMovements as local_stock' => function ($query) use ($record) {
                                $query->where('warehouse_id', $record->id);
                            }], 'quantity')
                            ->having('local_stock', '>', 0) // Solo lo que hay físicamente
                            ->get();

                        $pdf = Pdf::loadView('pdf.inventory-report', [
                            'warehouse' => $record,
                            'company' => $company,
                            'products' => $products,
                        ]);

                        return response()->streamDownload(fn() => print($pdf->output()), "Informe-Inventario-{$record->name}.pdf");
                    })
            ]);
    }
}
