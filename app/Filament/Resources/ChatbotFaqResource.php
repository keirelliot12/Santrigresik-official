<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChatbotFaqResource\Pages;
use App\Models\ChatbotFaq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ChatbotFaqResource extends Resource
{
    protected static ?string $model = ChatbotFaq::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Chatbot FAQ';

    protected static ?string $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question')
                    ->label('Pertanyaan')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('answer')
                    ->label('Jawaban')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
                Forms\Components\Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'layanan' => 'Layanan',
                        'portfolio' => 'Portfolio',
                        'proses' => 'Proses Kerja',
                        'harga' => 'Harga',
                        'kontak' => 'Kontak',
                        'umum' => 'Umum',
                    ])
                    ->default('umum')
                    ->required(),
                Forms\Components\TagsInput::make('keywords')
                    ->label('Kata Kunci')
                    ->hint('Tekan Enter untuk menambah kata kunci')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->label('Pertanyaan')
                    ->searchable()
                    ->limit(60),
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'layanan' => 'primary',
                        'portfolio' => 'info',
                        'proses' => 'warning',
                        'harga' => 'success',
                        'kontak' => 'gray',
                        default => 'secondary',
                    }),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'layanan' => 'Layanan',
                        'portfolio' => 'Portfolio',
                        'proses' => 'Proses Kerja',
                        'harga' => 'Harga',
                        'kontak' => 'Kontak',
                        'umum' => 'Umum',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChatbotFaqs::route('/'),
            'create' => Pages\CreateChatbotFaq::route('/create'),
            'edit' => Pages\EditChatbotFaq::route('/{record}/edit'),
        ];
    }
}
