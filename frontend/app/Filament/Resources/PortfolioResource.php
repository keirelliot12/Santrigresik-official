<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Filament\Resources\PortfolioResource\RelationManagers;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->default(null),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('category')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('client_name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('client_industry')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('client_website')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('challenge')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('solution')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('results')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('content')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('thumbnail')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('client')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('url')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('project_url')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('year')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DatePicker::make('completion_date'),
                Forms\Components\Textarea::make('tags')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('technologies')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('color')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_featured')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
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
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_industry')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_website')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('thumbnail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('project_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->searchable(),
                Tables\Columns\TextColumn::make('completion_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}
