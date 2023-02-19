<?php

namespace App\Traits;


trait PaginationTrait
{
    public function scopePagination($query, $orderColumn = 'created_at',$orderType = 'desc')
    {
        // Check If Parameter PerPage Exists and in Array Of PerPage Number The Assign the Value For Var Or Get From default Setting
        $perPagePagination = request('perPage') && in_array(request('perPage'), config('setting.contentPerPage', [20, 40, 60, 80, 100]))
            ? intval(request('perPage'))
            : config('setting.LimitPaginate', 20);

        return $query->orderBy($orderColumn,$orderType)->paginate($perPagePagination)->withQueryString();

    }// End Pagination

}
