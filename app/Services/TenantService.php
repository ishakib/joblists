<?php

namespace App\Services;

use App\Enums\TenantStatusEnum;
use App\Models\Tenant;
use Illuminate\Pagination\AbstractPaginator;

class TenantService
{
    /**
     * @param Tenant $tenant
     * @return AbstractPaginator
     */
    public function all(Tenant $tenant): AbstractPaginator
    {
        $query = $this->selectCommonColumns(tenantId: $tenant->id)
            ->where('status', TenantStatusEnum::ACTIVE->value);

        if (!request()->input('sort_by')) {
            $query->orderBy('id', 'DESC');
        }

        return $query->paginate(request()->input('per_page', 10));
    }

    /**
     * @param int $tenantId
     * @return mixed
     */
    protected function selectCommonColumns(int $tenantId): mixed
    {
        return Tenant::select(
            'id',
            'tenant_id',
            'uid',
            'status'
        )->where('tenant_id', $tenantId);
    }

    public function findByUid(Tenant $tenant, string $uid, array $with = []): Tenant|null
    {
        return $this->selectCommonColumns(tenantId: $tenant->id)
            ->where('uid', $uid)
            ->with($with)
            ->first();
    }

}
