<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Tt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CadreController extends Controller
{
    public function index(Request $request)
    {
        $tts = Tt::latest();
        if ($request->number){
            $tts = $tts->where('number',$request->number);
        }
        if($request->name){
            $tts = $tts->where('name','LIKE',"%{$request->name}%");
        }
        if($request->track){
            $tts = $tts->where('track',$request->track);
        }
        if ($request->auth_date_from){
            $tts = $tts->where('auth_date',$request->auth_date_from_type,$request->auth_date_from);
        }
        if($request->auth_date_to){
            $tts = $tts->where('auth_date',$request->auth_date_to_type,$request->auth_date_to);
        }
        if($request->auth_time_from){
            $tts = $tts->where('auth_time',$request->auth_time_from_type,$request->auth_time_from);
        }
        if($request->auth_time_to){
            $tts = $tts->where('auth_time',$request->auth_time_to_type,$request->auth_time_to);
        }
        $tts = $tts->where(function ($query){
            return $query->where([
                'track' => 1,
                ['auth_time', '>', '08:00:00']
            ])->orWhere([
                'track' => -1,
                ['auth_time', '>', '18:00:00']
            ]);
        })->where('status', 0);
        $tts = $tts->paginate(40);
        $types = [
            '=' => '=',
            '>' => '>',
            '<' => '<',
            '>=' => '>=',
            '<=' => '<=',
        ];
        return view('cadre.index',[
            'tts' => $tts,
            'types' => $types,
        ]);
    }

    public function show($id)
    {
        $tt = Tt::find($id);
        return view('cadre.show',[
            'tt' => $tt,
        ]);
    }
    public function edit($id)
    {
        $tt = Tt::find($id);
        return view('cadre.edit',[
            'tt' => $tt,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'info' => 'nullable|string|max:250',
            /*'file' => 'nullable|file',*/
        ]);
        if ($request->hasFile('file')) {
            foreach ($request->file as $f){
                $file_name = date('Y_m_d_H_i_s').rand(10000, 99999).'.'.$f->getClientOriginalExtension();
                $f->move(public_path('tt_files'), $file_name);
                File::create([
                    'model' => Tt::class,
                    'model_id' => $id,
                    'name' => $file_name,
                    'ext' => $f->getClientOriginalExtension(),
                ]);
            }
        }
        Tt::where('id',$id)->update([
            'info' => $request->info,
        ]);
        return redirect()->route('cadre.show', $id)->with('success', 'Информация изменена успешно');
    }

    public function changeStatus($id, $status)
    {
        $tt = Tt::find($id);
        if (!$tt) {
            return redirect()->back()->with('error', "Время не найдено");
        }
        if (!in_array($status, [2, 3])) {
            return redirect()->back()->with('error', "Неверное значение статуса");
        }
        $tt->update([
            'status' => $status,
        ]);
        return redirect()->back()->with('success', 'Статус изменена успешно');
    }


}
