<?php 

namespace Modules\toDoList\Http\Controllers\api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Modules\toDoList\Http\Resources\TaskResource;
use Modules\toDoList\Models\Task;
use Illuminate\Http\Request;
use App\traits\ValidationTrait;
use Modules\toDoList\Http\Requests\TaskRequest;

class TaskApiController extends BaseController
{
    use ValidationTrait;
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'string',
            'dueDate' => 'required|date',
            'task_list_id' => 'required|integer|exists:task_list,id',
            'userIds' => 'array|exists:users,id'
        ];
    }

    public function index() {
        return TaskResource::collection(Task::all());
    }

    public function store(Request $request)
    {
        if ($this->validateRules($request->all(),$this->rules())) {
            $task_list = Task::create([
                'title' => $request->post('title'),
                'description' => $request->post('description'),
                'dueDate' => $request->post('dueDate'),
                'task_list_id' => $request->post('task_list_id'),
            ]);
            $task_list->saveRelation($request->post('userIds'));
        
        return new TaskResource($task_list);
        }
        return response()->json(['error' => $this->validationErrors()], 422);
    }

    public function update(Request $request,$id)
    {
        if ($this->validateRules($request->all(), $this->rules())) {
            if (!is_null($task = Task::find($id))) {
                $task->update($request->all());
                if ($request->has('userIds')) {
                    $task->deleteRelation();
                    $task->saveRelation($request->post('userIds'));
                }
                return new TaskResource($task);
            }
            return response()->json(['error' => 'this item does not exist'], 422);
        }
        return response()->json(['error' => $this->validationErrors()], 422);
    }

    public function destroy($id)
    {
        if (!is_null($task = Task::find($id))) {
            $task->deleteRelation();
            $task->delete();
            return response()->json(['message' => 'this item was successfully deleted.'], 204);
        }
        return response()->json(['message' => 'this item does not exist.'], 204);
    }
}
