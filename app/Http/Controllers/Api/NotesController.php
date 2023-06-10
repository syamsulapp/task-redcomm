<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NotesModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{
    protected $modelNotes;

    public function __construct(NotesModels $modelNotes)
    {
        $this->modelNotes = $modelNotes;
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $limit = 10; // max query 10 content per page

        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }
        $data = $this->modelNotes->when($request->title, function ($query) use ($request) {
            return $query->where('title', 'like', "%{$request->title}%");
        })->when($request->desc, function ($query) use ($request) {
            return $query->where('desc', 'like', "%{$request->desc}%");
        })
            ->with('users_id')
            ->orderByDesc('id')
            ->paginate($limit);

        return $this->builder($data->items());
    }

    public function show($id)
    {
        return $this->builder($this->modelNotes->whereId($id)->first());
    }

    /**
     * Store a newly created notes in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required',
            'desc' => 'required',
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            $result = $this->customError($validator->errors());
        } else {
            $data['users_id'] = $request->user()->id;
            $result = $this->builder($this->modelNotes->create($data), 'Successfully Create Notes');
        }
        return $result;
    }


    /**
     * Update the specified notes in storage.
     */
    public function update(Request $request, $id)
    {

        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'desc' => 'required|string',
            'text' => 'required|string',
        ]);

        if ($validator->fails()) {
            $result = $this->customError($validator->errors());
        } else {
            if ($id > 0) {
                if ($update = $this->modelNotes->whereId($id)->first()) {
                    $data['users_id'] = $request->user()->id; //update foto nya users
                    $update->update($data);
                    $result = $this->builder($update, 'Successfully Update Notes');
                } else {
                    $result = $this->builder('id not found for update', 'id tidak di temukan', 422);
                }
            } else {
                $result = $this->builder('please insert id', 'masukan id', 422);
            }
        }
        return $result;
    }

    /**
     * Remove the specified notes from storage.
     */
    public function destroy($id)
    {
        if ($id > 0) {
            if ($delete = $this->modelNotes->whereId($id)->first()) {
                $result = $delete->delete();
            } else {
                $result = $this->builder('id not found for delete', 'id tidak di temukan', 422);
            }
        } else {
            $result = $this->builder('insert id', 'masukan id', 422);
        }
        return $result;
    }
}
