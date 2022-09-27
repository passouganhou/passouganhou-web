<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    const FORM_PECA_SUA = 'form-peca-a-sua';
    const FORM_VENDA_PELA_INTERNET = 'form-venda-pela-internet';

    protected $guarded = [];
}
