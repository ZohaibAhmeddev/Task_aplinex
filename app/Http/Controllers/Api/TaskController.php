<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(TaskRequest $request)
    {
        $user = $request->user();

        if ($user->hasPermissionTo('create task')) {
            $task = Task::create(array_merge($request->all(), ['user_id' => $user->id]));
            return response()->json(['message' => 'Task created', 'task' => TaskResource::make($task)], 201);
        } else {
            return response()->json(['message' => 'You don not have permission'], 403);
        }
    }

    public function update(TaskRequest $request, $id)
    {
        $user = $request->user();

        if ($user->hasPermissionTo('update own task')) {
            $task=Task::find($id);
            $task->update($request->all());
            return response()->json(['message' => 'Task updated', 'task' => TaskResource::make($task)], 200);
        } else {
            return response()->json(['message' => 'You don not have permission'], 403);
        }
    }

    public function delete(Request $request, $id)
    {
        $user = $request->user();
        if ($user->hasPermissionTo('delete own task')) {
            $task=Task::where('id',$id)->where('user_id',$user->id)->first();
            if(!$task){
                return response()->json(['message' => 'Task not found'], 404);
            }
            $task->delete();
            return response()->json(['message' => 'Task deleted'], 200);
        } else {
            return response()->json(['message' => 'You don not have permission'], 403);
        }
    }

    public function get()
    {
        $user = auth()->user();
        if($user->hasPermissionTo('view own task')){

                $tasks = Task::where('user_id', $user->id)->get();

                return response()->json(['tasks' => TaskResource::collection($tasks)], 200);
        }
         elseif($user->hasPermissionTo('view all tasks')){
            $tasks = Task::all();
            return response()->json(['tasks' => TaskResource::collection($tasks)], 200);
         }

    }

}
