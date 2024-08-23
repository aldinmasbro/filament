<?php

namespace App\Filament\Resources\HeroResource\Pages;

use App\Filament\Resources\HeroResource;
use App\Models\Hero;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHero extends EditRecord
{
    protected static string $resource = HeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    //redirect to index page after edit
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    //add before create hooks
    protected function beforeSave(): void
    {
        //dd($this->data);
        //if is_active is true then set all record to false
        if ($this->data['is_active']){
            Hero::where('id', '!=', $this->data['id'])->update(['is_active'=>0]);
        }
    }
}
