<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\DepositRepository;
use Illuminate\Http\Request;

class Deposit extends Controller
{
    public function create(Request $request)
    {
        return DepositRepository::create($request->all());
    }

    public function findByMonthAndYear(int $month, int $year)
    {
        return [
                'total' => DepositRepository::total(),
                ...DepositRepository::findByMonthAndYear($month, $year)->groupBy('status')
            ];
    }

    public function findGroupByStatus()
    {
        return  DepositRepository::all()->groupBy('status')->toArray();
    }

    public function findPending()
    {
        return  DepositRepository::all()->where('status', 'pending');
    }
    
    public function upload(Request $request)
    {
        $foto = $request->file('foto');
        $nomeFoto = time() . '.' . $foto->getClientOriginalExtension();
        $foto->storeAs('fotos', $nomeFoto);

        return response()->json([
            'success' => true,
            'message' => 'Foto salva com sucesso!',
            'url_foto' => asset('storage/fotos/' . $nomeFoto),
        ]);
    }

    public function approve(int $id)
    {
        $deposit = DepositRepository::loadModel()->find($id);
        $deposit->status = 'approved';
        $deposit->save();
        return  $deposit;
    }

    public function reject(int $id)
    {
        $deposit = DepositRepository::loadModel()->find($id);
        $deposit->status = 'rejected';
        $deposit->save();
        return  $deposit;
    }

}
