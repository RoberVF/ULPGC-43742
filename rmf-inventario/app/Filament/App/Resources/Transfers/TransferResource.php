<?php

namespace App\Filament\App\Resources\Transfers;

use App\Filament\App\Resources\Transfers\Pages\CreateTransfer;
use App\Filament\App\Resources\Transfers\Pages\EditTransfer;
use App\Filament\App\Resources\Transfers\Pages\ListTransfers;
use App\Filament\App\Resources\Transfers\Schemas\TransferForm;
use App\Filament\App\Resources\Transfers\Tables\TransfersTable;
use App\Models\Transfer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TransferResource extends Resource
{
    protected static ?string $model = Transfer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowsUpDown;

    protected static ?string $recordTitleAttribute = 'Transfers';

    public static function form(Schema $schema): Schema
    {
        return TransferForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransfersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTransfers::route('/'),
            'create' => CreateTransfer::route('/create'),
            'edit' => EditTransfer::route('/{record}/edit'),
        ];
    }
}
