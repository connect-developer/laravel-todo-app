<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Service\TodoService;
use App\Http\Requests\Todo\{
    StoreRequest,
    ChangeStatusRequest,
};
use App\Enums\TodoStatus;

class TodoController extends Controller
{
    /**
     * main service
     *
     * @var TodoService
     */
    private $service;

    public function __construct(TodoService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = $this->service->all();
        $statuses = TodoStatus::getLocalizedDescriptions();

        return view('todo.index', compact(
            'todos',
            'statuses'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->service->create($request->validated());

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ChangeStatusRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChangeStatusRequest $request, $id)
    {
        $this->service->changeStatus($request->input('status'), $id);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);

        return back();
    }
}
