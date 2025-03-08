<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelPackageTools\Concerns\Package\HasTranslations;

class Faq extends Model
{
    use HasTranslations;

    public $translatable = ['question', 'answer'];

    protected $guarded = ['id'];
}
