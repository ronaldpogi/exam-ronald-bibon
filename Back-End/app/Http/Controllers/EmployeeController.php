<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Policies\EmployeePolicy;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    protected $name = 'Employee';

    public function __construct(protected EmployeeRepository $repository) {}

    public function index(): JsonResponse
    {
        $employees = $this->authorize('index', Employee::class);

        $query = Employee::query();
        $query = app(EmployeePolicy::class)->scope(auth()->user(), $query);

        $employees = $this->repository->getFiltered($query);

        return response()->success(EmployeeResource::collection($employees), __('crud.read', ['resource' => $this->name.'s']));
    }

    public function store(EmployeeRequest $request): JsonResponse
    {

        $employee = new Employee($request->validated());

        $this->authorize('store', $employee);

        $employee = $this->repository->create($request->validated());

        return response()->success(new EmployeeResource($employee), __('crud.create', ['resource' => $this->name]), 201);
    }

    public function show($id): JsonResponse
    {
        $employee = $this->repository->find($id);

        $this->authorize('show', $employee);

        return response()->success(new EmployeeResource($employee), __('crud.read', ['resource' => $this->name]));
    }

    public function update(EmployeeRequest $request, $id): JsonResponse
    {
        $employee = $this->repository->find($id);

        $this->authorize('update', $employee);

        $employee = $this->repository->update($id, $request->validated());

        return response()->success(new EmployeeResource($employee), __('crud.update', ['resource' => $this->name]));
    }

    public function destroy($id): JsonResponse
    {
        $employee = $this->repository->find($id);

        $this->authorize('destroy', $employee);

        $this->repository->delete($id);

        return response()->success([], __('crud.delete', ['resource' => $this->name]));
    }
}
