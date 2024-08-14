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
use App\Models\Item;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $total_amount = 0;
        $item = Item::find($data['item_id']);
        if(Str::lower($data['transaction_type']) === 'purchase' ){
            $total_amount = $data['quantity'] * $item->cost_price;
        }
        if(Str::lower($data['transaction_type']) === 'sale' ){
            $total_amount = $data['quantity'] * $item->selling_price;
        }

        $transaction = static::getModel()::create([
            'total_amount' => $total_amount,
            'transaction_type' => $data['transaction_type'],
            'item_id' => $data['item_id'],
            'quantity' => $data['quantity'],
        ]);
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
