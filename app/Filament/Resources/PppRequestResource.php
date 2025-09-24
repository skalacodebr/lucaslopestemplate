<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PppRequestResource\Pages;
use App\Models\PppRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class PppRequestResource extends Resource
{
    protected static ?string $model = PppRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Solicitações PPP';
    protected static ?string $navigationGroup = 'Solicitações';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Status e Preço')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pendente',
                                'processing' => 'Em Processamento',
                                'completed' => 'Concluída',
                                'cancelled' => 'Cancelada',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->label('Preço')
                            ->numeric()
                            ->prefix('R$')
                            ->step(0.01),
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Observações do Admin')
                            ->rows(3),
                        Forms\Components\DateTimePicker::make('processed_at')
                            ->label('Data de Processamento'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Empresa')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('employee_name')
                    ->label('Funcionário')
                    ->searchable(),
                Tables\Columns\TextColumn::make('request_reason')
                    ->label('Motivo')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'rescisao' => 'Rescisão',
                        'aposentadoria' => 'Aposentadoria',
                        'inss' => 'INSS',
                        'judicial' => 'Judicial',
                        'outros' => 'Outros',
                        default => $state,
                    }),
                Tables\Columns\IconColumn::make('is_urgent')
                    ->label('Urgente')
                    ->boolean(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Preço')
                    ->money('BRL'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'processing' => 'Em Processamento',
                        'completed' => 'Concluída',
                        'cancelled' => 'Cancelada',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default => 'secondary',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Solicitado em')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pendente',
                        'processing' => 'Em Processamento',
                        'completed' => 'Concluída',
                        'cancelled' => 'Cancelada',
                    ]),
                Tables\Filters\TernaryFilter::make('is_urgent')
                    ->label('Urgente'),
                Tables\Filters\SelectFilter::make('request_reason')
                    ->label('Motivo')
                    ->options([
                        'rescisao' => 'Rescisão',
                        'aposentadoria' => 'Aposentadoria',
                        'inss' => 'INSS',
                        'judicial' => 'Judicial',
                        'outros' => 'Outros',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('create_billing')
                    ->label('Criar Cobrança')
                    ->icon('heroicon-o-currency-dollar')
                    ->color('success')
                    ->visible(fn (PppRequest $record) => !$record->billings()->exists())
                    ->url(fn (PppRequest $record): string => route('filament.admin.resources.billings.create', [
                        'billable_type' => PppRequest::class,
                        'billable_id' => $record->id,
                        'user_id' => $record->user_id,
                        'amount' => $record->price,
                    ])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Dados da Empresa')
                    ->schema([
                        Infolists\Components\TextEntry::make('company_name')->label('Nome'),
                        Infolists\Components\TextEntry::make('cnpj')->label('CNPJ'),
                        Infolists\Components\TextEntry::make('company_phone')->label('Telefone'),
                        Infolists\Components\TextEntry::make('company_email')->label('E-mail'),
                    ])->columns(2),

                Infolists\Components\Section::make('Dados do Funcionário')
                    ->schema([
                        Infolists\Components\TextEntry::make('employee_name')->label('Nome'),
                        Infolists\Components\TextEntry::make('cpf')->label('CPF'),
                        Infolists\Components\TextEntry::make('birth_date')->label('Data de Nascimento')->date(),
                        Infolists\Components\TextEntry::make('job_position')->label('Cargo'),
                        Infolists\Components\TextEntry::make('admission_date')->label('Data de Admissão')->date(),
                        Infolists\Components\TextEntry::make('dismissal_date')->label('Data de Demissão')->date(),
                    ])->columns(2),

                Infolists\Components\Section::make('Dados da Solicitação')
                    ->schema([
                        Infolists\Components\TextEntry::make('request_reason')->label('Motivo'),
                        Infolists\Components\TextEntry::make('period_start')->label('Período Inicial')->date(),
                        Infolists\Components\TextEntry::make('period_end')->label('Período Final')->date(),
                        Infolists\Components\IconEntry::make('is_urgent')->label('Urgente')->boolean(),
                        Infolists\Components\TextEntry::make('urgency_reason')->label('Justificativa Urgência')->columnSpanFull(),
                        Infolists\Components\TextEntry::make('observations')->label('Observações')->columnSpanFull(),
                    ])->columns(2),

                Infolists\Components\Section::make('Controle e Preço')
                    ->schema([
                        Infolists\Components\TextEntry::make('status')->label('Status')->badge(),
                        Infolists\Components\TextEntry::make('price')->label('Preço')->money('BRL'),
                        Infolists\Components\TextEntry::make('admin_notes')->label('Observações do Admin'),
                        Infolists\Components\TextEntry::make('processed_at')->label('Processado em')->dateTime(),
                        Infolists\Components\TextEntry::make('created_at')->label('Solicitado em')->dateTime(),
                    ])->columns(2),
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
            'index' => Pages\ListPppRequests::route('/'),
            'create' => Pages\CreatePppRequest::route('/create'),
            'view' => Pages\ViewPppRequest::route('/{record}'),
            'edit' => Pages\EditPppRequest::route('/{record}/edit'),
        ];
    }
}