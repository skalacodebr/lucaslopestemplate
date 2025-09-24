<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillingResource\Pages;
use App\Models\Billing;
use App\Models\User;
use App\Models\CatRequest;
use App\Models\PppRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;

class BillingResource extends Resource
{
    protected static ?string $model = Billing::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Cobranças';
    protected static ?string $navigationGroup = 'Financeiro';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações da Cobrança')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Cliente')
                            ->options(User::where('role', 'client')->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('billable_id', null)),

                        Forms\Components\TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->placeholder('Ex: PPP - João Silva'),

                        Forms\Components\Textarea::make('description')
                            ->label('Descrição')
                            ->rows(2),

                        Forms\Components\TextInput::make('amount')
                            ->label('Valor')
                            ->numeric()
                            ->prefix('R$')
                            ->step(0.01)
                            ->required(),

                        Forms\Components\DatePicker::make('due_date')
                            ->label('Data de Vencimento')
                            ->required()
                            ->default(now()->addDays(30)),
                    ])->columns(2),

                Forms\Components\Section::make('Relacionamento (Opcional)')
                    ->schema([
                        Forms\Components\Select::make('billable_type')
                            ->label('Tipo de Serviço')
                            ->options([
                                CatRequest::class => 'Solicitação CAT',
                                PppRequest::class => 'Solicitação PPP',
                            ])
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('billable_id', null)),

                        Forms\Components\Select::make('billable_id')
                            ->label('Solicitação')
                            ->options(function (callable $get) {
                                $type = $get('billable_type');
                                $userId = $get('user_id');

                                if (!$type || !$userId) {
                                    return [];
                                }

                                if ($type === CatRequest::class) {
                                    return CatRequest::where('user_id', $userId)
                                        ->get()
                                        ->pluck('employee_name', 'id');
                                }

                                if ($type === PppRequest::class) {
                                    return PppRequest::where('user_id', $userId)
                                        ->get()
                                        ->pluck('employee_name', 'id');
                                }

                                return [];
                            })
                            ->reactive()
                            ->disabled(fn (callable $get) => !$get('billable_type') || !$get('user_id')),
                    ])->columns(2),

                Forms\Components\Section::make('Status e Controle')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pendente',
                                'paid' => 'Pago',
                                'overdue' => 'Vencida',
                                'cancelled' => 'Cancelada',
                            ])
                            ->required()
                            ->default('pending'),

                        Forms\Components\Select::make('payment_method')
                            ->label('Método de Pagamento')
                            ->options([
                                'pix' => 'PIX',
                                'boleto' => 'Boleto',
                                'cartao' => 'Cartão',
                                'dinheiro' => 'Dinheiro',
                                'transferencia' => 'Transferência',
                            ]),

                        Forms\Components\DatePicker::make('paid_at')
                            ->label('Data do Pagamento')
                            ->visible(fn (callable $get) => $get('status') === 'paid'),

                        Forms\Components\TextInput::make('payment_reference')
                            ->label('Referência do Pagamento')
                            ->placeholder('ID da transação, código do boleto, etc.'),

                        Forms\Components\Textarea::make('payment_notes')
                            ->label('Observações do Pagamento')
                            ->rows(2),

                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Observações Internas')
                            ->rows(2),

                        Forms\Components\DateTimePicker::make('sent_at')
                            ->label('Enviado ao Cliente em'),
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

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Valor')
                    ->money('BRL')
                    ->sortable(),

                Tables\Columns\TextColumn::make('due_date')
                    ->label('Vencimento')
                    ->date()
                    ->sortable()
                    ->color(fn (Billing $record): string => $record->isOverdue() ? 'danger' : 'primary'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'paid' => 'Pago',
                        'overdue' => 'Vencida',
                        'cancelled' => 'Cancelada',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'overdue' => 'danger',
                        'cancelled' => 'secondary',
                        default => 'secondary',
                    }),

                Tables\Columns\TextColumn::make('billable_type')
                    ->label('Tipo')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        CatRequest::class => 'CAT',
                        PppRequest::class => 'PPP',
                        default => '-',
                    }),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Pagamento')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'pix' => 'PIX',
                        'boleto' => 'Boleto',
                        'cartao' => 'Cartão',
                        'dinheiro' => 'Dinheiro',
                        'transferencia' => 'Transferência',
                        default => '-',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criada em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pendente',
                        'paid' => 'Pago',
                        'overdue' => 'Vencida',
                        'cancelled' => 'Cancelada',
                    ]),

                Tables\Filters\SelectFilter::make('payment_method')
                    ->label('Método de Pagamento')
                    ->options([
                        'pix' => 'PIX',
                        'boleto' => 'Boleto',
                        'cartao' => 'Cartão',
                        'dinheiro' => 'Dinheiro',
                        'transferencia' => 'Transferência',
                    ]),

                Tables\Filters\Filter::make('overdue')
                    ->label('Vencidas')
                    ->query(fn (Builder $query): Builder =>
                        $query->where('status', 'pending')
                              ->where('due_date', '<', now())
                    ),

                Tables\Filters\Filter::make('this_month')
                    ->label('Este Mês')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereMonth('created_at', now()->month)
                              ->whereYear('created_at', now()->year)
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('mark_as_paid')
                    ->label('Marcar como Pago')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Billing $record): bool => $record->status === 'pending')
                    ->action(function (Billing $record, array $data): void {
                        $record->update([
                            'status' => 'paid',
                            'paid_at' => now()->toDateString(),
                        ]);
                    }),

                Tables\Actions\Action::make('send_to_client')
                    ->label('Enviar ao Cliente')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('info')
                    ->requiresConfirmation()
                    ->visible(fn (Billing $record): bool => !$record->sent_at)
                    ->action(function (Billing $record): void {
                        $record->update(['sent_at' => now()]);
                        // Aqui você pode implementar o envio por e-mail
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    Tables\Actions\BulkAction::make('mark_as_sent')
                        ->label('Marcar como Enviadas')
                        ->icon('heroicon-o-paper-airplane')
                        ->requiresConfirmation()
                        ->action(function ($records): void {
                            $records->each(fn (Billing $record) =>
                                $record->update(['sent_at' => now()])
                            );
                        }),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informações da Cobrança')
                    ->schema([
                        Infolists\Components\TextEntry::make('user.name')->label('Cliente'),
                        Infolists\Components\TextEntry::make('title')->label('Título'),
                        Infolists\Components\TextEntry::make('description')->label('Descrição'),
                        Infolists\Components\TextEntry::make('amount')->label('Valor')->money('BRL'),
                        Infolists\Components\TextEntry::make('due_date')->label('Vencimento')->date(),
                        Infolists\Components\TextEntry::make('status')->label('Status')->badge(),
                    ])->columns(2),

                Infolists\Components\Section::make('Relacionamento')
                    ->schema([
                        Infolists\Components\TextEntry::make('billable_type')
                            ->label('Tipo de Serviço')
                            ->formatStateUsing(fn (?string $state): string => match ($state) {
                                CatRequest::class => 'Solicitação CAT',
                                PppRequest::class => 'Solicitação PPP',
                                default => 'Nenhum',
                            }),
                        Infolists\Components\TextEntry::make('billable.employee_name')
                            ->label('Funcionário Relacionado')
                            ->default('N/A'),
                    ])->columns(2),

                Infolists\Components\Section::make('Pagamento')
                    ->schema([
                        Infolists\Components\TextEntry::make('payment_method')->label('Método'),
                        Infolists\Components\TextEntry::make('paid_at')->label('Pago em')->date(),
                        Infolists\Components\TextEntry::make('payment_reference')->label('Referência'),
                        Infolists\Components\TextEntry::make('payment_notes')->label('Observações do Pagamento'),
                    ])->columns(2),

                Infolists\Components\Section::make('Controle')
                    ->schema([
                        Infolists\Components\TextEntry::make('sent_at')->label('Enviado em')->dateTime(),
                        Infolists\Components\TextEntry::make('admin_notes')->label('Observações Internas'),
                        Infolists\Components\TextEntry::make('created_at')->label('Criada em')->dateTime(),
                        Infolists\Components\TextEntry::make('updated_at')->label('Atualizada em')->dateTime(),
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
            'index' => Pages\ListBillings::route('/'),
            'create' => Pages\CreateBilling::route('/create'),
            'view' => Pages\ViewBilling::route('/{record}'),
            'edit' => Pages\EditBilling::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            // Você pode criar widgets de estatísticas aqui
        ];
    }
}