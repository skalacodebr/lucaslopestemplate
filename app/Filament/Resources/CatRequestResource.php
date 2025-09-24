<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatRequestResource\Pages;
use App\Models\CatRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class CatRequestResource extends Resource
{
    protected static ?string $model = CatRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';
    protected static ?string $navigationLabel = 'Solicitações CAT';
    protected static ?string $navigationGroup = 'Solicitações';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Status')
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
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Observações do Admin')
                            ->rows(3),
                        Forms\Components\DateTimePicker::make('processed_at')
                            ->label('Data de Processamento'),
                    ]),
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
                Tables\Columns\TextColumn::make('accident_date')
                    ->label('Data do Acidente')
                    ->date()
                    ->sortable(),
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
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('create_billing')
                    ->label('Criar Cobrança')
                    ->icon('heroicon-o-currency-dollar')
                    ->color('success')
                    ->visible(fn (CatRequest $record) => !$record->billings()->exists())
                    ->url(fn (CatRequest $record): string => route('filament.admin.resources.billings.create', [
                        'billable_type' => CatRequest::class,
                        'billable_id' => $record->id,
                        'user_id' => $record->user_id,
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
                        Infolists\Components\TextEntry::make('company_address')->label('Endereço'),
                    ])->columns(2),

                Infolists\Components\Section::make('Dados do Acidentado')
                    ->schema([
                        Infolists\Components\TextEntry::make('employee_name')->label('Nome'),
                        Infolists\Components\TextEntry::make('cpf')->label('CPF'),
                        Infolists\Components\TextEntry::make('birth_date')->label('Data de Nascimento')->date(),
                        Infolists\Components\TextEntry::make('job_position')->label('Cargo'),
                        Infolists\Components\TextEntry::make('admission_date')->label('Data de Admissão')->date(),
                        Infolists\Components\TextEntry::make('employee_phone')->label('Telefone'),
                    ])->columns(2),

                Infolists\Components\Section::make('Dados do Acidente')
                    ->schema([
                        Infolists\Components\TextEntry::make('accident_date')->label('Data')->date(),
                        Infolists\Components\TextEntry::make('accident_time')->label('Horário'),
                        Infolists\Components\TextEntry::make('accident_location')->label('Local'),
                        Infolists\Components\TextEntry::make('injury_type')->label('Tipo de Lesão'),
                        Infolists\Components\TextEntry::make('injured_body_part')->label('Parte do Corpo'),
                        Infolists\Components\TextEntry::make('accident_description')->label('Descrição')->columnSpanFull(),
                        Infolists\Components\TextEntry::make('witnesses')->label('Testemunhas')->columnSpanFull(),
                    ])->columns(2),

                Infolists\Components\Section::make('Atendimento Médico')
                    ->schema([
                        Infolists\Components\IconEntry::make('medical_care')
                            ->label('Recebeu atendimento médico?')
                            ->boolean(),
                        Infolists\Components\TextEntry::make('hospital_name')->label('Hospital'),
                        Infolists\Components\TextEntry::make('doctor_name')->label('Médico'),
                        Infolists\Components\TextEntry::make('medical_report')->label('Relatório Médico')->columnSpanFull(),
                    ])->columns(2),

                Infolists\Components\Section::make('Controle')
                    ->schema([
                        Infolists\Components\TextEntry::make('status')->label('Status')->badge(),
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
            'index' => Pages\ListCatRequests::route('/'),
            'create' => Pages\CreateCatRequest::route('/create'),
            'view' => Pages\ViewCatRequest::route('/{record}'),
            'edit' => Pages\EditCatRequest::route('/{record}/edit'),
        ];
    }
}