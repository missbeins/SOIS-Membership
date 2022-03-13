<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationAsset extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'organization_asset_id';
    protected $table = 'organization_assets';
    
    public function organization()
    {
        return $this->belongsTo(organization::class, 'organization_id');
    }

    public function assetType()
    {
        return $this->belongsTo(AssetType::class, 'asset_type_id');
    }
}
