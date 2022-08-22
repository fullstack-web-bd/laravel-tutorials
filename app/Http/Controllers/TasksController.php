<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Task;
use Illuminate\Contracts\Support\Renderable;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Renderable
    {
        $tasks = Task::orderBy('id', 'desc')->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Renderable
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request): \Illuminate\Http\RedirectResponse
    {
        // Create in DB
        $task = new Task();
        $task->title = $request->title;
        $task->slug = Str::of($request->title)->slug();
        $task->description = $request->description;
        $task->status = $request->status;

        // Task image
        $file = $request->file('image');
        $image_name = Str::of($request->title)->slug() . '-' . time() . '.' . $file->extension();
        $task->image = $file->storePubliclyAs('public/tasks', $image_name);
        $task->save();

        // Process the slug again and save.
        $task->slug = $task->slug . '-' . $task->id;
        $task->save();

        // Redirect with flash
        session()->flash('success', 'Task has been created successfully !');
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    // public function edit(string $slug)
    // {
    //     $task = Task::where('slug', $slug)->first();
    //     if (!$task) {
    //         abort(404);
    //     }
    //     return view('tasks.edit', compact('task'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    // public function edit(Task $task)
    // {
    //     return view('tasks.edit', compact('task'));
    // }
    public function edit(string|int $id_or_slug): \Illuminate\Http\RedirectResponse | Renderable
    {
        $task = $this->getTaskByIdOrSlug($id_or_slug);

        // if no task found, then session error message that task not found.
        if (!$task) {
            session()->flash('error', 'Sorry, Task not found !');
            return redirect()->route('index');
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(TaskCreateRequest $request, string|int $id_or_slug): \Illuminate\Http\RedirectResponse
    {
        $task = $this->getTaskByIdOrSlug($id_or_slug);

        // if no task found, then session error message that task not found.
        if (!$task) {
            session()->flash('error', 'Sorry, Task not found !');
            return redirect()->route('index');
        }

        $task->title = $request->title;
        $task->slug = Str::of($request->title)->slug() . '-' . $task->id;
        $task->description = $request->description;
        $task->status = $request->status;

        // Task image
        if ($request->image) {
            // Delete old image.
            // Check if image exists
            if ($task->image) {
                Storage::delete($task->image);
            }

            // Create new image and link
            $file = $request->file('image');
            $image_name = Str::of($request->title)->slug() . '-' . time() . '.' . $file->extension();
            $task->image = $file->storePubliclyAs('public/tasks', $image_name);
        }
        $task->save();

        // Redirect with flash
        session()->flash('success', 'Task has been updated successfully !');
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(string|int $id_or_slug): \Illuminate\Http\RedirectResponse
    {
        // Find first
        $task = $this->getTaskByIdOrSlug($id_or_slug);

        // if no task found, then session error message that task not found.
        if (!$task) {
            session()->flash('error', 'Sorry, Task not found !');
            return redirect()->route('index');
        }

        // Check if any image, then delete
        if ($task->image) {
            Storage::delete($task->image);
        }

        // Delete from Task table
        $task->delete();

        // session success and redirect
        session()->flash('success', 'Task has been deleted successfully !');
        return redirect()->route('index');
    }

    public function getTaskByIdOrSlug(string|int $id_or_slug): ?Task
    {
        if (is_numeric($id_or_slug)) {
            return Task::find($id_or_slug);
        } else {
            return Task::where('slug', $id_or_slug)->first();
        }
    }
}
