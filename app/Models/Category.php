<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Product;

class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $fillable = ['name','slug','parent_id','description','status'];

    /**
     * @var array
     */
    protected $casts = [
        'parent_id'     => 'integer',
        'status'        => 'boolean',
    ];

    /**
     * @param $value
     */
  public function setNameAttribute($value)
  {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
  }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
  public function parent()
  {
     return $this->belongsTo(Category::class,'parent_id');
  }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
  public function children()
  {
     return $this->hasMany(Category::class,'parent_id');
  }


}
