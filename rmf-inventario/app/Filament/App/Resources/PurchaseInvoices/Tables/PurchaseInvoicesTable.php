<?php

namespace App\Filament\App\Resources\PurchaseInvoices\Tables;

use App\Models\StockMovement;
use App\Models\Warehouse;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class PurchaseInvoicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')
                    ->label('Nº Interno')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('supplier.name')
                    ->label('Proveedor')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('supplier_invoice_number')
                    ->label('Doc. Proveedor')
                    ->placeholder('N/A')
                    ->searchable(),

                TextColumn::make('date')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('total_amount')
                    ->label('Total Factura')
                    ->money('eur')
                    ->sortable()
                    ->summarize(\Filament\Tables\Columns\Summarizers\Sum::make()->label('Total General')),

                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'received' => 'success',
                        'paid' => 'info',
                    })
                    ->formatStateUsing(fn(string $state) => match ($state) {
                        'pending' => 'Pendiente',
                        'received' => 'Recibida (Stock OK)',
                        'paid' => 'Pagada',
                    }),

                TextColumn::make('total_amount')
                    ->label('Total Factura')
                    ->money('eur')
                    ->sortable()
                    ->summarize(
                        \Filament\Tables\Columns\Summarizers\Sum::make()
                            ->label('Total General')
                            ->money('eur')
                    ),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('receiveInvoice')
                    ->label('Recibir Mercancía')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Confirmar Entrada de Stock')
                    ->modalDescription('Selecciona el almacén donde se depositará la mercancía. Esto generará asientos automáticos de entrada.')
                    ->form([
                        Select::make('warehouse_id')
                            ->label('Almacén de Destino')
                            ->options(Warehouse::pluck('name', 'id'))
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        DB::transaction(function () use ($record, $data) {
                            foreach ($record->lines as $line) {
                                StockMovement::create([
                                    'company_id' => $record->company_id,
                                    'warehouse_id' => $data['warehouse_id'],
                                    'product_id' => $line->product_id,
                                    'quantity' => $line->quantity,
                                    'reference' => "Entrada por Factura #{$record->number}",
                                ]);
                            }

                            $record->update(['status' => 'received']);
                        });
                    })
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
