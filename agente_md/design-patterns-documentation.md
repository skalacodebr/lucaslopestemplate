# Design Patterns Documentation - Laravel + Filament Template

## Table of Contents
1. [Project Overview](#project-overview)
2. [Architectural Patterns](#architectural-patterns)
3. [Creational Patterns](#creational-patterns)
4. [Structural Patterns](#structural-patterns)
5. [Behavioral Patterns](#behavioral-patterns)
6. [Laravel-Specific Patterns](#laravel-specific-patterns)
7. [Filament-Specific Patterns](#filament-specific-patterns)
8. [Frontend Patterns](#frontend-patterns)
9. [Pattern Relationships](#pattern-relationships)

## Project Overview

This Laravel application implements a content management system with Filament admin panel, featuring a blog/posts system with user management. The codebase demonstrates multiple design patterns working together to create a maintainable, scalable application.

### Technology Stack
- **Framework**: Laravel 12
- **Admin Panel**: Filament v3
- **Frontend**: Livewire, Alpine.js, Tailwind CSS
- **Database**: Eloquent ORM
- **Authentication**: Laravel Sanctum + Filament Breezy

## Architectural Patterns

### 1. Model-View-Controller (MVC)

The application follows Laravel's implementation of the MVC pattern with clear separation of concerns.

**Implementation:**

```php
// Model Layer - app/Models/Post.php
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'content', 'image_id',
        'user_id', 'is_published', 'published_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

// Controller Layer - Handled by Livewire Components
// app/Livewire/Home.php
class Home extends Component
{
    public function render()
    {
        $posts = Post::published()
            ->latest('published_at')
            ->paginate(6);

        return view('livewire.home', compact('posts'));
    }
}

// View Layer - resources/views/livewire/home.blade.php
```

**Benefits:**
- Clear separation between data logic, business logic, and presentation
- Improved testability and maintainability
- Parallel development capability

### 2. Service Provider Pattern

Service providers bootstrap the application services and configurations.

**Implementation:**

```php
// app/Providers/AppServiceProvider.php
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        FilamentView::registerRenderHook(
            'panels::head.start',
            fn (): string => '<meta name="robots" content="noindex,nofollow">'
        );
    }
}

// app/Providers/AdminPanelProvider.php
class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->plugins([
                BreezyCore::make(),
                CuratorPlugin::make(),
                FilamentJobsMonitorPlugin::make()
            ]);
    }
}
```

**Benefits:**
- Centralized service configuration
- Lazy loading of services
- Clean application bootstrapping

### 3. Repository Pattern (Implicit)

While not explicitly implemented with repository classes, the pattern is implicitly used through Eloquent's Active Record pattern with query scopes.

**Implementation:**

```php
// app/Models/Post.php
public function scopePublished($query)
{
    return $query->where('is_published', true);
}

public function scopeDrafts($query)
{
    return $query->where('is_published', false);
}

// Usage
$publishedPosts = Post::published()->get();
$draftPosts = Post::drafts()->get();
```

## Creational Patterns

### 1. Factory Pattern

Used for generating test data and seeding the database.

**Implementation:**

```php
// database/factories/PostFactory.php
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'content' => [[
                'type' => 'markdown',
                'data' => ['content' => implode("\n\n", $content)]
            ]],
            'user_id' => 1,
            'is_published' => $this->faker->boolean(75),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now')
        ];
    }
}

// Usage
Post::factory()->count(10)->create();
```

**Benefits:**
- Consistent test data generation
- Simplified database seeding
- Separation of test data logic from business logic

### 2. Builder Pattern

Implemented through Filament's form and table builders.

**Implementation:**

```php
// app/Filament/Resources/PostResource.php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Grid::make()
                ->columns(3)
                ->schema([
                    Forms\Components\Section::make()
                        ->columnSpan(2)
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->live()
                                ->afterStateUpdated(/* ... */)
                                ->required()
                        ])
                ])
        ]);
}
```

**Benefits:**
- Fluent interface for complex object construction
- Step-by-step object building
- Readable and maintainable configuration

## Structural Patterns

### 1. Decorator Pattern

Implemented through Laravel's middleware system.

**Implementation:**

```php
// app/Http/Middleware/AddSeoDefaults.php
class AddSeoDefaults
{
    public function handle(Request $request, Closure $next): Response
    {
        // Add SEO defaults before processing
        seo()->charset();
        seo()->viewport();
        seo()->csrfToken();

        seo()->addMany([
            LinkMeta::make()
                ->rel('apple-touch-icon')
                ->href('/apple-touch-icon.png'),
            // More SEO configurations
        ]);

        return $next($request);
    }
}

// bootstrap/app.php
->withMiddleware(function (Middleware $middleware) {
    $middleware->web([
        App\Http\Middleware\AddSeoDefaults::class,
    ]);
})
```

**Benefits:**
- Add responsibilities to objects dynamically
- Non-intrusive enhancement of functionality
- Stackable behavior modifications

### 2. Facade Pattern

Laravel extensively uses facades to provide a simple interface to complex subsystems.

**Implementation:**

```php
// Usage of Hash Facade
use Illuminate\Support\Facades\Hash;

Forms\Components\TextInput::make('password')
    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))

// The Hash facade provides simple access to hashing functionality
```

### 3. Adapter Pattern

The Filament resources act as adapters between Eloquent models and Filament's admin interface.

**Implementation:**

```php
// app/Filament/Resources/PostResource.php
class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    public static function form(Form $form): Form
    {
        // Adapts Post model to Filament form interface
    }

    public static function table(Table $table): Table
    {
        // Adapts Post model to Filament table interface
    }
}
```

## Behavioral Patterns

### 1. Observer Pattern

Implemented through Eloquent's event system and Livewire's reactive properties.

**Implementation:**

```php
// Livewire reactive properties
// app/Livewire/Post/Show.php
class Show extends Component
{
    public $post; // Reactive property

    public function mount($post)
    {
        $this->post = Post::whereSlug($post)->firstOrFail();
        // Component reacts to changes in $post
    }
}

// Form field reactivity
Forms\Components\TextInput::make('title')
    ->live()
    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
        $set('slug', Str::slug($state));
    })
```

**Benefits:**
- Loose coupling between components
- Dynamic event handling
- Automatic UI updates

### 2. Strategy Pattern

Implemented in authentication and form validation strategies.

**Implementation:**

```php
// Different authentication strategies
class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    public function canAccessPanel(Panel $panel): bool
    {
        return true; // Strategy for panel access
    }
}

// Conditional form requirements
Forms\Components\TextInput::make('password')
    ->required(fn (string $operation): bool => $operation === 'create')
```

### 3. Template Method Pattern

Base classes define the skeleton of algorithms, subclasses override specific steps.

**Implementation:**

```php
// app/Filament/Resources/PostResource/Pages/EditPost.php
class EditPost extends EditRecord
{
    use HasPreview, HasPreviewModal;

    protected static string $resource = PostResource::class;

    // Override template methods
    protected function getPreviewModalUrl(): ?string
    {
        $this->generatePreviewSession();
        return route('post.show', [
            'post' => $this->record->slug,
            'previewToken' => $this->previewToken,
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            PreviewAction::make(),
            Actions\Action::make('view'),
            Actions\DeleteAction::make(),
        ];
    }
}
```

## Laravel-Specific Patterns

### 1. Active Record Pattern

Eloquent ORM implements the Active Record pattern where models contain both data and behavior.

**Implementation:**

```php
// app/Models/Post.php
class Post extends Model
{
    // Data
    protected $fillable = ['title', 'slug', 'content'];

    // Behavior
    public function getUrlAttribute()
    {
        return route('post.show', $this);
    }

    public function getExcerptAttribute()
    {
        $excerpt = collect($this->content)
            ->where('type', 'markdown')
            ->first() ?? [];
        return Str::limit($excerpt, 160);
    }
}
```

### 2. Query Scope Pattern

Reusable query constraints encapsulated in model methods.

**Implementation:**

```php
// Model scopes
public function scopePublished($query)
{
    return $query->where('is_published', true);
}

// Usage
Post::published()->latest('published_at')->paginate(6);
```

### 3. Eloquent Relationships

Declarative relationship definitions between models.

**Implementation:**

```php
// app/Models/User.php
public function posts()
{
    return $this->hasMany(Post::class);
}

// app/Models/Post.php
public function user()
{
    return $this->belongsTo(User::class);
}

public function image()
{
    return $this->belongsTo(Media::class);
}
```

### 4. Middleware Pipeline Pattern

Request handling through a series of middleware layers.

**Implementation:**

```php
// bootstrap/app.php
->withMiddleware(function (Middleware $middleware) {
    $middleware->web([
        App\Http\Middleware\AddSeoDefaults::class,
    ]);

    $middleware->redirectTo(fn () => Filament\Pages\Dashboard::getUrl());
})
```

## Filament-Specific Patterns

### 1. Resource Pattern

Encapsulates CRUD operations for models in a single resource class.

**Implementation:**

```php
class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Collections';

    public static function form(Form $form): Form { /* ... */ }
    public static function table(Table $table): Table { /* ... */ }
    public static function getPages(): array { /* ... */ }
}
```

### 2. Plugin Architecture Pattern

Extensible system through plugins that enhance functionality.

**Implementation:**

```php
// app/Providers/AdminPanelProvider.php
->plugins([
    BreezyCore::make()
        ->myProfile(
            shouldRegisterUserMenu: true,
            shouldRegisterNavigation: false,
            hasAvatars: false
        )
        ->enableTwoFactorAuthentication(),

    CuratorPlugin::make()
        ->label('Media')
        ->navigationGroup('Media'),

    FilamentJobsMonitorPlugin::make(),
    FilamentPeekPlugin::make(),
    FilamentExceptionsPlugin::make(),
])
```

### 3. Form Builder Pattern

Complex form construction through method chaining.

**Implementation:**

```php
Forms\Components\Builder::make('content')
    ->required()
    ->columnSpanFull()
    ->blocks([
        Builder\Block::make('markdown')
            ->schema([
                Forms\Components\MarkdownEditor::make('content')
                    ->required(),
            ]),
        Builder\Block::make('figure')
            ->schema([
                CuratorPicker::make('image')
                    ->required(),
            ])
    ])
```

## Frontend Patterns

### 1. Component-Based Architecture (Livewire)

UI broken down into reusable, self-contained components.

**Implementation:**

```php
// app/Livewire/Home.php
class Home extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = Post::published()
            ->latest('published_at')
            ->paginate(6);

        return view('livewire.home', compact('posts'));
    }
}

// app/Livewire/Post/Show.php
class Show extends Component
{
    use HasPreview;

    public $post;

    public function mount($post)
    {
        $this->post = Post::whereSlug($post)->firstOrFail();
        $this->handlePreview();
    }
}
```

### 2. Trait Pattern

Code reuse through traits for common functionality.

**Implementation:**

```php
// app/Concerns/HasPreview.php
trait HasPreview
{
    protected ?string $previewToken = null;
    public bool $isPreview = false;

    protected function handlePreview(?string $resource = null, string $token = 'previewToken'): void
    {
        // Preview handling logic
    }

    protected function generatePreviewSession(string $record = 'record'): void
    {
        // Session generation logic
    }
}

// Usage
class Show extends Component
{
    use HasPreview;
}
```

### 3. SEO Builder Pattern

Fluent interface for building SEO metadata.

**Implementation:**

```php
// app/Livewire/Home.php
seo()
    ->title($title = config('app.name'))
    ->description($description = 'Lorem ipsum...')
    ->canonical($url = route('home'))
    ->addSchema(
        Schema::webPage()
            ->name($title)
            ->description($description)
            ->url($url)
            ->author(Schema::organization()->name($title))
    );
```

## Pattern Relationships

### 1. MVC + Resource Pattern Integration

The Filament Resource pattern extends the traditional MVC by providing an additional abstraction layer:

```
Model (Eloquent) → Resource (Filament) → View (Filament Tables/Forms)
                        ↓
                  Controller Logic
                  (Pages/Actions)
```

### 2. Observer + Livewire Integration

Livewire components act as both observers and subjects:

```
User Interaction → Livewire Component → Model Update
                          ↓
                    UI Re-render
```

### 3. Middleware + Decorator Chain

Middleware creates a decorator chain for request handling:

```
Request → AddSeoDefaults → Authentication → Authorization → Response
             ↓                    ↓              ↓
         Add Meta Tags    Verify User     Check Permissions
```

### 4. Factory + Seeder Integration

Factories work with seeders to populate the database:

```
DatabaseSeeder → UserFactory → Create Users
                      ↓
                PostFactory → Create Posts for Users
```

## Best Practices Observed

1. **Single Responsibility**: Each class has a clear, single purpose
2. **Dependency Injection**: Services are injected rather than instantiated
3. **Interface Segregation**: Filament resources implement only needed methods
4. **Open/Closed Principle**: Extension through traits and plugins without modification
5. **Liskov Substitution**: Resource pages can be swapped without breaking functionality

## Architectural Benefits

1. **Maintainability**: Clear separation of concerns makes code easy to maintain
2. **Scalability**: Plugin architecture allows easy feature addition
3. **Testability**: Dependency injection and service providers enable easy testing
4. **Reusability**: Traits, components, and resources promote code reuse
5. **Flexibility**: Multiple patterns working together provide flexibility in implementation

## Conclusion

This Laravel + Filament application demonstrates a mature implementation of multiple design patterns working in harmony. The architecture leverages Laravel's built-in patterns while extending them with Filament-specific patterns for admin panel functionality. The use of Livewire for frontend interactivity adds another layer of pattern implementation, creating a robust, maintainable, and scalable application architecture.

Key strengths:
- Clean separation between admin (Filament) and public (Livewire) interfaces
- Extensive use of Laravel's native patterns
- Plugin-based extensibility
- Strong typing and modern PHP features
- Comprehensive middleware pipeline for cross-cutting concerns

This architecture provides an excellent foundation for building and scaling content management systems and similar applications.