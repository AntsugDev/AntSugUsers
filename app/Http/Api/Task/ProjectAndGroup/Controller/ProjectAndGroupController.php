<?php

namespace App\Http\Api\Task\ProjectAndGroup\Controller;

use App\Http\Api\Task\ProjectAndGroup\Request\TaskProjectRequest;
use App\Http\Api\Task\ProjectAndGroup\Resource\TaskProjectCollection;
use App\Http\Api\Task\ProjectAndGroup\Resource\TaskProjectResource;
use App\Http\Controllers\Controller;
use App\Models\Task\TaskProject;
use App\Models\User;
use Illuminate\Http\Response;

class ProjectAndGroupController extends Controller
{


    public function index(User $user): \Illuminate\Http\JsonResponse
    {
        $project = TaskProject::where('user_id',$user->id)->get();
        return (new TaskProjectCollection($project))->response(request())->setStatusCode(Response::HTTP_OK);

    }

    public function store(User $user, TaskProjectRequest $request): ?\Illuminate\Http\JsonResponse
    {

        if($request->validationData()){
            $data = $request->validationData();
            $data['user_id'] = $user->id;
            $project = TaskProject::create($data);
            return (new TaskProjectResource($project))->response($request)->setStatusCode(Response::HTTP_CREATED);
        }
        return null;
    }

    public function destroy(User $user){

    }
}
