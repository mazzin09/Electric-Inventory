<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Forms;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory;
use Illuminate\Support\Str;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $transaction = static::getModel()::create($data);
        $inventory = Inventory::where('item_id', $data['item_id'])->first();
        if(Str::lower($data['transaction_type']) === 'purchase' ){
            $inventory->update([
                'quantity' => $inventory->quantity + $data['quantity']
            ]);
        }

        if(Str::lower($data['transaction_type']) === 'sale' ){
            $inventory->update([
                'quantity' => $inventory->quantity - $data['quantity']
            ]);
        }

        return $transaction;
    }
}
