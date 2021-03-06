<?php

namespace App\Http\Controllers;

use App\Enum\StatusEnum;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('products.read');

        $data = tap(
            Product::search($request->input('searchTerm'))->paginate($request->input('perPage')),
            function ($paginatedInstance) use ($request) {
                $sortCollection = $paginatedInstance->sortBy([
                    $request->collect('sort')->map(fn ($m) => [$m['field'], $m['type']])[0]
                ]);
                $sortCollection->load('stock_products', 'creator', 'editor');
                return $paginatedInstance->setCollection($sortCollection);
            }
        );

        return $this->success($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('products.add');

        $attributes = $request->validate([
            'product_category_id'   => 'required|exists:product_categories,id',
            'code'                  => 'required|unique:products',
            'name'                  => 'required|unique:products',
            'alias'                 => 'nullable|unique:products',
            'images'                => 'nullable|array',
            'invoice_name'          => 'nullable|string',
            'sku'                   => 'required|string',
            'unit'                  => 'required|string',
            'barcode'               => 'nullable',
        ]);

        $stock_products_attributes = $request->validate([
            'storehouses.*.id'              => 'nullable|distinct|exists:storehouses,id|integer',
            'storehouses.*.stock'           => 'nullable|min:0|integer',
            'storehouses.*.safety_stock'    => 'nullable|min:0|integer',
        ]);

        try {
            DB::beginTransaction();
            $data = Product::create($attributes);

            $storehouses_ids = collect($stock_products_attributes['storehouses'])->mapWithKeys(fn ($item) => [$item['id'] => collect($item)->except('id')]);
            $data->stock_products()->sync($storehouses_ids->toArray());

            DB::commit();
            return $this->created($data);
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
            return $this->badRequest('??????????????????' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $this->authorize('products.read');

        try {
            $data = Product::findOrFail($id);

            return $this->success($data);
        } catch (ModelNotFoundException $e) {
            return $this->notFound('???????????????');
        } catch (\Exception $e) {
            report($e);
            return $this->badRequest('??????????????????');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('products.update');

        $attributes = $request->validate([
            'product_category_id'   => 'required|exists:product_categories,id',
            'code'                  => 'required|unique:products,code,' . $id,
            'name'                  => 'required|unique:products,name,' . $id,
            'alias'                 => 'nullable|unique:products,alias,' . $id,
            'images'                => 'nullable|array',
            'invoice_name'          => 'nullable|string',
            'sku'                   => 'required|string',
            'unit'                  => 'required|string',
            'barcode'               => 'nullable',
        ]);

        $stock_products_attributes = $request->validate([
            'storehouses.*.id'              => 'nullable|distinct|exists:storehouses,id|integer',
            'storehouses.*.stock'           => 'nullable|min:0|integer',
            'storehouses.*.safety_stock'    => 'nullable|min:0|integer',
        ]);

        try {
            DB::beginTransaction();
            $data = Product::findOrFail($id);

            $storehouses_ids = collect($stock_products_attributes['storehouses'])->mapWithKeys(fn ($item) => [$item['id'] => collect($item)->except('id')]);
            $data->stock_products()->sync($storehouses_ids->toArray());

            $data->update($attributes);

            DB::commit();
            return $this->success('????????????');
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return $this->notFound('???????????????');
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
            return $this->badRequest('??????????????????' . $e->getMessage());
        }
    }

    /**
     * Update the status resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $this->authorize('products.update');

        $data = $request->validate([
            'status' => 'required|in:active,disable',
        ]);

        try {
            DB::beginTransaction();
            $data = Product::findOrFail($id)->update([
                'status'        => $data['status'],
                'disable_at'    => $data['status'] === StatusEnum::??????->value ? now() : null,
            ]);

            DB::commit();
            return $this->success('??????????????????');
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return $this->notFound('???????????????');
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
            return $this->badRequest('??????????????????');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->authorize('products.delete');

        try {
            DB::beginTransaction();
            $data = Product::findOrFail($id)->delete();

            DB::commit();
            return $this->success('????????????');
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return $this->notFound('???????????????');
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();
            return $this->badRequest('??????????????????');
        }
    }
}
