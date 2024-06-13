# SCALETTA RELAZIONI 1:N

## Create Migration, Model, Controller, Seeder for entity Category

```bash
php artisan make:model -mcrsR Category
```

## Define Migration and Seeder content

```php
 public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
/* _____________________________________________ */
 public function run(): void
    {
        $categories = ['programming', 'Fullstack', 'Backend', 'IoT', 'Cyber security'];

        foreach ($categories as $cat) {
            $category = new Category();
            $category->name = $cat; /* carefull here */
            $category->slug = Str::of($category->name)->slug('-');;
            $category->save();
        }
    }
```

```bash
php artisan migrate
php artisan db:seed --class=CategorySeeder
```

### Eventually use DatabaseSeeder.php

```php
public function run(): void
    {
        $this->call([
            PostSeeder::class
        ]);
    }
```

```bash
php artisan db:seed
```

## Create Relation between tables

### Add FK to Dependent table.

```bash
php artisan make:migration add_category_id_foreign_key_to_posts_table
```

```php
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {

            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->nullOnDelete();
            /* ->onDelete('set null'); */
        });
    }


    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //1. Drop the FK
            $table->dropForeign('posts_category_id_foreign'); //table_column_keyForeign
            //2. Drop the column
            $table->dropColumn('category_id'); //column
        });
    }

```

```bash
php artisan migrate
```

## Create Relation between Models

### In model Post.php

```php
/* add field for mass assignment */
protected $fillable = ['title', 'content', 'slug', 'cover_image', 'category_id', 'user_id'];

    /**
     * Get the category that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
```

### In model Category.php

```php
/**
     * Get all of the comments for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
```

## Creation of a new object $post

### In PostController.php

```php
/* add $variables you want to use */
public function create()
    {
        return view('admin.posts.create', ['categories' => Category::all()]);
    }
```

### In create.blade.php

```php
/* add bs5-form-select-custom*/
<div class="mb-3">
    <label for="category_id" class="form-label">Category</label>
    <select class="form-select form-select-sm" name="category_id" id="category_id">
        <option selected disabled>Select one</option>

            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
                    {{ $category->name }}</option>
            @endforeach

    </select>
</div>
```

#### In StorePostRequest.php validatetion against hacker

```php
/* add FK field that must be validated and hacker-safe: |exists:... */
'category_id' => 'nullable|exists:categories,id',
```

#### In show.blade.php

```php
/* posts could be uncategorized. category_id could be NULL */
<div class="metadata">
    <strong>Categories</strong> {{ $post->category ? $post->category->name : 'Uncategorized' }}
</div>
```

## Update of an object $post

### In PostController.php

```php
/* add $variables you want to use */
public function edit(Post $post)
    {
            $categories = Category::all();
            return view('admin.posts.edit', compact('post', 'categories'));
    }
```

### In edit.blade.php

```php
@foreach ($categories as $category)
    <option value="{{ $category->id }}"
        {{ $category->id == old('category_id', $post->category?->id) ? 'selected' : '' }}>
        {{ $category->name }}</option>
@endforeach
```

#### In UpdatePostRequest.php validatetion against hacker

```php
/* add FK field just like in StoreRequest.php */
'category_id' => 'nullable|exists:categories,id',
```
