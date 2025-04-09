# Laravel

## Paginate

```php
<?php

use App\Models\User;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;

Route::get('users', function () {

	$perPage = $request->integer('per_page', default: 5);

	$users = User::paginate(5);

	$query = User::query();
	$query->select('id', 'name', 'email', 'active', 'mobile');
	$query->where('name','like',"%{$search}%");
	$query->where('active', true);

	$users = $query->paginate(
		perPage: $perPage,
		columns: ['*'],
		pageName:'page_reply',
		page: null
	);
	$users->appends(['comment' => 1]);
	$users->setPath('custom/url');
	$users->withQueryString();
	$users->links();

	return UserResource::collection(resource: $users);

	return UserCollection(resource: $users);
});
```

## UserResource

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserResource extends JsonResource
{
	public static $wrap = 'data';

	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'email' => $this->email,
		];
	}
}
```

## UserCollection

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
	public static $wrap = 'data';

	public function toArray(Request $request): array
	{
		return [
			'data' => $this->collection,
			'paginate' => new PaginationResource($this),
		];
	}
}
```

## PaginationResource

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
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
