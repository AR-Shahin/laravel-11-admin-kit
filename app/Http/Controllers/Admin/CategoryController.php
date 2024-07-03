<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseCRUDRequest;
use App\Models\Category;
use App\Repository\BaseCRUDRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $repository;

    function __construct()
    {
        parent::__construct();
        $this->repository = new BaseCRUDRepository(new Category());
    }

    function index(Request $request)  {

        if($request->ajax()){

            return $this->table($this->repository->query())
                ->addIndexColumn()
                ->addColumn("actions",function($row){
                    $deleteRoute = route('admin.categories.destroy', $row["id"]);
                    $html = $this->generateDeleteButton($row,$deleteRoute,"admin-delete","DELETE");
                    return $html;
                })

                ->addColumn("status", fn($row) => $row->status_badge)

                ->rawColumns(["actions","status"])
                ->make(true);
        }

        return view("admin.category.index");
    }

    function destroy($category) {
        if($this->repository->delete($category)){
            $this->deletedAlert();
            return back();
        }
    }

    function store(Request $request) {

        $customRules = [
            'name' => ["required","unique:categories"],
            // Add other dynamic rules as needed
        ];

        // Create an instance of BaseCRUDRequest
        $validatedRequest = app(BaseCRUDRequest::class);

       $validatedRequest->setCustomRules($customRules);

        // Validate the request
      return  $validated = $validatedRequest->validate();

        // Proceed with your logic, e.g., create a new record
        // YourModel::create($validated);

        return $request;
    }
}
