<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Hero;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\HeroResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\HeroResource\RelationManagers;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;

class HeroResource extends Resource
{
    protected static ?string $model = Hero::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    //add groiping to the filament menu
    protected static ?string $navigationGroup = 'Heroes Management';

    //order the navigation menu inside the group
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Section::make('Hero Details')
            ->description('Isikan Detail Hero Section')
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('title')

                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->maxLength(255),
                Split::make([
                    Forms\Components\TextInput::make('link1')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('link2')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Toggle::make('is_active')
                        ->inline(false)
                        ->required()
                ]),


            ]),
            Section::make('Hero Sub Title')
            ->description('Isikan Detail Hero Sub Title')
            ->schema([
                Repeater::make('heroSubTitles')
                ->relationship()
                ->schema([
                    TextInput::make('text')
                ])
            ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->wrap()
                    ->html()
                    ->searchable(),
            // Tables\Columns\IconColumn::make('is_active')
            //     ->boolean(),
            TextColumn::make('heroSubTitles.text')
                ->badge(),
            ToggleColumn::make('is_active')
                ->afterStateUpdated(function ($record, $state){
                    // dd($record, $state);
                    if ($state){
                        //set all other records to false
                        Hero::where('id', '!=', $record->id)->update(['is_active' => false]);
                    }
                })

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListHeroes::route('/'),
            'create' => Pages\CreateHero::route('/create'),
            'edit' => Pages\EditHero::route('/{record}/edit'),
        ];
    }
}
