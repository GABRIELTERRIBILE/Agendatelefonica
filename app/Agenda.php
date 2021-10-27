<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    public $timestamps = false;
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cep',
        'rua',
        'bairro',
        'cidade',
        'estado',

    ];

}
