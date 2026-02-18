<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AffiliateProductResource\Pages;
use App\Filament\Resources\AffiliateProductResource\RelationManagers;
use App\Models\AffiliateProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AffiliateProductResource extends Resource
{
    protected static ?string $model = AffiliateProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->default(null),
                Forms\Components\Textarea::make('short_description')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('full_description')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('specifications')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price_min')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('price_max')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('images')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('whatsapp_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('whatsapp_message_template')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_available')
                    ->required(),
                Forms\Components\TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('views_count')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_min')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_max')
                    ->searchable(),
                Tables\Columns\TextColumn::make('whatsapp_number')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('views_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAffiliateProducts::route('/'),
            'create' => Pages\CreateAffiliateProduct::route('/create'),
            'edit' => Pages\EditAffiliateProduct::route('/{record}/edit'),
        ];
    }
}
