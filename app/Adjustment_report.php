<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adjustment_report extends Model
{
    public function accountSectornew()
    {
        return $this->belongsTo(AccountSector::class, 'new_account_sector_id', 'id');
    }
    public function accountSectorold()
    {
        return $this->belongsTo(AccountSector::class, 'old_account_sector_id', 'id');
    }

    public function ledgerold()
    {
        return $this->belongsTo(Ledger::class, 'old_ledger', 'id');
    }
    public function ledgernew()
    {
        return $this->belongsTo(Ledger::class, 'new_ledger', 'id');
    }
}
