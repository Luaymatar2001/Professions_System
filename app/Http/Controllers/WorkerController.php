<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostWorkerRequest;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = 10;
        $result = Worker::select("*")->paginate($paginate);
        foreach ($result as $results) {
            if (!Storage::disk('local')->exists($results->cover_image)) {
                abort(404);
            }
            $results->cover_image
                = storage_path('app/' . $results->cover_image);
            // . Storage::url($results->cover_image);
        }
        return response()->json(["Worker data" => $result], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostWorkerRequest $request)
    {
        // ['professional_experience', 'cover_image', 'id_number', 'address', 'experience-year', 'password', 'user_id', 'profession_id'];
        // $image = $request->file('cover_image');
        // $path = "project_img/cover_img/";
        // $name = time() + rand(1, 1000) . "." . $image->getClientOriginalExtension();
        // Storage::disk('local')->put($path . $name,  file_get_contents($image));
        //-------Base 64-------------

        $base64 = $request['cover_image'];
        if (!$base64) {
            return response()->json(['error' => 'Please enter a base64 image string.']);
        }

        //  This line of code uses a regular expression to remove the image format and base64 encoding prefix from a string representing an image encoded in base64 format.
        $base64 = preg_replace("/^data:image\/(png|jpeg|jpg|svg|gif);base64,/", '', $base64);
        //decode from base64 image
        $data = base64_decode($base64);
        $imageSize = getimagesizefromstring($data);
        $path = "project_img/cover_img/";
        $name = time() + rand(1, 1000) . "." . explode("/", $imageSize['mime'])[1];
        Storage::disk('local')->put($path . $name,  $data);

        $worker = new Worker();
        $worker->professional_experience = $request['professional_experience'];
        $worker->cover_image = $path . $name;
        $worker->id_number = $request['id_number'];
        $worker->address = $request['address'];
        $worker->experience_year = $request['experience_year'];
        $worker->password = $request['password'];
        $worker->user_id = $request['user_id'];
        $worker->profession_id = $request['profession_id'];
        $worker->phone_number = $request['phone_number'];
        $status = $worker->save();

        // $status = Worker::create($request->except('cover_image'), ['cover_image' => $path . $name]);

        if ($status) {
            return response()->json(['message' => 'Record inserted successfully.', 'data' => $status], 200);
        } else {
            return response()->json(['message' => 'Failed to insert record.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        if ($worker) {
            return response()->json($worker, 200);
        } else {
            return response()->json(['message' => 'not find this specialties '], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        // Storage::disk('local')->delete($worker->cover_image);

        //The shortcut process loads the image on every update
        if (Storage::disk('local')->exists($worker->cover_image)) {
            Storage::disk('local')->delete($worker->cover_image);
        }
        //
        $image = $request->file('cover_image');
        $path = "project_img/cover_img/";
        $name = time() + rand(1, 1000) . "." . $image->getClientOriginalExtension();
        Storage::disk('local')->put($path . $name,  file_get_contents($image));
        //  $this->URLFile($request->file('cover_image'));
        $worker->professional_experience = $request['professional_experience'];
        $worker->cover_image  = $path . $name;
        $worker->id_number = $request['id_number'];
        $worker->address = $request['address'];
        $worker->experience_year = $request['experience_year'];
        $worker->password = $request['password'];
        $worker->user_id = $request['user_id'];
        $worker->profession_id = $request['profession_id'];
        $worker->phone_number = $request['phone_number'];


        $status = $worker->save();

        if ($status) {
            return response()->json(['message' => 'success for update Process', 'data' =>  $status], 200);
        } else {
            return response()->json(['message' => 'not find this Worker '], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        if (Storage::disk('local')->exists($worker->cover_image)) {
            Storage::disk('local')->delete($worker->cover_image);
        }
        $result = $worker::destroy($worker->id);
        if ($worker) {
            return response()->json(['message' => 'success for DELETE Process', 'data' => $result], 200);
        } else {
            return response()->json(['message' => 'not find this Worker '], 500);
        }
    }
}
