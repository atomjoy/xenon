# Polymorphic Relations in Laravel

A polymorphic relationship allows a single table (model)
to be associated with multiple other tables (models).

## One to One (Polymorphic)

### One to One Tables

```sh
admin
    id - integer
    name - string

users
    id - integer
    name - string

profile
    id - integer
    avatar- string
    profileable_id - integer
    profileable_type - string

$table->morphs('profilable');
```

### One to One Models

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Profile extends Model
{
    /**
     * Get the parent profileable model (user or admin).
     */
    public function profileable(): MorphTo
    {
        return $this->morphTo();
    }
}

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Users extends Model
{
    /**
     * Get the users profile.
     */
    public function profile(): MorphOne
    {
        return $this->morphOne(Profile::class, 'profileable');
    }
}

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Admin extends Model
{
    /**
     * Get the admin profile.
     */
    public function profile(): MorphOne
    {
        return $this->morphOne(Profile::class, 'profileable');
    }
}
```

## One to Many (Polymorphic)

### One to Many Tables

```sh
posts
    id - integer
    title - string
    body - text

videos
    id - integer
    title - string
    url - string

comments
    id - integer
    body - text
	reply_id - integer
    commentable_id - integer
    commentable_type - string

$table->morphs('commentable');
$table->unsignedBigInteger('reply_id')->nullable();
$table->foreign('reply_id')->references('id')->on('comments')->onUpdate('cascade')->onDelete('cascade');
```

### One to Many Models

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comments extends Model
{
    /**
     * Get the parent commentable model (posts or vidoes).
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

	/**
	 * Get the comment replies.
	 */
	public function replies(): HasMany
	{
		return $this->hasMany(Comment::class, 'id', 'reply_id');
	}

	/**
	 * Get the parent comment.
	 */
	public function parent(): HasOne
	{
		return $this->hasOne(Comment::class, 'id', 'reply_id');
	}

	/**
	 * Get the article (if commentable works with User abd Admin class).
	 */
	public function article(): BelongsTo
	{
		return $this->belongsTo(Article::class);
	}
}

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Videos extends Model
{
    /**
     * Get the video comments.
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comments::class, 'commentable');
    }
}

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Posts extends Model
{
    /**
     * Get the post comments.
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comments::class, 'commentable');
    }
}
```

## Many to Many (Polymorphic)

### Many to Many Tables

```sh
posts
    id - integer
    name - string

videos
    id - integer
    name - string

tags
    id - integer
    name - string

taggables
    tag_id - integer
    taggable_id - integer
    taggable_type - string

$table->morphs('taggable');
$table->unsignedBigInteger('tag_id');
$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
```

### Many to Many Models

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model
{
    /**
     * Get all of the tags for the post.
     */
     public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}

class Video extends Model
{
    /**
     * Get all of the tags for the video.
     */
     public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}

class Tag extends Model
{
	/**
     * Get the parent taggable models (posts or vidoes).
     */
    public function taggable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function videos(): MorphToMany
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }
}
```

## Change in ServiceProvider (option)

This will ensure that the commentable_type column in your
database stores post or video instead of the fully qualified class names.

```php
<?php

use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::enforceMorphMap([
            'post' => App\Models\Post::class,
            'video' => App\Models\Video::class,
        ]);
    }
}
```

### Sample comments

```php
use App\Models\Post;
use App\Models\Video;
use App\Models\Comment;

// Attach a comment to a post
$post = Post::find(1);
$post->comments()->create([
    'body' => 'This is a comment on a post',
]);

// Attach a comment to a video
$video = Video::find(1);

$video->comments()->create([
    'body' => 'This is a comment on a video',
]);

// Get all comments for a post
$postComments = Post::find(1)->comments;

// Get all comments for a video
$videoComments = Video::find(1)->comments;

// accessing the parents model
$comment = Comment::find(1);
$parent = $comment->commentable; // Returns the related Post or Video model
```

## Sample seeder multi guards

The owner of the comment is the user or administrator.

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$admin = Admin::role('writer')->first();
		$user = User::role('user')->first();

		$admin->articles()->each(function ($article) use ($user, $admin) {
			// OneToMany Polymorphic
			$user->comments()->save(Comment::factory(1)->make([
				'content' => 'Comment article 4',
				'article_id' => $article->id,
			])->first());
			$user->comments()->save(Comment::factory(1)->make([
				'content' => 'Comment article 3',
				'article_id' => $article->id,
			])->first());
			$user->comments()->save(Comment::factory(1)->make([
				'content' => 'Comment article 2',
				'article_id' => $article->id,
			])->first());
			$admin->comments()->save(Comment::factory(1)->make([
				'content' => 'Comment article 1',
				'article_id' => $article->id,
				'reply_id' => Comment::first()->id
			])->first());
		});
	}

	function manyToManyPolymorphic()
	{
		$admin = Admin::role('writer')->first();
		$user = User::role('user')->first();

		$admin->articles()->each(function ($article) use ($user, $admin) {
			// ManyToMany Polymorphic
			$user->comments()->attach(Comment::factory(2)->create([
				'content' => 'Comment article ' . $article->id,
				'article_id' => $article->id,
			]));
			$admin->comments()->attach(Comment::factory(1)->create([
				'content' => 'Comment article ' . $article->id,
				'article_id' => $article->id,
			]));
		});
	}

	function hasMany()
	{
		$admin = Admin::role('writer')->first();
		$user = User::role('user')->first();

		$admin->articles()->each(function ($article) use ($user) {
			// HasMany relation
			$article->comments()->saveMany(Comment::factory(3)->create([
				'content' => 'Comment article ' . $article->id,
				'article_id' => $article->id,
				'user_id' => $user->id,
			]));
		});
	}
}
```

### Sample resource

```php
<?php

namespace App\Http\Resources;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
	/**
	 * The "data" wrapper that should be applied.
	 *
	 * @var string
	 */
	public static $wrap = 'data';

	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'content' => $this->content,
			'link' => $this->link,
			'image' => $this->image,
			'article_id' => $this->article_id,
			'created_at' => $this->created_at->format('Y-m-d H:i:s'),
			'is_article_author' => $this->commentable_type == Admin::class,
			'parent' => $this->parent->id ?? null,
			'owner' => new CommentAuthorResource($this->commentable),
			'replies' => new CommentCollection(
				$this->replies()->latest('id')->paginate(
					perPage: 6,
					pageName: 'page_reply'
				)
			),
		];
	}
}
```

### Sample collection

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
{
	/**
	 * The "data" wrapper that should be applied.
	 *
	 * @var string
	 */
	public static $wrap = 'data';

	/**
	 * Transform the resource collection into an array.
	 *
	 * @return array<int|string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'data' => $this->collection,
			'paginate' => new PaginationResource($this),
		];
	}
}
```

### Sample author resource

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentAuthorResource extends JsonResource
{
	/**
	 * The "data" wrapper that should be applied.
	 *
	 * @var string
	 */
	public static $wrap = 'data';

	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'avatar' => $this->avatar,
			'bio' => $this->bio,
		];
	}
}
```

### Sample collection pagination resource

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
	/**
	 * The "data" wrapper that should be applied.
	 *
	 * @var string
	 */
	public static $wrap = 'data';

	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'total' => $this->total(),
			'count' => $this->count(),
			'per_page' => $this->perPage(),
			'current_page' => $this->currentPage(),
			'total_pages' => $this->lastPage()
		];
	}
}
```

## Comments migration example

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('comments', function (Blueprint $table) {
			$table->id();
			$table->string('content', 500);
			$table->string('link', 255)->nullable();
			$table->string('image', 255)->nullable();
			$table->string('ip_address', 255)->nullable();
			$table->boolean('is_approved')->nullable()->default(true);
			$table->timestamps();
			$table->morphs('commentable');
			$table->unsignedBigInteger('article_id');
			$table->unsignedBigInteger('reply_id')->nullable();
			$table->foreign('article_id')->references('id')->on('articles')->onUpdate('cascade')->onDelete('cascade');
			$table->foreign('reply_id')->references('id')->on('comments')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('comments');
	}
};
```

## Commentables example (ManyToMany Polymorphic)

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('taggables', function (Blueprint $table) {
			$table->morphs('taggable');
			$table->unsignedBigInteger('tag_id');
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('taggables');
	}
};
```
