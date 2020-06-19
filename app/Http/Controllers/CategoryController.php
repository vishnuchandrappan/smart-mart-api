<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Requests\NewCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $superMarket;

    public function __construct()
    {
        // $this->middleware('isAdmin');
        $this->superMarket = auth()->user()->superMarket;
    }


    public function store(NewCategoryRequest $request)
    {
        // $superMarket = auth()->user()->superMarket;
        $this->superMarket->create($request->all());
        return new SuccessResponse('Category created');
    }

    public function update(UpdateCategoryRequest $request)
    {
        $data = $this->superMarket->categories()->find($request->category_id);

        $data->update($request->only('name'));

        return new SuccessResponse('Category Updated');
    }

    public function destroy(DeleteCategoryRequest $request)
    {
        $data = $this->superMarket->categories()->find($request->category_id);

        $data->delete();

        return new SuccessResponse('Category deleted');
    }
}
