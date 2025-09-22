<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionalProfileResource\Pages;
use App\Filament\Resources\ProfessionalProfileResource\RelationManagers;
use App\Models\ProfessionalProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProfessionalProfileResource extends Resource
{
    protected static ?string $model = ProfessionalProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('license_number')
                    ->required(),
                Forms\Components\TextInput::make('license_type')
                    ->required(),
                Forms\Components\TextInput::make('specialty')
                    ->required(),
                Forms\Components\Textarea::make('subspecialties')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('bio')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('years_experience')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Textarea::make('education')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('certifications')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('languages')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('consultation_fee')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('rating')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('total_reviews')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_verified')
                    ->required(),
                Forms\Components\Toggle::make('is_available')
                    ->required(),
                Forms\Components\Textarea::make('availability_schedule')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('max_daily_consultations')
                    ->required()
                    ->numeric()
                    ->default(10),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\DateTimePicker::make('verified_at'),
                Forms\Components\DateTimePicker::make('last_active_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('license_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('license_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('specialty')
                    ->searchable(),
                Tables\Columns\TextColumn::make('years_experience')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('consultation_fee')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_reviews')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_verified')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean(),
                Tables\Columns\TextColumn::make('max_daily_consultations')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('verified_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_active_at')
                    ->dateTime()
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
            'index' => Pages\ListProfessionalProfiles::route('/'),
            'create' => Pages\CreateProfessionalProfile::route('/create'),
            'edit' => Pages\EditProfessionalProfile::route('/{record}/edit'),
        ];
    }
}
