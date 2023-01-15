<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reimbuse extends Model
{
    protected $table = 'reimbuse';


    public function reimbuseDetail()
    {
        return $this->hasMany(ReimbuseDetail::class, 'reimbuse_id', 'id');
    }

    public function karyawan()
    {
        return $this->BelongsTo(User::class, 'karyawan_id', 'id');
    }
    public function keuangan()
    {
        return $this->BelongsTo(User::class, 'keuangan_id', 'id');
    }
    public function sekretaris()
    {
        return $this->BelongsTo(User::class, 'sekretaris_id', 'id');
    }
    public function partner()
    {
        return $this->BelongsTo(User::class, 'partner_id', 'id');
    }
}
