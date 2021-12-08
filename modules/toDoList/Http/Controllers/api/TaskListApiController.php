<?php 

namespace Modules\toDoList\Http\Controllers\api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Modules\toDoList\Http\Resources\TaskListResource;
use Modules\toDoList\Models\TaskList;
use Illuminate\Http\Request;
use App\traits\ValidationTrait;
use Modules\toDoList\Http\Requests\TaskListRequest;

class TaskListApiController extends BaseController
{
    use ValidationTrait;
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'creator_id' => 'integer|required|exists:users,id'
        ];
    }

    public function index() {
        return TaskListResource::collection(TaskList::all());
    }

    public function store(Request $request)
    {
        if ($this->validateRules($this->rules(), $request->all())) {
            $task_list = TaskList::create([
                'title' => $request->post('title'),
                'creator_id' => $request->post('creator_id')
            ]);
        return new TaskListResource($task_list);
        }
        return response()->json(['error' => $this->validationErrors()]);
    }

    public function update($id, Request $request)
    {   
        if ($this->validateRules($this->rules(), $request->all())) {
            if (!is_null($tasklist = TaskList::find($id))) {
                $tasklist->update([
                    'title' => $request->post('title'),
                    'creator_id' => $request->post('creator_id'),
                ]);
                return new TaskListResource($tasklist);
            }
            return response()->json(['error' => 'this item does not exist.s']);
        }
        return response()->json(['error' => $this->validationErrors()]);
    }

    public function destroy($id)
    {
        if (!is_null($tasklist = TaskList::find($id))) {
            $tasklist->delete();
            return response()->json(['message' => 'item was successfully deleted.'], 204);
        }
        return response()->json(['error' => 'this item does not exist.']);
    }
}
