<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use\App\Models\siswa;
use Exception;
use Illuminate\Http\Request;

class PerpustakaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = siswa::all();

        if($data){
            return ApiFormatter::createApi(200, 'success', $data);
        }else{
            return ApiFormatter::createApi(400, 'failed');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nis' => 'required',
                'namalengkap' => 'required',
                'jk' => 'required',
                'kelas' => 'required',
                'nowa' => 'required',
                'email' => 'required',
            ]);

            $siswa = siswa::create([
                'nis' => $request->nis,
                'namalengkap' => $request->namalengkap,
                'jk' => $request ->jk,
                'kelas' => $request->kelas,
                'nowa' => $request->nowa,
                'email' => $request->email
            ]);

            $data= siswa::where('id','=',$siswa->id)->get();

            if($data){
                return ApiFormatter::createApi(200, 'success', $data);
        }else{
            return ApiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $erorr) {
            return ApiFormatter::createApi(400, 'failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= siswa::where('id','=',$id)->get();

            if($data){
                return ApiFormatter::createApi(200, 'success', $data);
        }else{
            return ApiFormatter::createApi(400, 'failed');
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nis' => 'required',
                'namalengkap' => 'required',
                'jk' => 'required',
                'kelas' => 'required',
                'nowa' => 'required',
                'email' => 'required',
            ]);


            $siswa = siswa::findOrFail($id);

            $siswa->update([
                'nis' => $request->nis,
                'namalengkap' => $request->namalengkap,
                'jk' => $request ->jk,
                'kelas' => $request->kelas,
                'nowa' => $request->nowa,
                'email' => $request->email
            ]);

            $data= siswa::where('id','=',$siswa->id)->get();

            if($data){
                return ApiFormatter::createApi(200, 'success', $data);
        }else{
            return ApiFormatter::createApi(400, 'failed');
            }
        } catch (Exception $erorr) {
            return ApiFormatter::createApi(400, 'failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $siswa= siswa::FindOrFail($id);

        $data = $siswa-> delete();

        if($data){
            return ApiFormatter::createApi(200, 'success destroy data');
    }else{
        return ApiFormatter::createApi(400, 'failed');
        }
        } catch (Exception $erorr) {
            return ApiFormatter::createApi(400, 'failed');
        }
    }
}
