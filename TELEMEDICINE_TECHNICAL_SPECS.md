# Telemedicine Platform - Technical Specifications

## Key Implementation Examples

### 1. Database Migration Example - Consultations

```php
// database/migrations/2024_01_01_000001_create_consultations_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('patient_id')->constrained('users');
            $table->foreignId('professional_id')->constrained('professionals');
            $table->foreignId('specialty_id')->nullable()->constrained();
            $table->enum('consultation_type', ['video', 'voice', 'chat']);
            $table->dateTime('scheduled_at');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->enum('status', [
                'scheduled', 'confirmed', 'in_progress',
                'completed', 'cancelled', 'no_show'
            ])->default('scheduled');
            $table->text('cancellation_reason')->nullable();
            $table->foreignId('cancelled_by')->nullable()->constrained('users');
            $table->dateTime('cancelled_at')->nullable();
            $table->string('agora_channel_id')->nullable();
            $table->text('agora_token')->nullable();
            $table->string('recording_url')->nullable();
            $table->text('chief_complaint')->nullable();
            $table->json('notes')->nullable();
            $table->foreignId('prescription_id')->nullable();
            $table->boolean('follow_up_required')->default(false);
            $table->integer('rating')->nullable();
            $table->text('feedback')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_applied', 10, 2)->default(0);
            $table->foreignId('payment_id')->nullable();
            $table->timestamps();

            $table->index(['patient_id', 'scheduled_at']);
            $table->index(['professional_id', 'scheduled_at']);
            $table->index(['status', 'scheduled_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
```

### 2. Consultation Model with Relationships

```php
// app/Models/Consultation.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Consultation extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'uuid', 'patient_id', 'professional_id', 'specialty_id',
        'consultation_type', 'scheduled_at', 'started_at', 'ended_at',
        'duration_minutes', 'status', 'cancellation_reason',
        'cancelled_by', 'cancelled_at', 'agora_channel_id',
        'agora_token', 'recording_url', 'chief_complaint',
        'notes', 'prescription_id', 'follow_up_required',
        'rating', 'feedback', 'price', 'discount_applied', 'payment_id'
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'notes' => 'array',
        'follow_up_required' => 'boolean',
        'price' => 'decimal:2',
        'discount_applied' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($consultation) {
            $consultation->uuid = Str::uuid();
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['status', 'scheduled_at', 'cancelled_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }

    public function specialty(): BelongsTo
    {
        return $this->belongsTo(Specialty::class);
    }

    public function prescription(): HasOne
    {
        return $this->hasOne(Prescription::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ConsultationDocument::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'payment_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'scheduled')
            ->where('scheduled_at', '>', now())
            ->orderBy('scheduled_at');
    }

    public function scopeForPatient($query, $patientId)
    {
        return $query->where('patient_id', $patientId);
    }

    public function scopeForProfessional($query, $professionalId)
    {
        return $query->where('professional_id', $professionalId);
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['scheduled', 'confirmed'])
            && $this->scheduled_at->isFuture();
    }

    public function canJoin(): bool
    {
        $bufferMinutes = 15;
        return $this->status === 'confirmed'
            && now()->diffInMinutes($this->scheduled_at, false) <= $bufferMinutes
            && now()->diffInMinutes($this->scheduled_at, false) >= -60;
    }

    public function start(): void
    {
        $this->update([
            'status' => 'in_progress',
            'started_at' => now(),
        ]);
    }

    public function end(): void
    {
        $this->update([
            'status' => 'completed',
            'ended_at' => now(),
            'duration_minutes' => $this->started_at->diffInMinutes(now()),
        ]);
    }

    public function cancel(User $user, string $reason): void
    {
        $this->update([
            'status' => 'cancelled',
            'cancellation_reason' => $reason,
            'cancelled_by' => $user->id,
            'cancelled_at' => now(),
        ]);
    }
}
```

### 3. Filament Resource for Consultation Management

```php
// app/Filament/Resources/ConsultationResource.php
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultationResource\Pages;
use App\Models\Consultation;
use App\Models\Professional;
use App\Models\Specialty;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsultationResource extends Resource
{
    protected static ?string $model = Consultation::class;
    protected static ?string $navigationIcon = 'heroicon-o-video-camera';
    protected static ?string $navigationGroup = 'Medical';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Consultation Details')
                    ->schema([
                        Forms\Components\Select::make('patient_id')
                            ->label('Patient')
                            ->options(User::where('profile_type', 'patient')->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('professional_id')
                            ->label('Professional')
                            ->options(Professional::with('user')->get()->pluck('user.name', 'id'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, Forms\Set $set) =>
                                $set('price', Professional::find($state)?->consultation_price ?? 0)
                            ),
                        Forms\Components\Select::make('specialty_id')
                            ->label('Specialty')
                            ->options(Specialty::where('active', true)->pluck('name', 'id'))
                            ->searchable(),
                        Forms\Components\Select::make('consultation_type')
                            ->options([
                                'video' => 'Video Call',
                                'voice' => 'Voice Call',
                                'chat' => 'Chat Only',
                            ])
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Scheduling')
                    ->schema([
                        Forms\Components\DateTimePicker::make('scheduled_at')
                            ->required()
                            ->minDate(now())
                            ->displayFormat('d/m/Y H:i'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'scheduled' => 'Scheduled',
                                'confirmed' => 'Confirmed',
                                'in_progress' => 'In Progress',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                                'no_show' => 'No Show',
                            ])
                            ->required()
                            ->default('scheduled'),
                    ])->columns(2),

                Forms\Components\Section::make('Clinical Information')
                    ->schema([
                        Forms\Components\Textarea::make('chief_complaint')
                            ->label('Chief Complaint')
                            ->rows(3),
                        Forms\Components\KeyValue::make('notes')
                            ->label('Consultation Notes')
                            ->keyLabel('Topic')
                            ->valueLabel('Notes'),
                        Forms\Components\Toggle::make('follow_up_required')
                            ->label('Follow-up Required'),
                    ]),

                Forms\Components\Section::make('Pricing')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->prefix('R$')
                            ->required(),
                        Forms\Components\TextInput::make('discount_applied')
                            ->numeric()
                            ->prefix('R$')
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('ID')
                    ->searchable()
                    ->copyable()
                    ->limit(8),
                Tables\Columns\TextColumn::make('patient.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('professional.user.name')
                    ->label('Professional')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('consultation_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'video' => 'success',
                        'voice' => 'warning',
                        'chat' => 'info',
                    }),
                Tables\Columns\TextColumn::make('scheduled_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'scheduled',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                        'secondary' => 'no_show',
                        'primary' => 'in_progress',
                        'info' => 'confirmed',
                    ]),
                Tables\Columns\TextColumn::make('price')
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\IconColumn::make('follow_up_required')
                    ->boolean(),
                Tables\Columns\TextColumn::make('rating')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'confirmed' => 'Confirmed',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'no_show' => 'No Show',
                    ]),
                SelectFilter::make('consultation_type')
                    ->options([
                        'video' => 'Video Call',
                        'voice' => 'Voice Call',
                        'chat' => 'Chat Only',
                    ]),
                Filter::make('upcoming')
                    ->query(fn (Builder $query): Builder =>
                        $query->where('scheduled_at', '>', now())
                            ->whereIn('status', ['scheduled', 'confirmed'])
                    ),
                Filter::make('today')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereDate('scheduled_at', today())
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('join')
                    ->label('Join')
                    ->icon('heroicon-o-video-camera')
                    ->color('success')
                    ->url(fn (Consultation $record): string =>
                        route('consultation.room', $record->uuid)
                    )
                    ->visible(fn (Consultation $record): bool =>
                        $record->canJoin()
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('scheduled_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagers can be added here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConsultations::route('/'),
            'create' => Pages\CreateConsultation::route('/create'),
            'view' => Pages\ViewConsultation::route('/{record}'),
            'edit' => Pages\EditConsultation::route('/{record}/edit'),
        ];
    }
}
```

### 4. Livewire Component for Consultation Booking

```php
// app/Livewire/Patient/Consultations/BookConsultation.php
<?php

namespace App\Livewire\Patient\Consultations;

use App\Models\Professional;
use App\Models\Consultation;
use App\Models\ConsultationSlot;
use App\Models\Specialty;
use App\Services\PaymentService;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Validate;

class BookConsultation extends Component
{
    public $step = 1;

    #[Validate('required|exists:specialties,id')]
    public $specialtyId;

    #[Validate('required|exists:professionals,id')]
    public $professionalId;

    #[Validate('required|in:video,voice,chat')]
    public $consultationType = 'video';

    #[Validate('required|date|after:now')]
    public $selectedDateTime;

    #[Validate('required|string|max:500')]
    public $chiefComplaint;

    public $selectedProfessional;
    public $availableSlots = [];
    public $selectedDate;
    public $consultationPrice;
    public $paymentMethod = 'credit_card';

    public function mount()
    {
        $this->selectedDate = now()->format('Y-m-d');
    }

    public function selectSpecialty()
    {
        $this->validate(['specialtyId' => 'required|exists:specialties,id']);
        $this->step = 2;
        $this->loadProfessionals();
    }

    public function selectProfessional($professionalId)
    {
        $this->professionalId = $professionalId;
        $this->selectedProfessional = Professional::with('user', 'specialties')
            ->find($professionalId);
        $this->consultationPrice = $this->selectedProfessional->consultation_price;
        $this->step = 3;
        $this->loadAvailableSlots();
    }

    public function loadAvailableSlots()
    {
        $date = Carbon::parse($this->selectedDate);

        // Get professional's slots for the selected date
        $slots = ConsultationSlot::where('professional_id', $this->professionalId)
            ->where(function ($query) use ($date) {
                $query->where('specific_date', $date)
                    ->orWhere(function ($q) use ($date) {
                        $q->whereNull('specific_date')
                            ->where('day_of_week', $date->dayOfWeek)
                            ->where('is_recurring', true);
                    });
            })
            ->where('is_available', true)
            ->get();

        // Generate time slots
        $this->availableSlots = [];
        foreach ($slots as $slot) {
            $startTime = Carbon::parse($this->selectedDate . ' ' . $slot->start_time);
            $endTime = Carbon::parse($this->selectedDate . ' ' . $slot->end_time);
            $duration = $slot->slot_duration_minutes;

            while ($startTime->addMinutes($duration)->lte($endTime)) {
                $slotTime = $startTime->copy();

                // Check if slot is already booked
                $isBooked = Consultation::where('professional_id', $this->professionalId)
                    ->where('scheduled_at', $slotTime)
                    ->whereNotIn('status', ['cancelled'])
                    ->exists();

                if (!$isBooked && $slotTime->isFuture()) {
                    $this->availableSlots[] = [
                        'time' => $slotTime->format('H:i'),
                        'datetime' => $slotTime->format('Y-m-d H:i:s'),
                    ];
                }

                $startTime->addMinutes($duration);
            }
        }
    }

    public function selectTimeSlot($datetime)
    {
        $this->selectedDateTime = $datetime;
        $this->step = 4;
    }

    public function submitConsultationDetails()
    {
        $this->validate([
            'chiefComplaint' => 'required|string|max:500',
            'consultationType' => 'required|in:video,voice,chat',
        ]);

        $this->step = 5;
    }

    public function confirmBooking()
    {
        $this->validate();

        try {
            // Create consultation
            $consultation = Consultation::create([
                'patient_id' => auth()->id(),
                'professional_id' => $this->professionalId,
                'specialty_id' => $this->specialtyId,
                'consultation_type' => $this->consultationType,
                'scheduled_at' => $this->selectedDateTime,
                'chief_complaint' => $this->chiefComplaint,
                'status' => 'scheduled',
                'price' => $this->consultationPrice,
            ]);

            // Process payment
            $paymentService = app(PaymentService::class);
            $payment = $paymentService->processConsultationPayment(
                $consultation,
                $this->paymentMethod
            );

            if ($payment->status === 'approved') {
                $consultation->update([
                    'status' => 'confirmed',
                    'payment_id' => $payment->id,
                ]);

                // Send confirmation notifications
                $consultation->patient->notify(new ConsultationBooked($consultation));
                $consultation->professional->user->notify(new NewConsultation($consultation));

                session()->flash('success', 'Consultation booked successfully!');
                return redirect()->route('patient.consultations.show', $consultation->uuid);
            } else {
                $consultation->delete();
                session()->flash('error', 'Payment failed. Please try again.');
            }

        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred. Please try again.');
            logger()->error('Consultation booking failed', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.patient.consultations.book-consultation', [
            'specialties' => Specialty::where('active', true)->get(),
            'professionals' => $this->step >= 2
                ? Professional::with('user', 'specialties')
                    ->whereHas('specialties', function ($q) {
                        $q->where('specialty_id', $this->specialtyId);
                    })
                    ->where('available_for_emergency', true)
                    ->get()
                : collect(),
        ]);
    }
}
```

### 5. Video Consultation Room Component

```php
// app/Livewire/Shared/VideoCall.php
<?php

namespace App\Livewire\Shared;

use App\Models\Consultation;
use App\Services\AgoraService;
use Livewire\Component;
use Livewire\Attributes\On;

class VideoCall extends Component
{
    public Consultation $consultation;
    public $agoraAppId;
    public $agoraToken;
    public $channelName;
    public $userId;
    public $isVideoEnabled = true;
    public $isAudioEnabled = true;
    public $isScreenSharing = false;
    public $connectionStatus = 'connecting';
    public $callDuration = 0;
    public $isProfessional;

    protected $listeners = [
        'toggleVideo' => 'toggleVideo',
        'toggleAudio' => 'toggleAudio',
        'toggleScreenShare' => 'toggleScreenShare',
        'endCall' => 'endCall',
    ];

    public function mount(Consultation $consultation)
    {
        $this->consultation = $consultation;
        $this->userId = auth()->id();
        $this->isProfessional = auth()->id() === $consultation->professional->user_id;

        // Check if user has permission to join
        $this->authorize('join', $consultation);

        // Generate Agora credentials
        $agoraService = app(AgoraService::class);
        $this->agoraAppId = config('services.agora.app_id');
        $this->channelName = 'consultation_' . $consultation->id;
        $this->agoraToken = $agoraService->generateToken(
            $this->channelName,
            $this->userId
        );

        // Update consultation token
        $consultation->update([
            'agora_channel_id' => $this->channelName,
            'agora_token' => $this->agoraToken,
        ]);

        // Start consultation if professional joins
        if ($this->isProfessional && $consultation->status === 'confirmed') {
            $consultation->start();
        }
    }

    #[On('user-joined')]
    public function handleUserJoined($userId)
    {
        $this->connectionStatus = 'connected';
        $this->dispatch('show-notification', [
            'type' => 'success',
            'message' => 'User joined the call',
        ]);
    }

    #[On('user-left')]
    public function handleUserLeft($userId)
    {
        $this->dispatch('show-notification', [
            'type' => 'warning',
            'message' => 'User left the call',
        ]);
    }

    public function toggleVideo()
    {
        $this->isVideoEnabled = !$this->isVideoEnabled;
        $this->dispatch('toggle-video', enabled: $this->isVideoEnabled);
    }

    public function toggleAudio()
    {
        $this->isAudioEnabled = !$this->isAudioEnabled;
        $this->dispatch('toggle-audio', enabled: $this->isAudioEnabled);
    }

    public function toggleScreenShare()
    {
        $this->isScreenSharing = !$this->isScreenSharing;
        $this->dispatch('toggle-screen-share', enabled: $this->isScreenSharing);
    }

    public function endCall()
    {
        if ($this->isProfessional) {
            $this->consultation->end();

            // Stop recording if enabled
            $agoraService = app(AgoraService::class);
            if ($this->consultation->recording_url) {
                $agoraService->stopRecording($this->channelName);
            }
        }

        $this->dispatch('leave-channel');

        return redirect()->route(
            $this->isProfessional ? 'professional.consultations' : 'patient.consultations'
        );
    }

    public function render()
    {
        return view('livewire.shared.video-call');
    }
}
```

### 6. Payment Service Integration

```php
// app/Services/PaymentService.php
<?php

namespace App\Services;

use App\Models\Consultation;
use App\Models\Transaction;
use App\Models\User;
use App\Services\AsaasService;
use Illuminate\Support\Str;

class PaymentService
{
    protected AsaasService $asaas;

    public function __construct(AsaasService $asaas)
    {
        $this->asaas = $asaas;
    }

    public function processConsultationPayment(
        Consultation $consultation,
        string $paymentMethod,
        ?string $paymentMethodId = null
    ): Transaction {
        $user = $consultation->patient;

        // Calculate final amount with cashback
        $amount = $consultation->price - $consultation->discount_applied;
        $cashbackAmount = $this->calculateCashback($user, $amount);

        // Create transaction record
        $transaction = Transaction::create([
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'type' => 'consultation',
            'related_id' => $consultation->id,
            'related_type' => Consultation::class,
            'amount' => $consultation->price,
            'discount_amount' => $consultation->discount_applied,
            'cashback_amount' => $cashbackAmount,
            'final_amount' => $amount,
            'payment_method_id' => $paymentMethodId,
            'status' => 'pending',
        ]);

        try {
            // Get or create Asaas customer
            $asaasCustomer = $this->getOrCreateAsaasCustomer($user);

            // Process payment based on method
            $paymentData = [
                'customer' => $asaasCustomer->id,
                'value' => $amount,
                'dueDate' => now()->format('Y-m-d'),
                'description' => "Consultation with {$consultation->professional->user->name}",
                'externalReference' => $transaction->uuid,
            ];

            switch ($paymentMethod) {
                case 'pix':
                    $paymentData['billingType'] = 'PIX';
                    $asaasPayment = $this->asaas->createPayment($paymentData);
                    $transaction->update([
                        'asaas_payment_id' => $asaasPayment->id,
                        'metadata' => [
                            'pix_qr_code' => $asaasPayment->pixQrCode,
                            'pix_key' => $asaasPayment->pixKey,
                        ],
                    ]);
                    break;

                case 'credit_card':
                    $paymentData['billingType'] = 'CREDIT_CARD';
                    $paymentData['creditCard'] = [
                        'holderName' => $user->name,
                        'number' => request()->input('card_number'),
                        'expiryMonth' => request()->input('expiry_month'),
                        'expiryYear' => request()->input('expiry_year'),
                        'ccv' => request()->input('cvv'),
                    ];
                    $paymentData['creditCardHolderInfo'] = [
                        'name' => $user->name,
                        'email' => $user->email,
                        'cpfCnpj' => $user->cpf,
                        'phone' => $user->phone,
                    ];

                    $asaasPayment = $this->asaas->createPayment($paymentData);
                    $transaction->update([
                        'asaas_payment_id' => $asaasPayment->id,
                        'asaas_invoice_url' => $asaasPayment->invoiceUrl,
                    ]);
                    break;

                case 'cashback':
                    if ($user->cashback_balance >= $amount) {
                        $user->decrement('cashback_balance', $amount);
                        $transaction->update([
                            'status' => 'approved',
                            'payment_date' => now(),
                        ]);

                        // Log cashback usage
                        CashbackTransaction::create([
                            'user_id' => $user->id,
                            'type' => 'redeemed',
                            'amount' => $amount,
                            'source_type' => 'consultation',
                            'source_id' => $consultation->id,
                            'transaction_id' => $transaction->id,
                            'description' => 'Used for consultation payment',
                        ]);

                        return $transaction;
                    } else {
                        throw new \Exception('Insufficient cashback balance');
                    }
                    break;
            }

            // Check payment status (for credit card it's usually instant)
            if ($asaasPayment->status === 'CONFIRMED' || $asaasPayment->status === 'RECEIVED') {
                $transaction->update([
                    'status' => 'approved',
                    'payment_date' => now(),
                ]);

                // Add cashback to user account
                if ($cashbackAmount > 0) {
                    $this->addCashback($user, $cashbackAmount, $transaction);
                }

                // Distribute payment to professional (minus platform fee)
                $this->distributeProfessionalPayment($consultation, $transaction);
            }

        } catch (\Exception $e) {
            $transaction->update([
                'status' => 'failed',
                'metadata' => array_merge($transaction->metadata ?? [], [
                    'error' => $e->getMessage(),
                ]),
            ]);

            throw $e;
        }

        return $transaction;
    }

    protected function calculateCashback(User $user, float $amount): float
    {
        $cashbackPercentage = 0;

        // Check user subscription for cashback benefits
        if ($user->subscription) {
            $cashbackPercentage = $user->subscription->plan->cashback_percentage;
        }

        // Additional cashback for first consultation
        if (!$user->consultations()->completed()->exists()) {
            $cashbackPercentage += 5; // 5% extra for first consultation
        }

        return round($amount * ($cashbackPercentage / 100), 2);
    }

    protected function addCashback(User $user, float $amount, Transaction $transaction): void
    {
        $user->increment('cashback_balance', $amount);

        CashbackTransaction::create([
            'user_id' => $user->id,
            'type' => 'earned',
            'amount' => $amount,
            'source_type' => 'consultation',
            'source_id' => $transaction->related_id,
            'description' => 'Cashback from consultation',
            'expires_at' => now()->addMonths(6),
        ]);
    }

    protected function distributeProfessionalPayment(
        Consultation $consultation,
        Transaction $transaction
    ): void {
        $platformFeePercentage = config('app.platform_fee', 20); // 20% platform fee
        $professionalAmount = $transaction->final_amount * ((100 - $platformFeePercentage) / 100);

        // Create professional earning record
        ProfessionalEarning::create([
            'professional_id' => $consultation->professional_id,
            'consultation_id' => $consultation->id,
            'transaction_id' => $transaction->id,
            'gross_amount' => $transaction->final_amount,
            'platform_fee' => $transaction->final_amount - $professionalAmount,
            'net_amount' => $professionalAmount,
            'status' => 'pending',
            'payout_date' => now()->addDays(2), // D+2 payout
        ]);
    }

    protected function getOrCreateAsaasCustomer(User $user)
    {
        if ($user->asaas_customer_id) {
            return $this->asaas->getCustomer($user->asaas_customer_id);
        }

        $customer = $this->asaas->createCustomer([
            'name' => $user->name,
            'email' => $user->email,
            'cpfCnpj' => $user->cpf,
            'phone' => $user->phone,
        ]);

        $user->update(['asaas_customer_id' => $customer->id]);

        return $customer;
    }
}
```

### 7. WhatsApp Integration Service

```php
// app/Services/WhatsAppService.php
<?php

namespace App\Services;

use App\Models\NotificationLog;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    protected string $apiUrl;
    protected string $apiKey;
    protected string $instance;

    public function __construct()
    {
        $this->apiUrl = config('services.evolution.api_url');
        $this->apiKey = config('services.evolution.api_key');
        $this->instance = config('services.evolution.instance');
    }

    public function sendConsultationReminder($consultation): bool
    {
        $patient = $consultation->patient;
        $professional = $consultation->professional->user;
        $scheduledTime = $consultation->scheduled_at->format('d/m/Y H:i');

        $message = $this->renderTemplate('consultation_reminder', [
            'patient_name' => $patient->name,
            'professional_name' => $professional->name,
            'scheduled_time' => $scheduledTime,
            'consultation_type' => $consultation->consultation_type,
            'consultation_link' => route('consultation.room', $consultation->uuid),
        ]);

        return $this->sendMessage($patient->whatsapp_number, $message);
    }

    public function sendPrescription($prescription): bool
    {
        $patient = $prescription->consultation->patient;
        $pdfUrl = $prescription->getPdfUrl();

        $message = "Hello {$patient->name}, your prescription is ready.";

        // Send document
        $sent = $this->sendDocument(
            $patient->whatsapp_number,
            $pdfUrl,
            $message
        );

        // Send medication instructions
        if ($sent) {
            $instructions = $this->formatPrescriptionInstructions($prescription);
            $this->sendMessage($patient->whatsapp_number, $instructions);
        }

        return $sent;
    }

    protected function sendMessage(string $to, string $message): bool
    {
        try {
            $response = Http::withHeaders([
                'apikey' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post("{$this->apiUrl}/message/sendText/{$this->instance}", [
                'number' => $this->formatPhoneNumber($to),
                'text' => $message,
            ]);

            $this->logNotification($to, 'whatsapp', $message, $response->successful());

            return $response->successful();

        } catch (\Exception $e) {
            logger()->error('WhatsApp send failed', [
                'to' => $to,
                'error' => $e->getMessage(),
            ]);

            $this->logNotification($to, 'whatsapp', $message, false, $e->getMessage());

            return false;
        }
    }

    protected function sendDocument(string $to, string $documentUrl, string $caption): bool
    {
        try {
            $response = Http::withHeaders([
                'apikey' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post("{$this->apiUrl}/message/sendMedia/{$this->instance}", [
                'number' => $this->formatPhoneNumber($to),
                'mediatype' => 'document',
                'media' => $documentUrl,
                'caption' => $caption,
            ]);

            return $response->successful();

        } catch (\Exception $e) {
            logger()->error('WhatsApp document send failed', [
                'to' => $to,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    protected function formatPhoneNumber(string $phone): string
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Add country code if not present
        if (strlen($phone) === 11) {
            $phone = '55' . $phone; // Brazil code
        }

        return $phone;
    }

    protected function renderTemplate(string $templateName, array $variables): string
    {
        $template = NotificationTemplate::where('slug', $templateName)
            ->where('type', 'whatsapp')
            ->where('is_active', true)
            ->first();

        if (!$template) {
            throw new \Exception("Template {$templateName} not found");
        }

        $message = $template->body;

        foreach ($variables as $key => $value) {
            $message = str_replace('{' . $key . '}', $value, $message);
        }

        return $message;
    }

    protected function formatPrescriptionInstructions($prescription): string
    {
        $instructions = "*Prescription Instructions*\n\n";

        foreach ($prescription->medications as $medication) {
            $instructions .= "💊 *{$medication['name']}*\n";
            $instructions .= "Dosage: {$medication['dosage']}\n";
            $instructions .= "Frequency: {$medication['frequency']}\n";
            $instructions .= "Duration: {$medication['duration']}\n";

            if (!empty($medication['instructions'])) {
                $instructions .= "Instructions: {$medication['instructions']}\n";
            }

            $instructions .= "\n";
        }

        $instructions .= "_Please follow the instructions carefully. Contact your doctor if you have any questions._";

        return $instructions;
    }

    protected function logNotification(
        string $recipient,
        string $channel,
        string $content,
        bool $success,
        ?string $error = null
    ): void {
        NotificationLog::create([
            'user_id' => User::where('whatsapp_number', $recipient)->first()?->id,
            'type' => 'whatsapp',
            'channel' => $channel,
            'recipient' => $recipient,
            'content' => $content,
            'status' => $success ? 'sent' : 'failed',
            'sent_at' => $success ? now() : null,
            'error_message' => $error,
        ]);
    }
}
```

## Key Implementation Recommendations

### 1. Development Priorities
- Start with core authentication and user management
- Implement consultation scheduling before video integration
- Build payment system in parallel with medical features
- Add communication channels incrementally

### 2. Security Best Practices
- Implement API rate limiting from day one
- Use Laravel Sanctum for API authentication
- Encrypt all sensitive medical data
- Regular security audits and penetration testing
- Implement comprehensive audit logging

### 3. Performance Optimization
- Use Redis for caching and sessions
- Implement database indexing strategy
- Use queue workers for heavy operations
- Optimize Eloquent queries with eager loading
- Implement CDN for static assets

### 4. Testing Strategy
- Write tests alongside feature development
- Maintain minimum 80% code coverage
- Implement E2E tests for critical flows
- Regular load testing for video calls
- Automated regression testing

### 5. Deployment Architecture
- Use containerization with Docker
- Implement CI/CD pipeline with GitHub Actions
- Use separate environments (dev, staging, production)
- Implement blue-green deployment strategy
- Regular automated backups

This implementation plan provides a solid foundation for building a comprehensive telemedicine platform using your existing Laravel template with the TALL stack.